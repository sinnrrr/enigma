<?php

$_SESSION['auth'] = false;
unset($_SESSION['profileInfo']);

setcookie('auth', 0, time() + 3600 * 24 * 3);
foreach ($_COOKIE['profileInfo'] as $data){
    setcookie("profileInfo[{$data}]", '', time()-3600*24*3);
}


header("Location: index.php");
