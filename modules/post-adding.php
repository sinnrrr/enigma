<?php

if (!empty($_POST['check'])) {
    define('IS_POST_REQUEST', true);

    $score = 0;
    $check = $_POST['check'];
    $symbols = [];

    preg_match('/[a-zA-Z0-9]+[А-Яа-яёЁЇїІіЄєҐґ]+[а-щА-ЩЬьЮюЯяЇїІіЄєҐґ]+[()#:.?!|&_@]$/', $check['header'], $symbols['header']);
    preg_match('/[a-zA-Z0-9]+[А-Яа-яёЁЇїІіЄєҐґ]+[а-щА-ЩЬьЮюЯяЇїІіЄєҐґ]+[()#:.?!|&_@]$/', $check['desc'], $symbols['desc']);
    preg_match('/[a-zA-Z0-9]+[А-Яа-яёЁЇїІіЄєҐґ]+[а-щА-ЩЬьЮюЯяЇїІіЄєҐґ]+[()#:.?!|&_@]$/', $check['location'], $symbols['location']);

    if (strlen($check['header']) < 4) {
        addFeedback('header', 'Min. length of header - 4 characters');
    } elseif (!empty($symbols['header'])) {
        addFeedback('header', 'You entered prohibited characters. Allowed are [a-Z]');
    } elseif (strlen($check['header']) > 128) {
        addFeedback('header', 'Max. length of header - 128 characters');
    } else {
        ++$score;
    }

    if (strlen($check['desc']) < 10) {
        addFeedback('desc', 'Min. length of short description - 10 characters');
    } elseif (!empty($symbols['desc'])) {
        addFeedback('desc', 'You entered prohibited characters. Allowed are [a-Z]');
    } elseif (strlen($check['desc']) > 2048) {
        addFeedback('desc', 'Max. length of header - 2048 characters');
    } else {
        ++$score;
    }

    if (strlen($check['location']) < 4) {
        addFeedback('location', 'Min. length of location - 4 characters');
    } elseif (!empty($symbols['location'])) {
        addFeedback('location', 'You entered prohibited characters. Allowed are [a-Z]');
    } elseif (strlen($check['location']) > 128) {
        addFeedback('location', 'Max. length of header - 128 characters');
    } else {
        ++$score;
    }

    if (empty($profileInfo['phone'])) {
        addFeedback('phone', 'Fill in your phone to post <a href="account.php" class="text-decoration-none">here</a>');
    } else {
        ++$score;
    }

    $query = "SELECT `id` FROM `posts` WHERE `header` = '{$check['header']}' AND `desc` = '{$check['desc']}' AND `location` = '{$check['location']}'";
    $queryResult = mysqli_query($link, $query);

    if (mysqli_num_rows($queryResult) == 0) {
        ++$score;
    } else {
        addFeedback("desc", "");
        addFeedback("location", "");
        addFeedback("header", "The same post with filled information already exists. Please, change your info in order to post it");
    }

    if ($score == 5) {

        $result = mysqli_fetch_assoc(mysqli_query($link, "SELECT MAX(`id`) as `id` FROM `posts`"));
        ++$result['id'];

        $uid = session_id() . '_' . $result['id'];

        $uid = uniqid();
        $date = json_encode(getdate());

        if (!empty($_SESSION['profileInfo'])) {
            $email = $_SESSION['profileInfo']['email'];
            $name = $_SESSION['profileInfo']['name'];
        } elseif (!empty($_COOKIE['profileInfo'])) {
            $email = $_COOKIE['profileInfo']['email'];
            $name = $_COOKIE['profileInfo']['name'];
        }

        if (!empty($_FILES['pictures']['tmp_name'])) {
//            foreach ($_FILES["pictures"]["error"] as $key => $error) {
//                if ($error == UPLOAD_ERR_OK) {
//
//                    $tmp_name = $_FILES["pictures"]["tmp_name"][$key];
//                    $name = basename($_FILES["pictures"]["name"][$key]);
//                    move_uploaded_file($tmp_name, "upload/$name");
//
//                    $base64 = base64_encode(file_get_contents("upload/$name"));
//                    $ch = curl_init("https://api.imgbb.com/1/upload?key=e4011dff7f54ea578719457e758d21b7");
//
//                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//                    curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
//                    curl_setopt($ch, CURLOPT_POST, true);
//                    curl_setopt($ch, CURLOPT_POSTFIELDS, array('image' => $base64));
//
//                    $feedback = curl_exec($ch);
//                }
//            }

            $tmp_name = $_FILES["pictures"]["tmp_name"];
            $name = basename($_FILES["pictures"]["name"]);
            move_uploaded_file($tmp_name, "upload/$name");

            $base64 = base64_encode(file_get_contents("upload/$name"));
            $ch = curl_init("https://api.imgbb.com/1/upload?key=e4011dff7f54ea578719457e758d21b7");

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, array('image' => $base64));

            $img = curl_exec($ch);
        }

        if (mysqli_query($link, "INSERT INTO `posts` VALUES (NULL, '$profileInfo[id]', '$uid', '$check[header]', '$check[category]', '$check[desc]', '$img', '$check[location]', '$date', '$check[status]', NULL)")) {
            header("Location: index.php?lang={$_GET['lang']}");
            die();
        } else {
            echo 'Error handling request';
        }
    }
}
