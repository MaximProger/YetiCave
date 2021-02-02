<?php

require_once 'init.php';
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form = $_POST;

    $required = ['email', 'password', 'name', 'message'];
    $errors = [];
    foreach ($required as $key) {
        if (empty($_POST[$key])) {
            $errors[$key] = 'Это поле надо заполнить';
        }
    }

    // Проверка, есть ли уже такой email в БД
    $users = [];

    if (!$link) {
        $error = mysqli_connect_error();
        $content = renderTemplate('templates/error.php', ['error' => $error]);
    } else {
        $sql = 'SELECT `email` FROM users';
        $result = mysqli_query($link, $sql);

        if ($result) {
            $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            $error = mysqli_error($link);
            $content = renderTemplate('templates/error.php', ['error' => $error]);
        }
    }

    if (array_search_recursive($form['email'], $users)) {
        $errors['email'] = 'Пользователь с таким Email уже существует';
    }

    if (isset($_FILES['file']['name'])) {
        $path = $_FILES['file']['name'];
        $res = move_uploaded_file($_FILES['file']['tmp_name'], 'img/' . $path);
    } else {
        $errors['file'] = 'empty';
    }

    if (isset($path)) {
        $form['path'] = 'img/' . $path;
    }

    if (count($errors)) {
        $page_content = renderTemplate('templates/sign-up.php', ['form' => $form, 'errors' => $errors]);
    } else {

        // Записываем данные в БД
        if (!$link) {
            $error = mysqli_connect_error();
            $content = renderTemplate('templates/error.php', ['error' => $error]);
        } else {

            $name = $form['name'];
            $avatar = $form['path'];
            $email = $form['email'];
            $password =  password_hash($form['password'], PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (name, avatar, email, password) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, 'ssss', $name, $avatar, $email, $password);
            mysqli_stmt_execute($stmt);

            if (!$stmt) {
                $error = mysqli_error($link);
                $content = renderTemplate('templates/error.php', ['error' => $error]);
            }
        }

        header("Location: /index.php");
        exit();
    }
} else {
    $page_content = renderTemplate('templates/sign-up.php', []);
}


$layout_content = renderTemplate('templates/layout.php',
    [
        'categories' => $categories,
        'title' => 'Название страницы',
        'content' => $page_content
    ]);

print ($layout_content);
