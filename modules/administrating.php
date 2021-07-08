<?php

trim($_POST['postId']);
trim($_POST['userId']);

if ($_POST['action'] == 'deletePost' && $_POST['postId'] != '') {
    if (mysqli_num_rows(mysqli_query($link, "SELECT `id` FROM `posts` WHERE `id` = '$_POST[postId]' > 0"))) {
        mysqli_query($link, "DELETE FROM `posts` WHERE `id` = '$_POST[postId]'");
        $feedback['deletePost'] = "Post #{$_POST['postId']} have been deleted";
    } else {
        $feedback['deletePost'] = "There is no post with id = " . $_POST['postId'];
    }
} elseif ($_POST['postId'] == '' && $_POST['action'] == 'deletePost') {
    $feedback['deletePost'] = 'Input cannot be blank';
}

if ($_POST['action'] == 'deleteUser' && $_POST['userId'] != '') {
    if (mysqli_num_rows(mysqli_query($link, "SELECT `id` FROM `users` WHERE `id` = '$_POST[userId]' > 0"))) {
        mysqli_query($link, "DELETE FROM `users` WHERE `id` = '$_POST[userId]'");
        $feedback['deleteUser'] = "User #{$_POST['userId']} have been deleted";
    } else {
        $feedback['deleteUser'] = "There is no user with id = " . $_POST['userId'];
    }
} elseif ($_POST['userId'] == '' && $_POST['action'] == 'deleteUser') {
    $feedback['deleteUser'] = 'Input cannot be blank';
}

if ($_POST['action'] == 'updateUserInfo0' && $_POST['userId'] != '') {
    if (mysqli_num_rows(mysqli_query($link, "SELECT `id` FROM `users` WHERE `id` = '$_POST[userId]' > 0"))) {
        $profileInfo = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `users` WHERE `id` = '$_POST[userId]'"));
        $display1 = 'd-none';
        $display2 = '';
    } else {
        $feedback['updateUserInfo0'] = "There is no user with id = " . $_POST['userId'];
    }
} elseif ($_POST['userId'] == '' && $_POST['action'] == 'updateUserInfo0') {
    $feedback['updateUserInfo0'] = 'Input cannot be blank';
}

if ($_POST['action'] == 'updateUserInfo1'){

    $score = 0;
    $check = $_POST['check'];

    preg_match('/[0-9]+[+]$/', $check['phone'], $symbols['phone']);
    preg_match('/[a-zA-Z]+[А-Яа-яёЁЇїІіЄєҐґ]+[а-щА-ЩЬьЮюЯяЇїІіЄєҐґ]$/', $check['name'], $symbols['name']);
    preg_match('/[a-zA-Z0-9]+[А-Яа-яёЁЇїІіЄєҐґ]+[а-щА-ЩЬьЮюЯяЇїІіЄєҐґ]+[()#:.?!|&_@]$/', $check['pass'], $symbols['pass']);
    preg_match('/[a-zA-Z0-9]+[А-Яа-яёЁЇїІіЄєҐґ]+[а-щА-ЩЬьЮюЯяЇїІіЄєҐґ]+[()#:.?!|&_]$/', $check['login'], $symbols['login']);
    preg_match('/[a-zA-Z0-9]+[А-Яа-яёЁЇїІіЄєҐґ]+[а-щА-ЩЬьЮюЯяЇїІіЄєҐґ]+[()#:.?!|&_@]$/', $check['email'], $symbols['email']);

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

    if (strlen($check['login']) < 4) {
        addFeedback('login', 'Min. length of login - 4 characters');
    } elseif (!empty($symbols['login'])) {
        addFeedback('login', 'You entered prohibited characters. Allowed are [a-Z][0-9][()#:.?!|&_@]');
    } elseif (strlen($check['login']) > 64){
        addFeedback('login', 'Max. length of login - 64 characters');
    } else{
        ++$score;
    }

    if (strlen($check['phone']) < 4) {
        addFeedback('phone', 'Min. length of phone - 4 characters');
    } elseif (!empty($symbols['phone'])) {
        addFeedback('phone', 'You entered prohibited characters. Allowed are [a-Z][0-9][()#:.?!|&_@]');
    } elseif (strlen($check['phone']) > 128){
        addFeedback('phone', 'Max. length of email - 128 characters');
    } else{
        ++$score;
    }

    if (!empty(trim($check['pass']))){
        if (strlen($check['pass']) < 4) {
            addFeedback('pass', 'Min. length of password - 4 characters');
        } elseif (!empty($symbols['pass'])) {
            addFeedback('pass', 'You entered prohibited characters. Allowed are [a-Z][0-9][()#:.?!|&_@]');
        } elseif (strlen($check['pass']) > 128) {
            addFeedback('pass', 'Max. length of password - 128 characters');
        } else {
            $score = $score + 2;
        }
    } else{
        ++$score;
    }

    if($score == 5){
        if(mysqli_query($link, "UPDATE `users` SET `name` = '$check[name]', `email` = '$check[email]', `phone` = '$check[phone]', `login` = '$check[login]' WHERE `id` = '$_POST[userId]'")){
            $display1 = '';
            $display2 = 'd-none';
            $feedback['updateUserInfo0'] = 'User info updated succesfully';
        }
    } elseif ($score == 6){
        $pass = password_hash($check['pass'], PASSWORD_DEFAULT);
        if(mysqli_query($link, "UPDATE `users` SET `name` = '$check[name]', `email` = '$check[email]', `phone` = '$check[phone]', `login` = '$check[login]', `password` = '$pass' WHERE `id` = '$_POST[userId]'")){
            $display1 = '';
            $display2 = 'd-none';
            $feedback['updateUserInfo0'] = 'User info updated succesfully';
        }
    } else{
        $display1 = 'd-none';
        $display2 = '';
    }
}

if ($_POST['action'] == 'editUserRole' && $_POST['userId'] != '') {
    if (mysqli_num_rows(mysqli_query($link, "SELECT `role` FROM `users` WHERE `id` = '$_POST[userId]' > 0"))) {
        mysqli_query($link, "UPDATE `users` SET `role` = '$_POST[userRole]' WHERE `id` = '$_POST[userId]'");
        $feedback['editUserRole'] = 'User role updated';
    } else {
        $feedback['editUserRole'] = "There is no user with id = " . $_POST['userId'];
    }
} elseif ($_POST['userId'] == '' && $_POST['action'] == 'editUserRole') {
    $feedback['editUserRole'] = 'Input cannot be blank';
}
