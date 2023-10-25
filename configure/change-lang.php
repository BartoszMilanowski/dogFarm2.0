<?php
session_start();

$redirect;

if (isset($_SERVER['HTTP_REFERER'])) {
    $redirect = $_SERVER['HTTP_REFERER'];
} else {
    $redirect = 'index.php';
}

$_SESSION['lang_by_user'] = true;

if ($_SESSION['lang'] == 'pl') {
    $_SESSION['lang'] = 'en';
    header('Location:' . $redirect);
    exit();
} else {
    $_SESSION['lang'] = 'pl';
    header('Location:' . $redirect);
    exit();
}