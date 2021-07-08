<?php

require_once('components/header.php');
require_once('components/navbar.php');

$changed = 0;
$activeVar = 0;

foreach ($_GET as $data) {
    if (!empty($data)) {
        ++$activeVar;
    }
}

!empty($_GET) && $activeVar > 1 ? $filter = " WHERE " : $filter = "";


if (isset($_GET['category'])) {
    $filter .= "`category` = '{$_GET['category']}'";
    ++$changed;

    if (isset($_GET['status']) || isset($_GET['location']) && !empty($_GET['location'])) {
        $filter .= " AND ";
        ++$changed;
    }
}

if (isset($_GET['status'])) {
    $filter .= "`status` = '{$_GET['status']}'";
    ++$changed;

    if (isset($_GET['location'])) {
        if ($_GET['location'] != 'all' || !empty($_GET['search'])) {
            $filter .= " AND ";
            ++$changed;
        }
    }
}

if (isset($_GET['location'])) {
    if ($_GET['location'] != 'all') {
        $filter .= "`location` = '{$_GET['location']}'";
        ++$changed;
    }

    if (isset($_GET['location']) && $_GET['location'] != 'all' && !empty($_GET['search'])) {
        $filter .= " AND ";
        ++$changed;
    }

    if (!empty($_GET['search'])) {
        $filter .= "`header` LIKE '" . '%' . $_GET['search'] . '%' . "' OR `desc` LIKE '" . '%' . $_GET['search'] . '%' . "'";
        ++$changed;
    }

    if ($changed == 0) {
        $filter = '';
    }
}

if ($filter == ' WHERE '){
    $filter = '';
}

$counter = mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(`id`) as `id` FROM `posts` WHERE `status` = 'lost' OR `status` = 'found' OR `status` = 'theft'"));
$postsInfo = mysqli_fetch_all(mysqli_query($link, "SELECT * FROM `posts`" . $filter));

$dictionary['index']['search']['header'] = str_replace("*", $counter['id'], $dictionary['index']['search']['header']);
$searchHeader = $counter['id'] == 1 ? $dictionary['index']['search']['1header'] : $dictionary['index']['search']['header'];

function locationSelection($location)
{
    if (isset($_GET['location']) && $_GET['location'] == $location) {
        return 'selected';
    } elseif (!isset($_GET['location']) && $location == 'all') {
        return 'selected';
    } else {
        return '';
    }
}

function categorySelection($category)
{
    if (isset($_GET['category']) && $_GET['category'] == $category) {
        return 'category-active';
    } else {
        return '';
    }
}

function statusSelection($status)
{
    if (isset($_GET['status']) && $_GET['status'] == $status) {
        return 'item-active';
    } else {
        return '';
    }
}

//
//var_dump($_SESSION);
//echo '<br>';
//var_dump($_COOKIE);
//echo '<br>';
//var_dump($_POST);
//echo '<br>';
//var_dump($filter);

