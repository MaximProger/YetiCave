<?php
$is_auth = (bool)rand(0, 1);

$user_name = 'Константин';
$user_avatar = 'img/user.jpg';

$categories = ["Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"];

$ads = [
    [
        'title' => '014 Rossignol District Snowboard',
        'category' => 'Доски и лыжи',
        'price' => '10999',
        'img' => 'img/lot-1.jpg'
    ],
    [
        'title' => 'DC Ply Mens 2016/2017 Snowboard',
        'category' => 'Доски и лыжи',
        'price' => '15999',
        'img' => 'img/lot-2.jpg'
    ], [
        'title' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'category' => 'Крепления',
        'price' => '8000',
        'img' => 'img/lot-3.jpg'
    ],
    [
        'title' => 'Ботинки для сноуборда DC Mutiny Charocal',
        'category' => 'Ботинки',
        'price' => '10999',
        'img' => 'img/lot-4.jpg'
    ],
    [
        'title' => 'Куртка для сноуборда DC Mutiny Charocal',
        'category' => 'Одежда',
        'price' => '10999',
        'img' => 'img/lot-5.jpg'
    ],
    [
        'title' => 'Маска Oakley Canopy',
        'category' => 'Разное',
        'price' => '5500',
        'img' => 'img/lot-6.jpg'
    ]
];

require_once 'functions.php';

// Работа с датой
date_default_timezone_set("Europe/Moscow");

// Расчет даты до полуночи
$curHour = date('G');
$curMinutes = date('i');

$untilMidnightHour = 24 - $curHour;
$untilMidnightMinutes = 60 - $curMinutes;
$untilMidnightDate = $untilMidnightHour . ':' . $untilMidnightMinutes;

$page_content = renderTemplate('templates/index.php', ['ads' => $ads, 'date' => $untilMidnightDate]);

$layout_content = renderTemplate('templates/layout.php',
    [
        'categories' => $categories,
        'title' => 'Название страницы',
        'content' => $page_content
    ]);


print ($layout_content);
?>
