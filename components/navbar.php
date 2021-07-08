<form method="post">
    <header class="navbar navbar-expand-lg navbar-light bg-warning py-2 shadow">
        <a href="/index.php" class="logo font-weight-bold navbar-brand ml-1 px-1 text-decoration-none rounded"
           style="font-size: 32px;">ENIGMA</a>
        <!--    collapsing menu (collapse available ONLY for screens lower than lg  -->
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto ml-2">
                <li class="d-lg-none dropdown">
                    <a href="#" class="text-dark text-decoration-none dropdown-toggle" id="dropdownLang"
                       data-toggle="dropdown" aria-expanded="false"
                       aria-haspopup="true"
                       role="button" style="font-size: 20px;">
                        <?= $dictionary['index']['navbar']['langText'] ?> <?= $dictionary['langName'] ?></a>
                    <div class="dropdown-menu bg-dark border border-white" aria-labelledby="dropdownLang" style="width: 175px;">
                        <a href="<?= makeHref("", "", "en") ?>" class="container-fluid text-center p-1 rounded category <?= languageSelection('en') ?>">English</a>
                        <!--                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f2/Flag_of_Great_Britain_%281707%E2%80%931800%29.svg/640px-Flag_of_Great_Britain_%281707%E2%80%931800%29.svg.png" class="img-fluid" style="width: 20px;">-->
                        <div class="dropdown-divider"></div>
                        <a href="<?= makeHref("", "", "ru") ?>" class="container-fluid text-center p-1 rounded category <?= languageSelection('ru') ?>">Русский</a>
                        <div class="dropdown-divider"></div>
                        <a href="<?= makeHref("", "", "ua") ?>" class="container-fluid text-center p-1 rounded category <?= languageSelection('ua') ?>">Українська</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link<?php if ($basename == 'index.php'){ echo ' font-weight-bold'; }?>" href="/index.php"
                       style="font-size: 20px; line-height: 38px;"><?= $dictionary['index']['navbar']['li1'] ?></a>
                </li>
<!--                <li class="nav-item">-->
<!--                    <a class="nav-link--><?php //if ($basename == 'contact.php'){ echo ' font-weight-bold'; } ?><!--" href="#"-->
<!--                       style="font-size: 20px; line-height: 38px;">Contact</a>-->
<!--                </li>-->
                <li class="nav-item">
                    <a class="nav-link<?php if ($basename == 'about.php'){ echo ' font-weight-bold'; } ?>" href="/about.php?lang=<?= $_GET['lang'] ?>"
                       style="font-size: 20px; line-height: 38px;"><?= $dictionary['index']['navbar']['li2'] ?></a>
                </li>
                <li class="nav-item d-block d-lg-none">
                    <?php if (isset($_POST['profileInfo'])){
                        echo "<a href='/account.php?lang={$_GET['lang']}' class='text-decoration-none text-dark' style='font-size: 20px;'><i class='fas fa-user'></i>{$dictionary['index']['navbar']['hello']}{$_POST['profileInfo']['name']}</a>";
                    } else{
                        echo "
                    <div class='d-flex flex-column'>
                        <a href='/signin.php?lang={$_GET['lang']}' class='nav-link' style='font-size: 20px; line-height: 38px;'>{$dictionary['index']['navbar']['signin']}</a>
                        <a href='/signup.php?lang={$_GET['lang']}' class='nav-link' style='font-size: 20px; line-height: 38px;'>{$dictionary['index']['navbar']['signup']}</a>
                    </div>";
                    }?>
                </li>
            </ul>
        </div>

        <button type="button"
                class="btn btn-dark text-uppercase d-none d-lg-block font-weight-bold col-3 shadow-lg ml-1"
                name="send" onclick="window.location.href = 'add-post.php?lang=<?= $_GET['lang'] ?>'" value="run">
            <?= $dictionary['index']['navbar']['buttonText3'] ?>
        </button>
        <button type="button"
                class="btn btn-dark text-uppercase d-none d-sm-block d-lg-none font-weight-bold col-4 shadow-lg ml-1"
                name="send" onclick="window.location.href = 'add-post.php?lang=<?= $_GET['lang'] ?>'" value="run">
            <?= $dictionary['index']['navbar']['buttonText2'] ?>
        </button>
        <button type="button"
                class="btn btn-dark text-uppercase d-block d-sm-none font-weight-bold shadow-lg ml-1"
                name="send" onclick="window.location.href = 'add-post.php?lang=<?= $_GET['lang'] ?>'" value="run" style="width: 90px;">
                <?= $dictionary['index']['navbar']['buttonText1'] ?>
        </button>
        <div class="d-none d-lg-block px-2 dropdown" style="line-height: 19px;">
            <a href="#" class="text-dark dropdown-toggle" id="dropdownLang"
               data-toggle="dropdown" aria-expanded="false"
               aria-haspopup="true"
               role="button">
                <?= $dictionary['index']['navbar']['langText'] ?><br><?= $dictionary['langName'] ?></a>
            <div class="dropdown-menu bg-dark border border-white px-2 text-center" aria-labelledby="dropdownLang">
                <a href="<?= makeHref("", "", "en") ?>" class="container-fluid p-1 rounded category <?= languageSelection('en') ?>">English</a>
<!--                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f2/Flag_of_Great_Britain_%281707%E2%80%931800%29.svg/640px-Flag_of_Great_Britain_%281707%E2%80%931800%29.svg.png" class="img-fluid" style="width: 20px;">-->
                <div class="dropdown-divider"></div>
                <a href="<?= makeHref("", "", "ru") ?>" class="container-fluid p-1 rounded category <?= languageSelection('ru') ?>">Русский</a>
                <div class="dropdown-divider"></div>
                <a href="<?= makeHref("", "", "ua") ?>" class="container-fluid p-1 rounded category <?= languageSelection('ua') ?>">Українська</a>
            </div>
        </div>
        <a href="/account.php?lang=<?= $_GET['lang'] ?>" class="fas fa-user-cog text-dark text-decoration-none d-none d-lg-block" style="font-size: 38px;"></a>
        <?php if (isset($_POST['profileInfo'])){
            echo "<a href='account.php?lang={$_GET['lang']}' class='text-dark p-1 d-none d-lg-block' style='line-height: 19px'>{$dictionary['index']['navbar']['hello']}<br>{$_POST['profileInfo']['name']}</a>";
        } else{
            echo "
                    <div class='d-flex flex-column pl-1'>
                        <u><a href='/signin.php?lang={$_GET['lang']}' class='text-dark d-none d-lg-block' style='line-height: 19px'>{$dictionary['index']['navbar']['signin']}</a></u>
                        <u><a href='/signup.php?lang={$_GET['lang']}' class='text-dark d-none d-lg-block' style='line-height: 19px'>{$dictionary['index']['navbar']['signup']}</a></u>
                    </div>
                 ";
        }?>
        <button type="button" class="btn btn-dark d-block d-lg-none ml-2" data-toggle="collapse"
                data-target="#navbarCollapse"
                aria-expanded="false" aria-controls="navbarCollapse" aria-label="Toggle navigation"><i
                    class="fas fa-bars"></i></button>
    </header>
</form>