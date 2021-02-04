<?php

require_once 'data.php';
require_once 'functions.php';
require_once 'init.php';

if (!$link) {
    $error = mysqli_connect_error();
    $content = renderTemplate('templates/error.php', ['error' => $error]);
}
else {

    $ads = [];

    mysqli_query($link, 'CREATE FULLTEXT INDEX ad_ft_search ON ads(title, description)');

    $search = $_GET['search'] ?? '';

    if ($search) {
        $sql = "SELECT ads.id, ads.title, ads.img, ads.price_start, users.name, categories.title as category FROM ads JOIN users ON ads.user_id = users.id JOIN categories ON categories.id = ads.category_id WHERE MATCH(ads.title, ads.description) AGAINST(?)";

        $stmt = db_get_prepare_stmt($link, $sql, [$search]);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $ads = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $content = renderTemplate('templates/search.php', ['ads' => $ads, 'date' => $untilMidnightDate, 'search' => $search]);
    } else {
        $content = renderTemplate('templates/search.php', []);
    }
}

$layout_content = renderTemplate('templates/layout.php',
    [
        'categories' => $categories,
        'title' => 'Название страницы',
        'content' => $content
    ]);


print ($layout_content);
