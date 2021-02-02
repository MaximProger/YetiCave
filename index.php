<?php

require_once 'data.php';
require_once 'functions.php';
require_once 'init.php';

// Получаем массив пользователей
$ads = [];

if (!$link) {
    $error = mysqli_connect_error();
    $content = renderTemplate('templates/error.php', ['error' => $error]);
} else {
    $sql = 'SELECT c.title as category, a.title, a.price, a.img FROM ads a
JOIN categories c ON c.id = a.category_id';
    $result = mysqli_query($link, $sql);

    if ($result) {
        $ads = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $error = mysqli_error($link);
        $content = renderTemplate('templates/error.php', ['error' => $error]);
    }
}

$page_content = renderTemplate('templates/index.php', ['ads' => $ads, 'date' => $untilMidnightDate]);

$layout_content = renderTemplate('templates/layout.php',
    [
        'categories' => $categories,
        'title' => 'Название страницы',
        'content' => $page_content
    ]);


print ($layout_content);
?>
