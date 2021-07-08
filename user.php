<?php

require_once('components/header.php');
require_once('components/navbar.php');

$userInfo = mysqli_query($link, "SELECT * FROM `users` WHERE `id` = '$_GET[id]'");
feedbackCheck($userInfo, 'user');
$userInfo = mysqli_fetch_assoc($userInfo);

?>


<?php require_once('components/footer.php'); ?>