?>
    <form method="get">
        <section class="bg-dark text-white shadow-lg">
            <section class="d-flex justify-content-center pb-lg-3">
                <div class="d-flex flex-column text-center py-3 px-md-3">
                    <h5 class="font-weight-bold"><?= $searchHeader ?></h5>
                    <!--search form-->
                    <?php if (isset($_GET['category'])) {
                        echo "<input type='hidden' name='category' value='{$_GET['category']}'>";
                    } ?>
                    <?php if (isset($_GET['status'])) {
                        echo "<input type='hidden' name='status' value='{$_GET['status']}'>";
                    } ?>
                    <input type="search"
                           name="search"
                           value="<?= isset($_GET['search']) ? $_GET['search'] : ''; ?>"
                           class="py-3 px-2 rounded-top border border-bottom-dark"
                           placeholder="Search"
                           style="outline: none;">
                    <select type="text"
                            name="location"
                            class="border-0 px-2 py-2"
                            style="outline: none;">
                        <option value="all" <?= locationSelection('all') ?>>All Ukraine</option>
                        <option value="lutsk" <?= locationSelection('lutsk') ?>>Lutsk</option>
                    </select>
                    <button type="submit"
                            class="d-block bg-warning text-white font-weight-bold py-1 text-decoration-none rounded-bottom"
                            style="outline: none; font-size: 20px; border: none;">
                        <?= $dictionary['index']['search']['buttonSearch'] ?>
                    </button>
                </div>
                <div class="d-none d-lg-block border border-white mt-5 ml-3 mr-1 mb-3 border-right"></div>
                <div class="d-none d-sm-flex flex-column text-center ml-1 mt-5">
                    <a href="<?= makeHref("", "lost"); ?>"
                       class="item text-white rounded mx-1 mx-lg-2 p-1 <?= statusSelection('lost') ?>">
                        <i class="fas fa-search"></i><?= $dictionary['index']['search']['status'][0] ?></a>
                    <a href="<?= makeHref("", "found"); ?>"
                       class="item text-white rounded mx-1 mx-lg-2 my-3 p-1 <?= statusSelection('found') ?>">
                        <i class="fas fa-bullhorn"></i><?= $dictionary['index']['search']['status'][1] ?></a>
                    <a href="<?= makeHref("", "theft"); ?>"
                       class="item text-white rounded mx-1 mx-lg-2 p-1 <?= statusSelection('theft') ?>">
                        <i class="fas fa-fist-raised"></i><?= $dictionary['index']['search']['status'][2] ?></a>
                </div>
                <div class="d-none d-lg-flex flex-row mt-5 mb-3 rounded" id="category">
                    <!--            first column-->
                    <div class="d-flex flex-column p-0 text-center" style="width: 170px;">
                        <a href="<?= makeHref("pets", ""); ?>"
                           class="category p-1 <?= categorySelection('pets') ?>">
                            <i class="fas fa-paw"></i><?= $dictionary['index']['search']['category'][0] ?></a>
                        <a href="<?= makeHref("devices", ""); ?>"
                           class="category my-3 p-1 <?= categorySelection('devices') ?>">
                            <i class="fas fa-mobile"></i><?= $dictionary['index']['search']['category'][1] ?></a>
                        <a href="<?= makeHref("documents", ""); ?>"
                           class="category p-1 <?= categorySelection('documents') ?>">
                            <i class="fas fa-file-alt"></i><?= $dictionary['index']['search']['category'][2] ?></a>
                    </div>
                    <!--            second column-->
                    <div class="d-flex flex-column p-0 text-center" style="width: 170px;">
                        <a href="<?= makeHref("clothes", ""); ?>"
                           class="category p-1 <?= categorySelection('clothes') ?>">
                            <i class="fas fa-tshirt"></i><?= $dictionary['index']['search']['category'][3] ?></a>
                        <a href="<?= makeHref("inventory", ""); ?>"
                           class="category p-1 my-3 <?= categorySelection('inventory') ?>">
                            <i class="fas fa-inventory"></i><?= $dictionary['index']['search']['category'][4] ?></a>
                        <a href="<?= makeHref("preciousness", ""); ?>"
                           class="category p-1 <?= categorySelection('preciousness') ?>">
                            <i class="fas fa-gem"></i><?= $dictionary['index']['search']['category'][5] ?></a>
                    </div>
                    <!--            third column-->
                    <div class="d-flex flex-column p-0 text-center" style="width: 170px;">
                        <a href="<?= makeHref("toys", ""); ?>"
                           class="category p-1 <?= categorySelection('toys') ?>">
                            <i class="fas fa-dreidel"></i><?= $dictionary['index']['search']['category'][6] ?></a>
                        <a href="<?= makeHref("office", ""); ?>"
                           class="category p-1 my-3 <?= categorySelection('office') ?>">
                            <i class="fas fa-paperclip"></i><?= $dictionary['index']['search']['category'][7] ?></a>
                        <a href="<?= makeHref("details", ""); ?>"
                           class="category p-1 <?= categorySelection('details') ?>">
                            <i class="fas fa-cog"></i><?= $dictionary['index']['search']['category'][8] ?></a>
                    </div>
                </div>
            </section>
            <div class="toggle text-center d-lg-none">
