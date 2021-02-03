<?
require_once 'data.php';
require_once 'functions.php';
require_once 'init.php';

// История просмотров
session_start();

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

if (!$link) {
    $error = mysqli_connect_error();
    $content = renderTemplate('templates/error.php', ['error' => $error]);
} else {

    // Массив объявлений
    $sql = 'SELECT * FROM ads';
    $result = mysqli_query($link, $sql);

    if ($result) {
        $ads = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $error = mysqli_error($link);
        $content = renderTemplate('templates/error.php', ['error' => $error]);
    }

    $currLot_id = $ads[$_GET['id']]['id'];

    // Массив ставок
    $sql2 = "SELECT u.name, r.price, DATE_FORMAT(r.rates_date, '%d.%m.%y в %H:%i') as rates_date FROM rates r JOIN users u ON u.id = r.user_id WHERE r.ad_id = $currLot_id";
    $result2 = mysqli_query($link, $sql2);

    if ($result2) {
        $rates = mysqli_fetch_all($result2, MYSQLI_ASSOC);
    } else {
        $error = mysqli_error($link);
        $content = renderTemplate('templates/error.php', ['error' => $error]);
    }
}

$currLot = $ads[$_GET['id']];

if (!isset($currLot)) {
    http_response_code(404);
    header("HTTP/1.0 404 Not Found");
}

// Добавление ставки
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form = $_POST;

    $required = ['cost'];
    $errors = [];
    foreach ($required as $key) {
        if (empty($_POST[$key])) {
            $errors[$key] = 'Это поле надо заполнить';
        }
    }

    if (count($errors)) {
        $page_content = renderTemplate('templates/lot.php', ['form' => $form, 'rates' => $rates, 'errors' => $errors]);
    } else {

        // Записываем данные в БД
        if (!$link) {
            $error = mysqli_connect_error();
            $content = renderTemplate('templates/error.php', ['error' => $error]);
        } else {

            $user_id = $_SESSION['user']['id'];
            $ad_id = $currLot['id'];
            $price = $form['cost'];

            $sql = "INSERT INTO rates (user_id, ad_id, price, rates_date) VALUES (?, ?, ?, NOW())";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, 'sss', $user_id, $ad_id, $price);
            mysqli_stmt_execute($stmt);

            header("Refresh:0");

            if (!$stmt) {
                $error = mysqli_error($link);
                $content = renderTemplate('templates/error.php', ['error' => $error]);
            }
        }
    }
} else {
    $page_content = renderTemplate('templates/lot.php', []);
}

$page_content = renderTemplate('templates/lot.php', ['lot' => $currLot, 'rates' => $rates, 'date' => $untilMidnightDate]);

$layout_content = renderTemplate('templates/layout.php',
    [
        'categories' => $categories,
        'title' => 'Название страницы',
        'content' => $page_content
    ]);


print ($layout_content);
?>
