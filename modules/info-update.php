<?php

$check = $_POST['check'];
$symbols = [];
$score = 0;

preg_match('/[0-9]+[+]$/', $check['phone'], $symbols['phone']);
//preg_match('/[a-zA-Z]+[А-Яа-яёЁЇїІіЄєҐґ]+[а-щА-ЩЬьЮюЯяЇїІіЄєҐґ]$/', $check['login'], $symbols['login']);
preg_match('/[a-zA-Z0-9]+[А-Яа-яёЁЇїІіЄєҐґ]+[а-щА-ЩЬьЮюЯяЇїІіЄєҐґ]+[()#:.?!|&_@]$/', $check['email'], $symbols['email']);


//if (strlen($check['login']) < 4) {
//    addFeedback('login', 'Min. length of login - 4 characters');
//} elseif (!empty($symbols['login'])) {
//    addFeedback('login', 'You entered prohibited characters');
//} elseif (strlen($check['login']) > 20) {
//    addFeedback('login', 'Max. length of login - 20 characters');
//} else{
//    ++$score;
//}

if (strlen($check['email']) < 4) {
    addFeedback('email', 'Min. length of email - 4 characters');
} elseif (!empty($symbols['email'])) {
    addFeedback('email', 'You entered prohibited characters');
} elseif (strlen($check['email']) > 128){
    addFeedback('email', 'Max. length of email - 128 characters');
} else{
    ++$score;
}

if (strlen($check['phone']) < 6) {
    addFeedback('phone', 'Min. length of phone - 6 characters');
} elseif (!empty($symbols['phone'])) {
    addFeedback('phone', 'You entered prohibited characters');
} elseif (strlen($check['phone']) > 20){
    addFeedback('phone', 'Max. length of phone - 20 characters');
} else{
    ++$score;
}

if ($score == 2){
    $result = mysqli_query($link, "UPDATE `users` SET `phone` = '$check[phone]', `email` = '$check[email]' WHERE `id` = '{$_POST['profileInfo']['id']}'");
    if ($result) {
        echo 'Дані змінені';
        header("Location: index.php");
    } else {
        echo 'Помилка';
    }
} else {
    echo 'Дані мають недопустимі символи';
}