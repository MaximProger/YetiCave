<?php

require_once 'data.php';
require_once 'functions.php';
require_once 'init.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lot = $_POST;

    $required = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date'];
    $errors = [];
    foreach ($required as $key) {
        if (empty($_POST[$key])) {
            $errors[$key] = 'Это поле надо заполнить';
        }
    }

    if ($lot['category'] == 'Выберите категорию') {
        $errors['category'] = 'Выберите категорию';
    }

    if (isset($_FILES['file']['name'])) {
        $path = $_FILES['file']['name'];
        $res = move_uploaded_file($_FILES['file']['tmp_name'], 'img/' . $path);
    } else {
        $errors['file'] = 'empty';
    }

    if (isset($path)) {
        $lot['path'] = 'img/' . $path;
    }

    if (count($errors)) {
        $page_content = renderTemplate('templates/add-lot.php', ['lot' => $lot, 'errors' => $errors]);
    } else {

        // Записываем данные в БД
        if (!$link) {
            $error = mysqli_connect_error();
            $content = renderTemplate('templates/error.php', ['error' => $error]);
        } else {

            $title = $lot['lot-name'];
            $category_id = $lot['category'];
            $description = $lot['message'];
            $img = $lot['path'];
            $price_start = $lot['lot-rate'];
            $step = $lot['lot-step'];
            $date = $lot['lot-date'];
            $is_active = 1;
            $user_id1 = $_SESSION['user']['id'];

            $sql = "INSERT INTO ads (user_id, title, category_id, description, img, price_start, step, date, is_active) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, 'issssssss', $user_id1, $title, $category_id, $description, $img, $price_start, $step, $date, $is_active);
            mysqli_stmt_execute($stmt);

            if (!$stmt) {
                $error = mysqli_error($link);
                $content = renderTemplate('templates/error.php', ['error' => $error]);
            }
        }

        $page_content = renderTemplate('templates/view.php', ['lot' => $lot, 'time' => $untilMidnightDate]);

    }
} else {
    $page_content = renderTemplate('templates/add-lot.php', []);
}


$layout_content = renderTemplate('templates/layout.php',
    [
        'categories' => $categories,
        'title' => 'Название страницы',
        'content' => $page_content
    ]);


if (isset($_SESSION['user'])) {
    print ($layout_content);
} else {
    http_response_code(404);
    header("HTTP/1.0 404 Not Found");
}

