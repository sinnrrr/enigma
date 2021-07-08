<?php

require_once('components/header.php');
require_once('components/navbar.php');

?>

<section class="d-flex justify-content-center">
    <div class="border border-dark m-5 p-5 col-11 col-xl-9 text-center rounded">
        <span class="font-weight-bolder" style="font-size: 48px;">Lorem Ipsum</span><br>
        <?= $dictionary['aboutUs'] ?>
    </div>
</section>

<?php require_once('components/footer.php')?>
