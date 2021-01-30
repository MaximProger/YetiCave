<?php

require_once 'data.php';
require_once 'functions.php';

$page_content = renderTemplate('templates/all-lots.php', ['ads' =>  $ads, 'date' => $untilMidnightDate,  'visited' => $_COOKIE['visited22']]);

$layout_content = renderTemplate('templates/layout.php',
    [
        'categories' => $categories,
        'title' => 'Название страницы',
        'content' => $page_content
    ]);

print ($layout_content);

?>

