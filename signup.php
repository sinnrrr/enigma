<?php

require_once('components/header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once('modules/registration.php');
}

?>

<div class="d-flex justify-content-center">
        <form class="col-12 col-sm-9 col-md-8 col-lg-5 col-xl-4 bg-light p-5 shadow-lg rounded" method="post">
            <h1 class="d-none d-md-block"><?= $dictionary['signUp']['header'] ?></h1>
            <h3 class="d-block d-md-none"><?= $dictionary['signUp']['header'] ?></h3>
            <hr>
            <div class="form-group">
                <label for="nameInput"><?= $dictionary['signUp']['name'] ?></label>
                <input name="check[name]" required
                       class="form-control <?= returnFeedbackClass('name') ?>"
                       id="nameInput" type="text" placeholder="<?= $dictionary['signUp']['namePlaceholder'] ?>" value="<?= getFieldValue('name') ?>">
                <?= getFeedbackBlock('name') ?>
            </div>
            <div class="form-group">
                <label for="emailInput"><?= $dictionary['signUp']['email'] ?></label>
                <input type="email" name="check[email]" required
                       class="form-control <?= returnFeedbackClass('email') ?>"
                       id="emailInput" placeholder="<?= $dictionary['signUp']['emailPlaceholder'] ?>" value=" <?= getFieldValue('email'); ?>">
                <?= getFeedbackBlock('email') ?>
            </div>
            <input type="hidden" name="check[login]"/>
            <div class="form-group">
                <label for="passwordInput0"><?= $dictionary['signUp']['pass0'] ?></label>
                <input type="password" name="check[pass0]"
                       class="form-control <?= returnFeedbackClass('pass0') ?>"
                       id="passwordInput0" placeholder="<?= $dictionary['signUp']['passPlaceholder0'] ?>"
                       value="<?= getFieldValue('pass0') ?>" required>
                <?= getFeedbackBlock('pass0') ?>
            </div>
            <div class="form-group">
                <label for="passwordInput1"><?= $dictionary['signUp']['pass1'] ?></label>
                <input type="password" name="check[pass1]"
                       class="form-control <?= returnFeedbackClass('pass1') ?>"
                       id="passwordInput1" placeholder="<?= $dictionary['signUp']['passPlaceholder1'] ?>"
                       value="<?= getFieldValue('pass1') ?>" required>
                <?= getFeedbackBlock('pass1') ?>
            </div>
            <div class="form-group form-check">
                <input type="hidden" name="check[cb1]" class="form-check-input" value="cb1f">
                <input type="checkbox" name="check[cb1]" id="checkboxInput0"
                       class="form-check-input bg-dark"
                       value="cb1t" required <?= isset($_POST['check']['cb1']) && $_POST['check']['cb1'] == 'cb1t' ? 'checked': '' ?> />
                <label class="form-check-label" for="checkboxInput0"><?= $dictionary['signUp']['termsText'] ?><a href="#"><?= $dictionary['signUp']['termsLink'] ?></a></label>
            </div>
            <div class="form-group form-check">
                <input type="hidden" name="check[cb2]" class="form-check-input" value="cb2f">
                <input type="checkbox" name="check[cb2]" class="form-check-input" id="checkboxInput1"
                       value="cb2t" <?= isset($_POST['check']['cb2']) && $_POST['check']['cb2'] == 'cb2t' ? 'checked' : '' ?>/>
                <label class="form-check-label" for="checkboxInput1"><?= $dictionary['signUp']['notifications'] ?></label>
            </div>
            <button type="submit" name="send" class="btn btn-warning font-weight-bold w-100" value="check"><?= $dictionary['submitButton'] ?></button>
            <a href="signin.php?lang=<?= $_GET['lang'] ?>" class="float-left"><?= $dictionary['signUp']['signIn'] ?></a>
            <a href="index.php?lang=<?= $_GET['lang'] ?>" class="float-right"><?= $dictionary['indexLink'] ?></a>
        </form>
    </div>
<div class="my-5 py-3 d-none d-md-block"></div>
<?php require_once('components/footer.php') ?>

