<?php

require_once('components/header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once('modules/login.php');
}

?>
    <div class="d-flex justify-content-center my-auto">
        <form class="col-12 col-sm-9 col-md-8 col-lg-5 col-xl-4 bg-light p-5 shadow-lg rounded" method="post">
            <h1 class="d-none d-md-block"><?= $dictionary['signIn']['header'] ?></h1>
            <h3 class="d-block d-md-none"><?= $dictionary['signIn']['header'] ?></h3>
            <hr>
            <div class="form-group">
                <label for="emailInput"><?= $dictionary['signIn']['email'] ?></label>
                <input type="email" name="check[email]"
                       class="form-control <?= returnFeedbackClass('email') ?>"
                       id="emailInput" placeholder="<?= $dictionary['signIn']['emailPlaceholder'] ?>" value="<?= getFieldValue('email'); ?>" required>
                <?= getFeedbackBlock('email'); ?>
            </div>
            <div class="form-group">
                <label for="passwordInput"><?= $dictionary['signIn']['pass'] ?></label>
                <input type="password" name="check[pass]"
                       class="form-control <?= returnFeedbackClass('pass') ?>"
                       id="passwordInput" placeholder="<?= $dictionary['signIn']['passPlaceholder'] ?>" required
                       value="<?= getFieldValue('pass') ?>">
                <?= getFeedbackBlock('pass') ?>
            </div>
            <div class="form-group form-check float-left">
                <input type="hidden" name="check[cb]" class="form-check-input" value="cbf">
                <input type="checkbox" name="check[cb]" id="checkInput" class="form-check-input" value="cbt" <?= isset($_POST['check']['cb']) && $_POST['check']['cb'] == 'cbt' ? 'checked' : '' ?>/>
                <label class="form-check-label" for="checkInput"><?= $dictionary['signIn']['stayLogged'] ?></label>
            </div>
            <a href="recovery.php" class="float-right"><?= $dictionary['signIn']['forgotPass'] ?></a>
            <button type="submit" name="send" class="btn btn-warning" value="check"
                    style="width: 100%; font-weight: bold;"><?= $dictionary['submitButton'] ?></button>
            <a href="signup.php?lang=<?= $_GET['lang'] ?>" class="float-left"><?= $dictionary['signIn']['signUp'] ?></a>
            <a href="index.php?lang=<?= $_GET['lang'] ?>" class="float-right"><?= $dictionary['indexLink'] ?></a>
        </form>
    </div>
    <div class="my-5 py-3 d-none d-md-block"></div>
<?php require_once('components/footer.php'); ?>