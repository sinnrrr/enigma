<?php

require_once('modules/connection.php');


if (!empty($_POST['check'])) {
    define('IS_POST_REQUEST', true);

    global $score;

    $score = 0;
    $check = $_POST['check'];
    $checked = false;
    $symbols = [];

    preg_match('/[a-zA-Z0-9]+[А-Яа-яёЁЇїІіЄєҐґ]+[а-щА-ЩЬьЮюЯяЇїІіЄєҐґ]+[()#:.?!|&_@]$/', $check['email'], $symbols['email']);
    preg_match('/[a-zA-Z0-9]+[А-Яа-яёЁЇїІіЄєҐґ]+[а-щА-ЩЬьЮюЯяЇїІіЄєҐґ]+[()#:.?!|&_@]$/', $check['pass'], $symbols['pass']);


    if (strlen($check['email']) < 4) {
        addFeedback('email', 'Min. length of email - 4 characters');
    } elseif (!empty($symbols['email'])) {
        addFeedback('email', 'You entered prohibited characters. Allowed are [a-Z][0-9][()#:.?!|&_@]');
    } elseif (strlen($check['email']) > 128){
        addFeedback('email', 'Max. length of email - 128 characters');
    } else{
        ++$score;
    }

    if (strlen($check['pass']) < 4) {
        addFeedback('pass', 'Min. length of password - 4 characters');
    } elseif (!empty($symbols['pass'])) {
        addFeedback('pass', 'You entered prohibited characters. Allowed are [a-Z][0-9][()#:.?!|&_@]');
    } elseif (strlen($check['pass']) > 128) {
        addFeedback('pass', 'Max. length of password - 128 characters');
    } else {
        ++$score;
    }

    if ($check['cb'] == 'cbt') {
        $checked = true;
    } else {
        $checked = false;
    }

    if ($score == 2 and isset($_POST['send'])) {
        if (mysqli_num_rows(mysqli_query($link, "SELECT * FROM `users` WHERE `email`='$check[email]'")) > 0){

            $result = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `users` WHERE `email`='$check[email]'"));
            $pass_verify = password_verify(trim($check['pass']), $result['password']);

            if ($pass_verify == true){
                if ($checked === false){

                    $_SESSION['profileInfo'] = $result;
                    $_SESSION['auth'] = true;

                    setcookie("auth", false, time()+3600*24*3);
                    setcookie("profileInfo");

                    header("Location: index.php?lang={$_GET['lang']}");
                    die();

                } elseif ($checked === true){

                    unset($_SESSION);
                    $_SESSION["auth"] = false;

//                    foreach ($result as $r){
//                        setcookie('profileInfo[$r]', $result[$r], time()+3600*24*3);
//                    }

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

                    setcookie("auth", true, time()+3600*24*3);
                    setcookie("identifier", $_SESSION['identifier'], time()+3600*24*3);


                    header("Location: index.php?lang={$_GET['lang']}");
                    die();

                } else { echo 'Something went really wrong :('; }
            } else {
                addFeedback('pass', 'Password is incorrect');
            }
        } else {
            addFeedback('pass', '');
            addFeedback('email', 'There is no user with such email');
        }
    }
}
