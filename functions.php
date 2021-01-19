<?php

// Функция шаблонизатор
function renderTemplate($path, $arr) {
    ob_start();

    require $path;

    $html = ob_get_clean();

    // Проверяем, существует ли файл
    if (file_exists($path)) {
        return $html;
    } else {
        return '';
    }

}

