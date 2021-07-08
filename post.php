<?php

require_once('components/header.php');
require_once('components/navbar.php');

$img = [];

$postInfo = mysqli_query($link, "SELECT * FROM `posts` WHERE `id` = '$_GET[id]'");
feedbackCheck($postInfo, 'post');
$postInfo = mysqli_fetch_assoc($postInfo);

$ownerInfo = mysqli_query($link, "SELECT `name`, `phone` FROM `users` WHERE `id` = '$postInfo[owner_id]'");
feedbackCheck($ownerInfo, 'user');
$ownerInfo = mysqli_fetch_assoc($ownerInfo);

if (isset($postInfo['img'])){
    $img = json_decode($postInfo['img'], true);
}

$date = json_decode($postInfo['regdate'], true);
$displayDate = $date['mday'] . '.' . $date['mon'] . '.' . $date['year'] . ', ' . $date['hours'] . ':' . $date['minutes'] . ':' . $date['seconds'];

?>

    <main class="mt-5 mx-2">
        <a href="index.php" class="py-3 m-3"><- Go back</a>
        <div class="d-flex justify-content-center d-md-none col-12 flex-column text-center">
            <div class="d-flex justify-content-center">
                <?php if (isset($img)){
                    echo '<img src="' . $img['data']['url'] . '" class="img-fluid col-9 my-3" style="max-height: 500px;">';
                } else { echo '<i class="fas fa-question-square text-decoration-none text-dark my-1" style="font-size: 490px;margin-right: 400px;"></i>'; } ?>
            </div>
            <h3 class="text-break mt-3"><?= $postInfo['header'] ?></h3>
            <div class="border border border-warning mb-3"></div>
            <span class="text-break"><?= $postInfo['desc'] ?></span>
            <div class="border border-dark rounded p-3 my-3 d-flex flex-column w-100 mx-auto text-center">
                <a href="user.php?id=<?= $postInfo['owner_id'] ?>"
                   class="text-decoration-none text-dark"
                   style="font-size: 20px;">
                    <i class="fas fa-user"></i>
                    <u><?= $ownerInfo['name'] ?></u>
                </a>
                <a href="tel:<?= $ownerInfo['phone'] ?>"
                   class="text-decoration-none text-dark"
                   style="font-size: 20px;">
                    <i class="fas fa-phone"></i>
                    <u><?= $ownerInfo['phone'] ?></u>
                </a>
                <div class="my-2" style="border: 1px dashed #ffc107;"></div>
                <a href="https://www.google.com/maps/search/<?= $postInfo['location'] ?>/"
                   class="text-decoration-none text-dark"
                   style="font-size: 20px;">
                    <i class="fas fa-map-marker-alt"></i>
                    <u><?= $postInfo['location'] ?></u>
                </a>
                <a href="https://time.is/"
                   class="text-decoration-none text-dark"
                   style="font-size: 20px;">
                    <i class="fas fa-calendar-day"></i>
                    <u><?= $displayDate ?></u>
                </a>
            </div>
        </div>
        <div class="d-none d-md-flex flex-row">
            <div class="d-flex flex-column mx-3">
                <?php if (isset($img)){
                    echo "<div class='d-flex justify-content-center'><img src='{$img['data']['url']}' class='img-fluid my-1' style='max-height: 300px;max-width: 500px;'></div>";
                } else {
                    echo '<i class="fas fa-question-square text-decoration-none text-dark my-1" style="font-size: 300px;"></i>';
                } ?>
                <div class="rounded border border-dark d-flex flex-column p-3 my-2" style="min-width: 265px;">
                    <a href="user.php?id=<?= $postInfo['owner_id'] ?>"
                       class="text-decoration-none text-dark"
                       style="font-size: 20px;">
                        <i class="fas fa-user"></i>
                        <u><?= $ownerInfo['name'] ?></u>
                    </a>
                    <a href="tel:<?= $ownerInfo['phone'] ?>"
                       class="text-decoration-none text-dark"
                       style="font-size: 20px;">
                        <i class="fas fa-phone"></i>
                        <u><?= $ownerInfo['phone'] ?></u>
                    </a>
                    <div class="my-2" style="border: 1px dashed #ffc107;"></div>
                    <a href="https://www.google.com/maps/search/<?= $postInfo['location'] ?>/"
                       class="text-decoration-none text-dark"
                       style="font-size: 20px;">
                        <i class="fas fa-map-marker-alt"></i>
                        <u><?= $postInfo['location'] ?></u>
                    </a>
                    <a href="https://time.is/"
                       class="text-decoration-none text-dark"
                       style="font-size: 20px;">
                        <i class="fas fa-calendar-day"></i>
                        <u><?= $displayDate ?></u>
                    </a>
                    <!--            <button class="p-2">Hey</button>-->
                </div>
            </div>
            <div class="d-flex flex-column px-5 mt-3">
                <h1 class="text-break"><?= $postInfo['header'] ?></h1>
                <div class="border border border-warning mb-3"></div>
                <span class="text-break"><?= $postInfo['desc'] ?></span>
            </div>
        </div>
    </main>

<?php require_once('components/footer.php'); ?>