<?
require_once 'data.php';
require_once 'functions.php';

$currLot = $ads[$_GET['id']];

if (!isset($currLot)) {
    http_response_code(404);
    header("HTTP/1.0 404 Not Found");
}

session_start();

// Просмотренные лоты
$visited_name = "visited22";
$expire = strtotime("+30 days");
$path = "/";
$visited_value = '';
$visited_value .= $_GET['id'];

if (isset($_COOKIE[$visited_name])) {
    $visited_value = $_COOKIE[$visited_name];
    $visited_value .= $_GET['id'];
}

setcookie($visited_name, $visited_value, $expire, $path);

$page_content = renderTemplate('templates/lot.php', ['lot' => $currLot, 'date' => $untilMidnightDate]);

$layout_content = renderTemplate('templates/layout.php',
    [
        'categories' => $categories,
        'title' => 'Название страницы',
        'content' => $page_content
    ]);


print ($layout_content);
?>
