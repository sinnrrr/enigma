<?php

/**
 * @param $field
 * @return string
 */
function getFieldValue($field)
{
    if (isset($_POST['check'][$field])) {
        return $_POST['check'][$field];
    } else {
        return '';
    }
}

/**
 * @param $field
 * @return string
 */
function returnFeedbackClass($field)
{
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        return '';
    }

    global $feedback;

    if (isset($feedback[$field])) {
        return ('is-invalid');
    } else {
        return ('is-valid');
    }
}

/**
 * @param $field
 * @param $error
 */
function addFeedback($field, $error)
{
    global $feedback;
    $feedback[$field] = $error;
}

/**
 * @param $field
 * @return string
 */
function getFeedbackBlock($field)
{
    global $feedback;

    if (isset($feedback[$field])) {
        return '<div class="invalid-feedback">' . $feedback[$field] . '</div>';
    }
}

function feedbackCheck($result, $reason)
{
    if (mysqli_num_rows($result) == 0) {
        header("Location: 404.php?reason=$reason");
        die();
    }
}

function makeHref($category = "", $status = "", $lang = "")
{
    $language = !empty($lang) ? $lang : $_GET['lang'] ?? 'ua';
    $url = "index.php?lang={$language}";

    $actualCategory = isset($_GET['category']) ? $_GET['category'] : NULL;
    $actualStatus = isset($_GET['status']) ? $_GET['status'] : NULL;

    if (!empty($category) && $category != $actualCategory) {
        $url .= "&category={$category}";
    } elseif (empty($category) && !empty($actualCategory)) {
        $url .= "&category={$actualCategory}";
    }
    if (!empty($status) && $status != $actualStatus) {
        $url .= "&status={$status}";
    } elseif (empty($status) && !empty($actualStatus)) {
        $url .= "&status={$actualStatus}";
    }
    if (isset($_GET['location'])) {
        $url .= "&location={$_GET['location']}&search=" . $_GET['search'] ?? '';
    }

    return $url;
}

function languageSelection($lang)
{
    if ($_GET['lang'] == $lang) {
        return 'category-active';
    } else {
        return '';
    }
}

//function eraseFeedback()
//{
//    addFeedback('name', '');
//    addFeedback('email', '');
//    addFeedback('pass0', '');
//    addFeedback('pass1', '');
//    addFeedback('cb1', '');
//    addFeedback('cb2', '');
//}
