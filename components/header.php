<?php

session_start();
ob_start();

require_once('components/languages.php');
require_once('modules/connection.php');
require_once('modules/functions.php');

if (isset($_COOKIE['lang']) && !isset($_GET['lang'])) {
    $_GET['lang'] = $_COOKIE['lang'];
} elseif (isset($_COOKIE['lang']) && isset($_GET['lang']) && $_COOKIE['lang'] != $_GET['lang']){
    setcookie('lang', $_GET['lang'], time()+3600*24*3);
} elseif (!isset($_COOKIE['lang']) && isset($_GET['lang'])){
    setcookie('lang', $_GET['lang'], time()+3600*24*3);
}

if (isset($_GET['lang'])) {
    setcookie("lang", $_GET['lang'], time() + 3600 * 24 * 3);
}

if (!isset($_GET['lang']) && !isset($_COOKIE['lang'])) {
    $_GET['lang'] = 'ua';
    setcookie('lang', 'ua', time() + 3600 * 24 * 3);
}

$dictionary = $vocabulary[$_GET['lang']];

$salt1 = "Jn6zL";
$salt2 = "Mxb34s";

$_SESSION['identifier'] = md5($salt1 . session_id() . $salt2);

if (!isset($_SESSION['auth'])) {
    $_SESSION['auth'] = null;
}

if (!isset($_COOKIE['auth'])) {
    setcookie('auth', null, time() + 3600 * 24 * 3);
}

if (empty($_SESSION['profileInfo'])) {
    $_SESSION['auth'] = false;
} elseif (empty($_COOKIE['profileInfo'])) {
    setcookie('auth', 0, time() + 3600 * 24 * 3);
}

if (isset($_SESSION['auth']) && $_SESSION['auth'] == true && isset($_SESSION['profileInfo'])){
    $tempId = $_SESSION['profileInfo']['id'];
    $result = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `users` WHERE `id` = '$tempId'"));
    $_SESSION['profileInfo'] = $result;
    $_POST['profileInfo'] = $result;
}elseif (isset($_COOKIE['auth']) && $_COOKIE['auth'] == true && isset($_COOKIE['profileInfo'])){
    $tempId = $_COOKIE['profileInfo']['id'];
    $result = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `users` WHERE `id` = '$tempId'"));
    setcookie("profileInfo[id]", $result['id'], time()+3600*24*3);
    setcookie("profileInfo[uid]", $result['uid'], time()+3600*24*3);
    setcookie("profileInfo[name]", $result['name'], time()+3600*24*3);
    setcookie("profileInfo[email]", $result['email'], time()+3600*24*3);
    setcookie("profileInfo[password]", $result['password'], time()+3600*24*3);
    setcookie("profileInfo[login]", $result['login'], time()+3600*24*3);
    setcookie("profileInfo[phone]", $result['phone'], time()+3600*24*3);
    setcookie("profileInfo[address]", $result['address'], time()+3600*24*3);
    setcookie("profileInfo[checked1]", $result['checked1'], time()+3600*24*3);
    setcookie("profileInfo[checked2]", $result['checked2'], time()+3600*24*3);
    setcookie("profileInfo[status]", $result['status'], time()+3600*24*3);
    setcookie("profileInfo[regdate]", $result['regdate'], time()+3600*24*3);
    setcookie("profileInfo[role]", $result['role'], time()+3600*24*3);
    $_POST['profileInfo'] = $result;
}

$basename = basename($_SERVER['SCRIPT_FILENAME']);
$indexName = substr(ucfirst($basename), 0, strpos($basename, '.php'));

if (isset($_POST['profileInfo'])){
    if ($_POST['profileInfo']['role'] == 0){
        $roleName = 'User';
    }elseif($_POST['profileInfo']['role'] == 1){
        $roleName = 'Moderator';
    }elseif($_POST['profileInfo']['role'] == 2){
        $roleName = 'Root';
    }
}

//$dontSkipIt = ($basename == 'index.php')
//    || ($basename == 'signin.php')
//    || ($basename == 'signup.php');
//if ($_SESSION['auth'] == false || $_COOKIE['auth'] == 0 && $dontSkipIt) {
//        header("Location: signup.php");
//        die();
//}

//var_dump(mb_detect_encoding($_POST['profileInfo']));

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="theme-color" content="#FFC107">
    <title>Enigma | <?= $indexName ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"/>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/all.min.css">
</head>

<body>