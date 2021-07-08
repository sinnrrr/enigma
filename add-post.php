<?php

require_once('components/header.php');

if (empty($_COOKIE['profileInfo']) && empty($_SESSION['profileInfo'])) {
    echo "<div class='border border-dark d-flex flex-column justify-content-center text-center mx-auto my-5 p-3 p-md-5 col-9 rounded bg-dark shadow-lg'><span class='fas fa-user-slash text-warning text-center my-3' style='font-size: 200px;'></span><span class='text-warning font-weight-bold' style='font-size: 28px;'>{$dictionary['errors']['noUserLogon']['main']}</span><span class='text-warning font-weight-bold mt-5' style='font-size: 28px;'>{$dictionary['errors']['noUserLogon']['clickTo']}<a href='signin.php' class='text-decoration-none'>{$dictionary['errors']['noUserLogon']['signIn']}</a> {$dictionary['errors']['noUserLogon']['or']} <a href='signup.php' class='text-decoration-none'>{$dictionary['errors']['noUserLogon']['signUp']}</a></span></div>";
    die();
}

if (isset($_SESSION['profileInfo'])) {
    $profileInfo['id'] = $_SESSION['profileInfo']['id'];
} elseif (isset($_COOKIE['profileInfo'])) {
    $profileInfo['id'] = $_COOKIE['profileInfo']['id'];
}

function categorySelected($category)
{
    if (isset($_POST['check']['category']) && $category == $_POST['check']['category']) {
        return 'selected';
    } else {
        return '';
    }
}

function statusSelected($status){
    if (isset($_POST['check']['status']) && $status == $_POST['check']['status']){
        return 'selected';
    } else {
        return '';
    }
}

$profileInfo = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `users` WHERE `id` = $profileInfo[id]"));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once('modules/post-adding.php');
}

//var_dump($profileInfo);
//echo '<br>';
//var_dump($_SESSION);
//echo '<br>';
//var_dump($_COOKIE);

?>

