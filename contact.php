<?php

require_once 'vendor/autoload.php';

use QuickPOS\FormValidator;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php#contact');
    exit;
}

$validator = new FormValidator();
$isValid   = $validator->validate($_POST);

if ($isValid) {
    header('Location: thankyou.php');
    exit;
} else {
    session_start();
    $_SESSION['form_errors'] = $validator->getErrors();
    $_SESSION['form_data']   = $_POST;
    header('Location: index.php#contact');
    exit;
}
