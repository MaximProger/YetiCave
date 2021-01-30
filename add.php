<?php

require_once 'data.php';
require_once 'functions.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lot = $_POST;

    $required = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date'];
    $dict = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date', 'file'];
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
        $page_content = renderTemplate('templates/add-lot.php', ['lot' => $lot, 'errors' => $errors, 'dict' => $dict]);
    } else {
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


