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

// Рекурсивный поиск в массиве
function array_search_recursive($needle, array $haystack)
{
    foreach ($haystack as $key => $value) {
        $current_key = $key;

        if ($needle === $value or (is_array($value) && array_search_recursive($needle, $value) !== false)) {
            return $haystack[$current_key];
        }
    }
    return false;
}



