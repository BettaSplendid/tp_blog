<?php
session_start();
require_once("../config/mysql.php");
require_once("../config/config.php");


function checkLogin($email, $password)
{
    global $error;
    
    $email =  htmlspecialchars(strip_tags($email));
    $password =  htmlspecialchars(strip_tags($password));

    if ( empty($email) || empty($password)) {
        $error["message"] = "Veuillez remplir tous les champs. Merci ! </br>";
        $error["exist"] = true;

        return $error;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error["message"] = "Saisissez un adresse email valide";
        $error["exist"] = true;

        return $error;
    }

    getPasswordUser($email, $password);

    return $error;
}

function getPasswordUser($email, $password)
{
    global $connexion;
    global $error;

    try {
        $query = $connexion->prepare("SELECT `id`, `password`, `pseudo`  FROM `user` WHERE email=:email;");
        $response = $query->execute(["email" => $email]);
    } catch(\PDOException $_error ) {
        $msg = $_error->getMessage();
        $msg = $_error->getCode();
        die($msg);
    }
    
    if (!$response) {
        $error["message"] = "Une erreur s'est produite durant la recherche du mot de passe";
        $error["exist"] = true;

        return $error;
    }

    $aDatas = $query->fetch();

    comparePassword($aDatas, $password);

    return $error;
}

function comparePassword($aDatas, $password) {
    global $error;

    if(!isset($aDatas['password'])) {
        $error["message"] = "L’adresse e-mail que vous avez saisie n’est pas associée à un compte. <a href='http://127.0.0.25/vues/account/signup.php'>Céer votre compte</a>";
        $error["exist"] = true;

        return $error;
    }

    $passwordVerified = password_verify($password, $aDatas['password']);

    if (!$passwordVerified) {
        $error["message"] = "Mot de passe incorrect.";
        $error["exist"] = true;

        return $error;
    }

    createSession($aDatas);
}

function createSession($aDatas) {
    $_SESSION['id'] = $aDatas['id'];
    $_SESSION['pseudo'] = ucfirst($aDatas['pseudo']);
}