<!--                <div class="d-flex d-sm-none justify-content-center row text-center pb-1">-->
<!--                    <a href="--><?//= makeHref("", "lost"); ?><!--"-->
<!--                       class="item text-white rounded mx-1 mx-lg-2 p-1 --><?//= statusSelection('lost') ?><!--">-->
<!--                        <i class="fas fa-search"></i>--><?//= $dictionary['index']['search']['status'][0] ?><!--</a>-->
<!--                    <a href="--><?//= makeHref("", "found"); ?><!--"-->
<!--                       class="item text-white rounded mx-1 mx-lg-2 p-1 --><?//= statusSelection('found') ?><!--">-->
<!--                        <i class="fas fa-bullhorn"></i>--><?//= $dictionary['index']['search']['status'][1] ?><!--</a>-->
<!--                    <a href="--><?//= makeHref("", "theft"); ?><!--"-->
<!--                       class="item text-white rounded mx-1 mx-lg-2 p-1 --><?//= statusSelection('theft') ?><!--">-->
<!--                        <i class="fas fa-fist-raised"></i>--><?//= $dictionary['index']['search']['status'][2] ?><!--</a>-->
<!--                </div>-->
<!--                <div class="d-none d-sm-flex justify-content-center row text-center pb-1">-->
<!--                    <a href="--><?//= makeHref("", "lost"); ?><!--"-->
<!--                       class="item text-white rounded col-3 mx-1 mx-lg-2 p-1 px-2 --><?//= statusSelection('lost') ?><!--"-->
<!--                       style="font-size: 4vw">-->
<!--                        <i class="fas fa-search"-->
<!--                           style="width: 5vw;font-size: 4vw;"></i>--><?//= $dictionary['index']['search']['status'][0] ?><!--</a>-->
<!--                    <a href="--><?//= makeHref("", "found"); ?><!--"-->
<!--                       class="item text-white rounded col-3 mx-1 mx-lg-2 p-1 px-2 --><?//= statusSelection('found') ?><!--"-->
<!--                       style="font-size: 4vw">-->
<!--                        <i class="fas fa-bullhorn"-->
<!--                           style="width: 5vw;font-size: 4vw;"></i>--><?//= $dictionary['index']['search']['status'][1] ?><!--</a>-->
<!--                    <a href="--><?//= makeHref("", "theft"); ?><!--"-->
<!--                       class="item text-white rounded col-3 mx-1 mx-lg-2 p-1 px-2 --><?//= statusSelection('theft') ?><!--"-->
<!--                       style="font-size: 4vw">-->
<!--                        <i class="fas fa-fist-raised"-->
<!--                           style="width: 5vw;font-size: 4vw;"></i>--><?//= $dictionary['index']['search']['status'][2] ?><!--</a>-->
<!--                </div>-->
                <div class="d-flex d-sm-none row justify-content-center text-center">
                    <a href="<?= makeHref("", "lost"); ?>"
                       class="item text-white rounded p-2 <?= statusSelection('lost') ?>">
                        <i class="fas fa-search"></i><?= $dictionary['index']['search']['status'][0] ?></a>
                    <a href="<?= makeHref("", "found"); ?>"
                       class="item text-white rounded mx-2 p-2 <?= statusSelection('found') ?>">
                        <i class="fas fa-bullhorn"></i><?= $dictionary['index']['search']['status'][1] ?></a>
                    <a href="<?= makeHref("", "theft"); ?>"
                       class="item text-white rounded p-2 <?= statusSelection('theft') ?>">
                        <i class="fas fa-fist-raised"></i><?= $dictionary['index']['search']['status'][2] ?></a>
                </div>
                <hr>
                <div class="d-flex justify-content-center row">
                    <div class="d-flex flex-column p-0 text-center" style="width: 170px;">
                        <a href="<?= makeHref("pets", ""); ?>"
                           class="category p-1 <?= categorySelection('pets') ?>">
                            <i class="fas fa-paw"></i><?= $dictionary['index']['search']['category'][0] ?></a>
                        <a href="<?= makeHref("devices", ""); ?>"
                           class="category my-3 p-1 <?= categorySelection('devices') ?>">
                            <i class="fas fa-mobile"></i><?= $dictionary['index']['search']['category'][1] ?></a>
                        <a href="<?= makeHref("documents", ""); ?>"
                           class="category p-1 <?= categorySelection('documents') ?>">
                            <i class="fas fa-file-alt"></i><?= $dictionary['index']['search']['category'][2] ?></a>
                    </div>
                    <!--            second column-->
                    <div class="d-flex flex-column p-0 text-center" style="width: 170px;">
                        <a href="<?= makeHref("clothes", ""); ?>"
                           class="category p-1 <?= categorySelection('clothes') ?>">
                            <i class="fas fa-tshirt"></i><?= $dictionary['index']['search']['category'][3] ?></a>
                        <a href="<?= makeHref("inventory", ""); ?>"
                           class="category p-1 my-3 <?= categorySelection('inventory') ?>">
                            <i class="fas fa-inventory"></i><?= $dictionary['index']['search']['category'][4] ?></a>
                        <a href="<?= makeHref("preciousness", ""); ?>"
                           class="category p-1 <?= categorySelection('preciousness') ?>">
                            <i class="fas fa-gem"></i><?= $dictionary['index']['search']['category'][5] ?></a>
                    </div>
                    <!--            third column-->
                    <div class="d-flex flex-column p-0 text-center" style="width: 170px;">
                        <a href="<?= makeHref("toys", ""); ?>"
                           class="category p-1 <?= categorySelection('toys') ?>">
                            <i class="fas fa-dreidel"></i><?= $dictionary['index']['search']['category'][6] ?></a>
                        <a href="<?= makeHref("office", ""); ?>"
                           class="category p-1 my-3 <?= categorySelection('office') ?>">
                            <i class="fas fa-paperclip"></i><?= $dictionary['index']['search']['category'][7] ?></a>
                        <a href="<?= makeHref("details", ""); ?>"
                           class="category p-1 <?= categorySelection('details') ?>">
                            <i class="fas fa-cog"></i><?= $dictionary['index']['search']['category'][8] ?></a>
                    </div>
                </div>
