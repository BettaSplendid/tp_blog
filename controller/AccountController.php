<?php
require_once("../config/config.php");
require_once("../model/SignupModel.php");
require_once("../model/LoginModel.php");
require_once("../helpers/RedirectHelper.php");

if (!isset($_GET['action'])) {
    die("Params needed");
}

$action = $_GET['action'];

switch ($action) {
    case 'login':
        login();
        break;

    case 'signup':
        signUp();
        break;

    default:
        die("no action provide");
        break;
}

/**
 * @return void
 */
function signUp(): void
{
    global $domaine;

    if (
        isset($_POST['pseudo'], $_POST['email'], $_POST['password'], $_POST['comfirm_password'], $_POST['user_type'], $_POST['accepted'])
    ) {
        $isValid = checkSignUp(
            $_POST['pseudo'],
            $_POST['email'],
            $_POST['password'],
            $_POST['comfirm_password'],
            $_POST['user_type'],
            $_POST['accepted']
        );

        if ($isValid['exist']) {
            redirect($domaine . "http://127.0.0.25/vues/account/signup.php?error=". $isValid["message"]);
        }

        redirect($domaine . "/vues/account/successfully.php");
    }
}

/**
 * @return void
 */
function login(): void
{
    global $domaine;

    if (isset($_POST['email'], $_POST['password'])) {
        $isValid = checkLogin(
            $_POST['email'],
            $_POST['password']
        );

        if (!$isValid['exist']) {
            redirect($domaine . "/vues/articles/articles.php");
        }

        redirect($domaine . "/vues/account/login.php?error=" . $isValid['message']);
    }
}
