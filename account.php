<?php

require_once('components/header.php');
require_once('components/navbar.php');

$postsInfo = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `posts` WHERE `owner_id` = '{$_POST['profileInfo']['id']}'"));

if (isset($postInfo['img'])){
    $img = json_decode($postInfo['img'], true);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once('modules/info-update.php');
}

?>

<main class="m-5 d-flex justify-content-center">
<!--    <div class="d-flex justify-content-center">-->
<!--        <a href="#contactUpdate" class="bg-light">Jasdh</a>-->
<!--        <div id="contactUpdate" class="collapse">asdas</div>-->
<!--    </div>-->
    <section class="border border-dark rounded mt-3 mt-md-5 col-11 col-md-9 col-lg-6 text-center w-100 py-5">
        <form action="" method="post">
<!--            <a href="#contactContainer" data-toggle="collapse" aria-expanded="false" aria-controls="contactInput"-->
<!--               class="bg-dark text-warning col-11 col-md-9 col-lg-6">-->
<!--                Change your contact information<i class="fas fa-caret-down" style="width: 15px;"></i>-->
<!--            </a>-->
<!--            <div id="contactContainer" class="collapse bg-dark py-3">-->
<!--                <label for="numberInput" class="text-white">Your phone:</label>-->
<!--                <input id="numberInput" class="rounded" value="--><?//= $_POST['profileInfo']['number'] ?? '' ?><!--" name="phone">-->
<!--                <button type="submit">Submit</button>-->
<!--            </div>-->
            <div class="d-flex flex-column">
                <label for="numberInput">Телефон:</label>
                <input id="numberInput" type="tel" class="rounded text-center <?= returnFeedbackClass('phone') ?>" value="<?= $_POST['profileInfo']['phone'] ?? '' ?>" name="check[phone]">
                <?= getFeedbackBlock('phone') ?>
<!--                <label for="loginInput">Login:</label>-->
<!--                <input id="loginInput" class="rounded text-center --><?//= returnFeedbackClass('login') ?><!--" value="--><?//= $_POST['profileInfo']['login'] ?? '' ?><!--" name="check[login]">-->
<!--                --><?//= getFeedbackBlock('login') ?>
                <label for="emailInput">E-mail:</label>
                <input id="emailInput" type="email" class="rounded text-center <?= returnFeedbackClass('email') ?>" value="<?= $_POST['profileInfo']['email'] ?? '' ?>" name="check[email]">
                <?= getFeedbackBlock('email') ?>
                <button type="submit" class="mt-3">Зберегти зміни</button>
                <u class="mt-2"><a href="logout.php" class="text-danger">Logout</a></u>
            </div>
        </form>
    </section>
</main>

<?php require_once('components/footer.php'); ?>