<!--                <div class="d-none d-md-flex flex-row justify-content-center" id="category">-->
<!--                    first column-->
<!--                    <div class="d-flex flex-column col-4 p-0">-->
<!--                        <a href="--><?//= makeHref("pets", ""); ?><!--"-->
<!--                           class="category py-3 --><?//= categorySelection('pets') ?><!--">-->
<!--                            <i class="fas fa-paw"></i>--><?//= $dictionary['index']['search']['category'][0] ?><!--</a>-->
<!--                        <a href="--><?//= makeHref("devices", ""); ?><!--"-->
<!--                           class="category mt-1 py-3 --><?//= categorySelection('devices') ?><!--">-->
<!--                            <i class="fas fa-mobile"></i>--><?//= $dictionary['index']['search']['category'][1] ?><!--</a>-->
<!--                        <a href="--><?//= makeHref("documents", ""); ?><!--"-->
<!--                           class="category mt-1 py-3 --><?//= categorySelection('documents') ?><!--">-->
<!--                            <i class="fas fa-file-alt"></i>--><?//= $dictionary['index']['search']['category'][2] ?><!--</a>-->
<!--                    </div>-->
<!--                                second column-->
<!--                    <div class="d-flex flex-column col-4 p-0">-->
<!--                        <a href="--><?//= makeHref("clothes", ""); ?><!--"-->
<!--                           class="category py-3 --><?//= categorySelection('clothes') ?><!--">-->
<!--                            <i class="fas fa-tshirt"></i>--><?//= $dictionary['index']['search']['category'][3] ?><!--</a>-->
<!--                        <a href="--><?//= makeHref("inventory", ""); ?><!--"-->
<!--                           class="category mt-1 py-3 --><?//= categorySelection('inventory') ?><!--">-->
<!--                            <i class="fas fa-inventory"></i>--><?//= $dictionary['index']['search']['category'][4] ?><!--</a>-->
<!--                        <a href="--><?//= makeHref("preciousness", ""); ?><!--"-->
<!--                           class="category mt-1 py-3 --><?//= categorySelection('preciousness') ?><!--">-->
<!--                            <i class="fas fa-gem"></i>--><?//= $dictionary['index']['search']['category'][5] ?><!--</a>-->
<!--                    </div>-->
<!--                                third column-->
<!--                    <div class="d-flex flex-column col-4 p-0">-->
<!--                        <a href="--><?//= makeHref("toys", ""); ?><!--"-->
<!--                           class="category py-3 --><?//= categorySelection('toys') ?><!--">-->
<!--                            <i class="fas fa-dreidel"></i>--><?//= $dictionary['index']['search']['category'][6] ?><!--</a>-->
<!--                        <a href="--><?//= makeHref("office", ""); ?><!--"-->
<!--                           class="category mt-1 py-3 --><?//= categorySelection('office') ?><!--">-->
<!--                            <i class="fas fa-paperclip"></i>--><?//= $dictionary['index']['search']['category'][7] ?><!--</a>-->
<!--                        <a href="--><?//= makeHref("details", ""); ?><!--"-->
<!--                           class="category mt-1 py-3 --><?//= categorySelection('details') ?><!--">-->
<!--                            <i class="fas fa-cog"></i>--><?//= $dictionary['index']['search']['category'][8] ?><!--</a>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="d-flex d-md-none flex-row justify-content-center">-->
<!--                               first column  -->
<!--                    <div class="d-flex flex-column col-6 p-0">-->
<!--                        <a href="--><?//= makeHref("pets", ""); ?><!--"-->
<!--                           class="category py-3 --><?//= categorySelection('pets') ?><!--">-->
<!--                            <i class="fas fa-paw"></i>--><?//= $dictionary['index']['search']['category'][0] ?><!--</a>-->
<!--                        <a href="--><?//= makeHref("devices", ""); ?><!--"-->
<!--                           class="category py-3 --><?//= categorySelection('devices') ?><!--">-->
<!--                            <i class="fas fa-mobile"></i>--><?//= $dictionary['index']['search']['category'][1] ?><!--</a>-->
<!--                        <a href="--><?//= makeHref("clothes", ""); ?><!--"-->
<!--                           class="category py-3 --><?//= categorySelection('clothes') ?><!--">-->
<!--                            <i class="fas fa-tshirt"></i>--><?//= $dictionary['index']['search']['category'][2] ?><!--</a>-->
<!--                        <a href="--><?//= makeHref("documents", ""); ?><!--"-->
<!--                           class="category py-3 --><?//= categorySelection('documents') ?><!--">-->
<!--                            <i class="fas fa-file-alt"></i>--><?//= $dictionary['index']['search']['category'][3] ?><!--</a>-->
<!--                        <a href="--><?//= makeHref("preciousness", ""); ?><!--"-->
<!--                           class="category py-3 --><?//= categorySelection('preciousness') ?><!--">-->
<!--                            <i class="fas fa-gem"></i>--><?//= $dictionary['index']['search']['category'][4] ?><!--</a>-->
<!--                    </div>-->
<!--                                second column-->
<!--                    <div class="d-flex flex-column col-6 p-0">-->
<!--                        <a href="--><?//= makeHref("toys", ""); ?><!--"-->
<!--                           class="category py-3 --><?//= categorySelection('toys') ?><!--">-->
<!--                            <i class="fas fa-dreidel"></i>--><?//= $dictionary['index']['search']['category'][5] ?><!--</a>-->
<!--                        <a href="--><?//= makeHref("office", ""); ?><!--"-->
<!--                           class="category py-3 --><?//= categorySelection('office') ?><!--">-->
<!--                            <i class="fas fa-paperclip"></i>--><?//= $dictionary['index']['search']['category'][6] ?><!--</a>-->
<!--                        <a href="--><?//= makeHref("details", ""); ?><!--"-->
<!--                           class="category py-3 --><?//= categorySelection('details') ?><!--">-->
<!--                            <i class="fas fa-cog"></i>--><?//= $dictionary['index']['search']['category'][7] ?><!--</a>-->
<!--                        <a href="--><?//= makeHref("inventory", ""); ?><!--"-->
<!--                           class="category py-3 --><?//= categorySelection('inventory') ?><!--">-->
<!--                            <i class="fas fa-inventory"></i>--><?//= $dictionary['index']['search']['category'][8] ?><!--</a>-->
<!--                    </div>-->
<!--                </div>-->
            </div>
            <div class="text-center">
                <a role="button"
                   id="expand"
                   class="fas fa-chevron-down bg-dark text-primary py-1 px-5 text-decoration-none d-lg-none"
                   style="border: 0; font-size: 32px; outline: 0;">
                </a>
            </div>
    </form>
    </section>
    <main class="py-5">
        <div class="d-flex justify-content-center row">

            <?php
            if (empty($postsInfo)) {
                echo "<div class='border border-dark d-flex flex-column justify-content-center text-center p-3 p-md-5 col-9 rounded bg-dark shadow-lg'><span class='fas fa-times text-warning text-center' style='font-size: 200px;'></span><span class='text-warning font-weight-bold' style='font-size: 28px;'>{$dictionary['errors']['noPosts']}</span></div>";
            } else {
                foreach ($postsInfo as $posts) {
                    $posts[6] = json_decode($posts[6], true);
                    $date = json_decode($posts[8], true);
                    $displayDate = $date['mday'] . '.' . $date['mon'] . '.' . $date['year'] . ', ' . $date['hours'] . ':' . $date['minutes'];
                    ?>
                    <article class="card <?php if ($posts[9] == 'deactivated') {
                        echo 'd-none';
                    } else {
                        echo $posts[9];
                    } ?> post bg-light p-3 mx-3 mb-3 col-9 col-sm-4 col-md-3 col-xl-2">
                        <?php if (empty($posts[6])) {
                            echo "<div class='text-center my-1' style='height: 200px !important;'><a href='post.php?id={$posts[0]}' class='fas fa-question-square text-decoration-none text-dark' style='font-size: 200px;'></a></div>";
                        } else {
                            echo "<div class='text-center my-1 bg-white' style='height: 200px !important;'><a href='post.php?id={$posts[0]}'><img alt='' src='{$posts[6]['data']['display_url']}' class='img-fluid position-relative' style='transform: translate(0%,-50%);top: 50%;max-height: 200px;'></a></div>";
                        } ?>
                        <a href="post.php?id=<?= $posts[0] ?>"
                           class="font-weight-bold text-decoration-none text-dark"
                           style="font-size: 14px;"><?= $posts[3] ?></a>
                        <!--                    <a href="post.php?id=-->
                        <? //= $posts[0] ?><!--" class="text-decoration-none text-dark"-->
                        <!--                       style="font-size: 12px;">--><? //= $posts[6] ?><!--</a>-->
                        <div class="d-flex flex-column">
                            <a href="https://www.google.com/maps/search/<?= $posts[7] ?>/"
                               class="font-weight-bold text-muted position-relative"
                               style="font-size: 10px; bottom: 0;">
                                <i class="fas fa-map-marker-alt" style="width: 10px;"></i><?= $posts[7] ?>
                            </a>
                            <a href="post.php?id=<?= $posts[0] ?>" class="font-weight-bold text-muted position-relative"
                               style="font-size: 10px; bottom: 0;">
                                <i class="fas fa-calendar-day" style="width: 10px;"></i><?= $displayDate ?></a>
                        </div>
                    </article>
                <?php }
            } ?>
        </div>
    </main>
<!--    <footer class="d-flex justify-content-center bg-dark text-center py-3" style="flex-shrink: 0;">-->
<!--        <span class="text-white font-weight-bold">Enigma 2019 - 2020</span>-->
<!--    </footer>-->
<?php

require_once('components/footer.php');

?>