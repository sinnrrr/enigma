<?php

if (!empty($_POST['check'])) {
    define('IS_POST_REQUEST', true);

    global $score;

    $score = 0;

    $checked1 = false;
    $checked2 = false;

    $check = $_POST['check'];

    $symbols = [];

    preg_match('/[a-zA-Z]+[А-Яа-яёЁЇїІіЄєҐґ]+[а-щА-ЩЬьЮюЯяЇїІіЄєҐґ]$/', $check['name'], $symbols['name']);
    preg_match('/[a-zA-Z0-9]+[А-Яа-яёЁЇїІіЄєҐґ]+[а-щА-ЩЬьЮюЯяЇїІіЄєҐґ]+[()#:.?!|&_@]$/', $check['email'], $symbols['email']);
    preg_match('/[a-zA-Z0-9]+[А-Яа-яёЁЇїІіЄєҐґ]+[а-щА-ЩЬьЮюЯяЇїІіЄєҐґ]+[()#:.?!|&_@]$/', $check['pass0'], $symbols['pass0']);
    preg_match('/[a-zA-Z0-9]+[А-Яа-яёЁЇїІіЄєҐґ]+[а-щА-ЩЬьЮюЯяЇїІіЄєҐґ]+[()#:.?!|&_@]$/', $check['pass1'], $symbols['pass1']);

    if (strlen($check['name']) < 2) {
        addFeedback('name', 'Min. length of name - 2 characters');
    } elseif (!empty($symbols['name'])) {
        addFeedback('name', 'You entered prohibited characters. Allowed are [a-Z]');
    } elseif (strlen($check['name']) > 20) {
        addFeedback('name', 'Max. length of name - 20 characters');
    } else{
        ++$score;
    }

    if (strlen($check['email']) < 4) {
        addFeedback('email', 'Min. length of email - 4 characters');
    } elseif (!empty($symbols['email'])) {
        addFeedback('email', 'You entered prohibited characters. Allowed are [a-Z][0-9][()#:.?!|&_@]');
    } elseif (strlen($check['email']) > 128){
        addFeedback('email', 'Max. length of email - 128 characters');
    } else{
        ++$score;
    }

    if (strlen($check['pass0']) < 4) {
        addFeedback('pass0', 'Min. length of password - 4 characters');
    } elseif (!empty($symbols['pass0'])) {
        addFeedback('pass0', 'You entered prohibited characters. Allowed are [a-Z][0-9][()#:.?!|&_@]');
    } elseif (strlen($check['pass0']) > 128) {
        addFeedback('pass0', 'Max. length of password - 128 characters');
    } else {
        ++$score;
    }

    if (strlen($check['pass1']) < 4) {
        addFeedback('pass1', 'Min. length of password - 4 characters');
    } elseif (!empty($symbols['pass1'])) {
        addFeedback('pass1', 'You entered prohibited characters. Allowed are [a-Z][0-9][()#:.?!|&_@]');
    } elseif (strlen($check['pass1']) > 128) {
        addFeedback('pass1', 'Max. length of password - 128 characters');
    } else {
        ++$score;
    }

    if (!empty($check['pass0'] != $check['pass1'])) {
        addFeedback('pass0', '');
        addFeedback('pass1', 'Password must match each other');
    } else if (isset($check['pass0']) || isset($check['pass1'])) {
        ++$score;
    }

    if ($check['cb1'] == 'cb1t') {
        $checked1 = true;
        ++$score;
    } else if ($check['cb1'] == 'cb1f') {
        $checked1 = false;
    }

    if ($check['cb2'] == 'cb2t') {
        $checked2 = true;
    } else {
        $checked2 = false;
    }

//                when the button is clicked and all inputs are filled right
if ((isset($_POST['send'])) and ($score == 6)) {

    $name = ucfirst(trim($check['name']));
    $email = trim($check['email']);
    $check['login'] = trim($check['email']);
    $login = substr($check['login'], 0, strpos($check['login'], "@"));
    $pass = password_hash(trim($check['pass0']), PASSWORD_DEFAULT);

    require_once 'modules/connection.php';

    $query = mysqli_query($link, "SELECT * FROM enigma.users WHERE email='$email'");
    if (mysqli_num_rows($query) > 0) {
        addFeedback('email', 'User with this email already exists.');
    } else {
        $uid = uniqid();
        $date = date("c");

        $query = "INSERT INTO `users` VALUES (NULL, '$uid', '$name', '$email', '$pass', '$login', NULL, NULL, '$checked1', '$checked2', NULL, '$date', '0');";

        if (mysqli_query($link, $query)){

            $_SESSION['profileInfo'] = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `users` WHERE `uid` = '$uid'"));
            $_SESSION['auth'] = true;

            setcookie('auth', false, time()+3600*24*3);

            header("Location: index.php?lang={$_GET['lang']}");
            die();

        } else {
            echo 'Error handling request';
        }
    }
    mysqli_close($link);
}}
