<?php

require_once('components/header.php');

if (!isset($_GET['uid']) || $_GET['uid'] != 'asdasd123') {
    echo "You're not permitted to access this page";
    die();
} elseif (!isset($_POST['profileInfo'])) {
    echo "Log in first in order to access control panel";
    die();
} elseif ($_POST['profileInfo']['role'] == 0) {
    echo "You're not permitted to access this page";
    die();
}

function containerActive($container)
{
    if (isset($_POST['action']) && $_POST['action'] == $container) {
        return 'show';
    } else {
        return '';
    }
}

function roleActive($item)
{
    if ($_POST['profileInfo']['role'] == $item) {
        return 'selected';
    } else {
        return '';
    }
}

function itemDisabled($item)
{
    if ($_POST['profileInfo']['role'] == 1) {
        if ($item == 'editUserRole') {
            return 'disabled';
        } else {
            return '';
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once('modules/administrating.php');
}

?>

    <h1 class="text-center d-none d-md-block my-4 font-weight-bolder">ENIGMA CONTROL PANEL</h1>
    <h3 class="text-center d-block d-md-none my-4 font-weight-bolder">ENIGMA CONTROL PANEL</h3>
    <form action="" method="post">
        <div class="d-flex justify-content-center">
            <div id="accordion" class="col-12 col-md-9 col-lg-6">
                <div class="card">
                    <div class="card-header bg-warning" id="headingOne">
                        <h5 class="mb-0">
                            <a role="button"
                               class="<?= itemDisabled('deletePost') ?> btn btn-link text-dark container-fluid font-weight-bold"
                               data-toggle="collapse" data-target="#collapseOne" style="font-size: 20px;"
                               aria-expanded="true" aria-controls="collapseOne">DELETE POST
                            </a>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse bg-dark <?= containerActive('deletePost') ?>"
                         aria-labelledby="headingOne"
                         data-parent="#accordion">
                        <div class="card-body text-white text-center">
                            <label for="postId" style="width: 200px;">Enter id of the post:</label>
                            <input id="postId" type="number"
                                   name="postId" class="rounded border-0 pl-2"
                                   value="<?= $_POST['postId'] ?? '' ?>" style="width: 100px;">
                            <button type="submit" name="action" value="deletePost"
                                    class="border-0 bg-warning text-dark rounded font-weight-bold">Submit
                            </button>
                            <br>
                            <span class="text-warning"><?= $feedback['deletePost'] ?? '' ?></span>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-warning" id="headingTwo">
                        <h5 class="mb-0">
                            <a role="button"
                               class="<?= itemDisabled('deleteUser') ?> btn btn-link collapsed text-dark container-fluid font-weight-bold"
                               data-toggle="collapse" style="font-size: 20px;"
                               data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                DELETE USER
                            </a>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse bg-dark <?= containerActive('deleteUser') ?>"
                         aria-labelledby="headingTwo"
                         data-parent="#accordion">
                        <div class="card-body text-white text-center">
                            <label for="userId1" style="width: 200px;">Enter id of the user:</label>
                            <input id="userId1" type="number"
                                   name="userId" class="rounded border-0 pl-2"
                                   value="<?= $_POST['userId'] ?? '' ?>" style="width: 100px;">
                            <button type="submit" name="action" value="deleteUser"
                                    class="border-0 bg-warning text-dark rounded font-weight-bold">Submit
                            </button>
                            <br>
                            <span class="text-warning"><?= $feedback['deleteUser'] ?? '' ?></span>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-warning" id="headingThree">
                        <h5 class="mb-0">
                            <a role="button"
                               class="<?= itemDisabled('deleteUser') ?> btn btn-link collapsed text-dark container-fluid font-weight-bold"
                               data-toggle="collapse" style="font-size: 20px;"
                               data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                UPDATE USER INFO
                            </a>
                        </h5>
                    </div>
                    <div id="collapseThree"
                         class="<?= containerActive('updateUserInfo1') ?> collapse bg-dark <?= containerActive('updateUserInfo0') ?>"
                         aria-labelledby="headingThree"
                         data-parent="#accordion">
                        <div class="<?= $display1 ?? '' ?> card-body text-white text-center">
                            <label for="userId2" style="width: 200px;">Enter id of the user:</label>
                            <input id="userId2" type="number"
                                   name="userId" class="rounded border-0 pl-2"
                                   value="<?= $_POST['userId'] ?? '' ?>" style="width: 100px;">
                            <button type="submit" name="action" value="updateUserInfo0"
                                    class="border-0 bg-warning text-dark rounded font-weight-bold">Submit
                            </button>
                            <br>
                            <span class="text-warning"><?= $feedback['updateUserInfo0'] ?? '' ?></span>
                        </div>
                        <div class="<?= $display2 ?? 'd-none' ?> card-body text-white text-center">
                            <div class="form-group">
                                <label for="nameInput">Name:</label>
                                <input name="check[name]"
                                       class="rounded border-0 px-2"
                                       id="nameInput" type="text" value="<?= $profileInfo['name'] ?? '' ?>">
                                <?= getFeedbackBlock('name'); ?>
                            </div>
                            <div class="form-group">
                                <label for="emailInput">Email:</label>
                                <input type="email" name="check[email]"
                                       class="rounded border-0 px-2"
                                       id="emailInput" value="<?= $profileInfo['email'] ?? '' ?>">
                                <?= getFeedbackBlock('email'); ?>
                            </div>
                            <div class="form-group">
                                <label for="phoneInput">Phone:</label>
                                <input type="text" name="check[phone]"
                                       class="rounded border-0 px-2" id="phoneInput"
                                       value="<?= $profileInfo['phone'] ?? '' ?>">
                                <?= getFeedbackBlock('phone') ?>
                            </div>
                            <div class="form-group">
                                <label for="loginInput">Login:</label>
                                <input type="text" name="check[login]"
                                       class="rounded border-0 px-2" id="loginInput"
                                       value="<?= $profileInfo['login'] ?? '' ?>">
                                <?= getFeedbackBlock('login') ?>
                            </div>
                            <div class="form-group">
                                <label for="passwordInput">New password:</label>
                                <input type="password" name="check[pass]"
                                       class="rounded border-0 px-2"
                                       id="passwordInput" placeholder="Not required"
                                       value="<?= getFieldValue('pass') ?? '' ?>">
                                <?= getFeedbackBlock('pass') ?>
                            </div>
                            <button name="action" class="" value="updateUserInfo1">Submit</button>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-warning" id="headingFour">
                        <h5 class="mb-0">
                            <a role="button"
                               class="<?= itemDisabled('editUserRole') ?> btn btn-link collapsed text-dark container-fluid font-weight-bold"
                               data-toggle="collapse" style="font-size: 20px;"
                               data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                CHANGE USER ROLE
                            </a>
                        </h5>
                    </div>
                    <div id="collapseFour" class="collapse rounded-bottom bg-dark" aria-labelledby="headingFour"
                         data-parent="#accordion">
                        <div class="card-body text-white text-center">
                            <label for="userId3" style="width: 250px;">Enter id of the user:</label>
                            <input id="userId3" type="number"
                                   name="userId" class="rounded border-0 pl-2"
                                   value="<?= $_POST['userId'] ?? '' ?>" style="width: 100px;">
                            <br>
                            <label for="roleSelection" style="width: 250px;">Select role:</label>
                            <select name="userRole" id="roleSelection" class="rounded border-0" style="width: 100px;">
                                <option <?= roleActive('0') ?> value="0">User</option>
                                <option <?= roleActive('1') ?> value="1">Moderator</option>
                                <option <?= roleActive('2') ?> value="2">Root</option>
                            </select>
                            <br>
                            <button type="submit" name="action" value="editUserRole" style="width: 354px;"
                                    class="border-0 bg-warning text-dark rounded font-weight-bold">Submit
                            </button>
                            <br>
                            <span class="text-warning"><?= $feedback['editUserRole'] ?? '' ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h5 class="text-center mt-2"><b>ACCOUNT:</b> <?= $_POST['profileInfo']['name'] ?></h5>
        <h5 class="text-center"><b>ROLE:</b> <?= $roleName ?></h5>
        <h5 class="text-center"><b>ID:</b> <?= $_POST['profileInfo']['id'] ?></h5>
    </form>
    <style>
        body{
            text-transform: uppercase;
        }
        input{
            text-align: center;
        }
        label{
            width: 150px;
        }
    </style>
<?php

require_once('components/footer.php');


?>