<section class="bg-warning d-flex justify-self-center justify-content-center col-12">
    <div class="bg-dark col-12 col-sm-9 col-xl-6 rounded py-3 my-3">
        <form action="" method="post" enctype="multipart/form-data">
            <h1 class="d-none d-md-block font-weight-bolder text-warning py-3 text-center"><?= $dictionary['addPost']['header'] ?></h1>
            <h2 class="d-block d-md-none font-weight-bolder text-warning py-2 text-center"><?= $dictionary['addPost']['header'] ?></h2>
            <div class="form-group px-1 px-md-3">
                <span class="font-weight-bold text-white"
                      style="font-size: 20px;"><?= $dictionary['addPost']['title1']['text'] ?></span>
                <hr>
            </div>
            <div class="form-group px-1 px-md-5">
                <label for="headerInput" class="text-white"><?= $dictionary['addPost']['title1']['header'] ?></label>
                <input type="text" name="check[header]" required
                       class="form-control <?= returnFeedbackClass('header') ?>"
                       value="<?= getFieldValue('header'); ?>" id="headerInput"
                       placeholder="<?= $dictionary['addPost']['title1']['headerPlaceholder'] ?>">
                <?= getFeedbackBlock('header') ?>
            </div>
            <div class="form-group px-1 px-md-5">
                <label for="locationInput"
                       class="text-white"><?= $dictionary['addPost']['title1']['location'] ?></label>
                <input type="text" name="check[location]"
                       class="form-control <?= returnFeedbackClass('location') ?>" id="locationInput"
                       placeholder="<?= $dictionary['addPost']['title1']['locationPlaceholder'] ?>" required
                       value="<?= getFieldValue('location'); ?>">
                <?= getFeedbackBlock('location') ?>
            </div>
            <div class="form-group px-1 px-md-5">
                <label for="categorySelect" class="text-white"
                       style="width: 100px;"><?= $dictionary['addPost']['title1']['category'] ?></label>
                <select name="check[category]" id="categorySelect" class="rounded btn bg-white col-6 col-md-4">
                    <option value="pets" <?= categorySelected('pets') ?>><?= $dictionary['index']['search']['category'][0] ?></option>
                    <option value="devices" <?= categorySelected('devices') ?>><?= $dictionary['index']['search']['category'][1] ?></option>
                    <option value="clothes" <?= categorySelected('clothes') ?>><?= $dictionary['index']['search']['category'][2] ?></option>
                    <option value="documents" <?= categorySelected('documents') ?>><?= $dictionary['index']['search']['category'][3] ?></option>
                    <option value="preciousness" <?= categorySelected('preciousness') ?>><?= $dictionary['index']['search']['category'][4] ?></option>
                    <option value="toys" <?= categorySelected('toys') ?>><?= $dictionary['index']['search']['category'][5] ?></option>
                    <option value="office" <?= categorySelected('office') ?>><?= $dictionary['index']['search']['category'][6] ?></option>
                    <option value="details" <?= categorySelected('details') ?>><?= $dictionary['index']['search']['category'][7] ?></option>
                    <option value="inventory" <?= categorySelected('inventory') ?>><?= $dictionary['index']['search']['category'][8] ?></option>
                </select>
            </div>
            <div class="form-group px-1 px-md-5">
                <label for="statusSelect" class="text-white"
                       style="width: 100px;"><?= $dictionary['addPost']['title1']['status'] ?></label>
                <select name="check[status]" class="rounded btn bg-white col-6 col-md-4" id="statusSelect">
                    <option value="lost" <?= statusSelected('lost') ?>><?= $dictionary['index']['search']['status'][0] ?></option>
                    <option value="found" <?= statusSelected('found') ?>><?= $dictionary['index']['search']['status'][1] ?></option>
                    <option value="theft" <?= statusSelected('theft') ?>><?= $dictionary['index']['search']['status'][2] ?></option>
                </select>
            </div>
            <div class="form-group px-1 px-md-3">
                <span class="font-weight-bold text-white"
                      style="font-size: 20px;"><?= $dictionary['addPost']['title2']['text'] ?></span>
                <hr>
            </div>
            <div class="form-group px-1 px-md-5">
                <label for="textArea" class="text-white"><?= $dictionary['addPost']['title2']['desc'] ?></label>
                <textarea type="text" required
                          name="check[desc]" id="textArea"
                          class="form-control px-3 <?= returnFeedbackClass('desc') ?>"
                          rows="10"><?= getFieldValue('desc'); ?></textarea>
                <?= getFeedbackBlock('desc') ?>
                <input type="file"
                       name="pictures"
                       class="text-white my-1">
                <?= getFeedbackBlock('pictures') ?>
            </div>
            <div class="form-group px-1 px-md-3">
                <span class="font-weight-bold text-white"
                      style="font-size: 20px;"><?= $dictionary['addPost']['title3']['text'] ?></span>
                <hr>
            </div>
            <div class="form-group px-1 px-md-5">
                <label for="phoneInputDisabled"
                       class="text-white"><?= $dictionary['addPost']['title3']['phone'] ?></label>
                <input type="text" name="check[phone]"
                       class="form-control <?= returnFeedbackClass('phone') ?>" id="phoneInputDisabled"
                       value="<?= !empty($profileInfo['phone']) ? $profileInfo['phone'] : 'None' ?>" disabled>
                <?= getFeedbackBlock('phone') ?>
            </div>
            <div class="form-group px-1 px-md-5">
                <label for="emailInput" class="text-white"><?= $dictionary['addPost']['title3']['email'] ?></label>
                <input type="email" name="check[email]"
                       class="form-control"
                       id="emailInput" value="<?= $profileInfo['email'] ?? '' ?>" disabled>
            </div>
            <div class="form-group px-1 px-md-5">
                <label for="nameInput" class="text-white"><?= $dictionary['addPost']['title3']['name'] ?></label>
                <input type="text" name="check[name]"
                       class="form-control"
                       id="nameInput" value="<?= $profileInfo['name'] ?? '' ?>" disabled>
            </div>
            <span class="px-1 px-md-5 text-white float-left"><?= $dictionary['addPost']['title3']['settingsText'] ?>
                <a href="account.php"
                   class="text-white text-under"><u><?= $dictionary['addPost']['title3']['settingsLink'] ?></u></a>
            </span>
            <!--            <a href="index.php" class="float-right mx-1 mx-md-5">-->
            <? //= $dictionary['indexLink'] ?><!--</a>-->
            <button type="submit" name="send" class="btn btn-warning font-weight-bold w-100 mt-3 py-2" value="check">
                <?= $dictionary['submitButton'] ?>
            </button>
        </form>
    </div>
</section>

<?php require_once('components/footer.php'); ?>
