<?php

require_once 'init.php';
require_once 'functions.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form = $_POST;

    $required = ['email', 'password'];
    $errors = [];
    foreach ($required as $field) {
        if (empty($form[$field])) {
            $errors[$field] = 'Это поле надо заполнить';
        }
    }

    // Получаем массив пользователей
    $users = [];

    if (!$link) {
        $error = mysqli_connect_error();
        $content = renderTemplate('templates/error.php', ['error' => $error]);
    } else {
        $sql = 'SELECT * FROM users';
        $result = mysqli_query($link, $sql);

        if ($result) {
            $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            $error = mysqli_error($link);
            $content = renderTemplate('templates/error.php', ['error' => $error]);
        }
    }

    if (!count($errors) and $user = array_search_recursive($form['email'], $users)) {
        if (password_verify($form['password'], $user['password'])) {
            $_SESSION['user'] = $user;
        }
        else {
            $errors['password'] = 'Неверный пароль';
        }
    }
    else {
        $errors['email'] = 'Такой пользователь не найден';
    }

    if (count($errors)) {
        $page_content = renderTemplate('templates/login.php', ['user_data' => $form, 'errors' => $errors]);
    }
    else {
        header("Location: /index.php");
        exit();
    }
}
else {
    if (isset($_SESSION['user'])) {
        header("Location: /logout.php");
    }
    else {
        $page_content = renderTemplate('templates/login.php', []);
    }
}

$layout_content = renderTemplate('templates/layout.php', [
    'content'    => $page_content,
    'categories' => [],
    'title'      => 'Название страницы'
]);

print($layout_content);

?>
