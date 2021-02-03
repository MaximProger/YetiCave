<?php

require_once 'functions.php';
require_once 'data.php';

$page_content = renderTemplate('templates/my-lots.php', []);

$layout_content = renderTemplate('templates/layout.php',
    [
        'categories' => $categories,
        'title' => 'Название страницы',
        'content' => $page_content
    ]);


print ($layout_content);
