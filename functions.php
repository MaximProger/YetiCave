<?php

function sumFormat($number) {

    $formatNumber = number_format(ceil($number), 0, '', ' ') . "<b class=\"rub\">р</b>";

    return $formatNumber;
}

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



