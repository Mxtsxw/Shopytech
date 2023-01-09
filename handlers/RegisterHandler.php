<?php 
session_start();

// Importation des modules nécessaires
require_once('../models/Model.php');
require_once('../models/Logins.php');
require_once('../models/LoginsManager.php');
require_once('../models/Customers.php');
require_once('../models/CustomersManager.php');

// Récupération des données du formulaire
$username = $_POST['username'];
$password = $_POST['password'];

// Initialisation des managers
$loginsManager = new loginsManager();
$customersManager = new CustomersManager();

if (isset($_POST['create-account']))
{
    if ($loginsManager->checkUsername($username))
    {
        $_SESSION['error_message'] = "Ce nom d'utilisateur exite déjà";
        header('Location: ../register');
        exit();
    }

    // Vérification que les variables existent
    if (!(isset($_POST['username']) && isset($_POST['password']) && $_POST['passwordConfirm']))
    {
        // Redirection vers la page d'inscription avec un message d'erreur
        $_SESSION['error_message'] = "Veuillez entrez des valeurs";
        header('Location: ../register');
        exit();
    }

    // Vérification de la validité du mot de passe
    if (!($_POST['password'] === $_POST['passwordConfirm']))
    {
        // Redirection vers la page d'inscription avec un message d'erreur
        $_SESSION['error_message'] = "Les mots de passe ne correspondent pas";
        header('Location: ../register');
        exit();
    }

    // Création d'un nouvel utilisateur
    $user = new Logins(array(
        "id" => -1,
        "customerId" => -1,
        "username" => $username,
        "password" => $password
    ));

    // Enregistre dans la session
    $_SESSION['createdLogins'] = serialize($user);
    $_SESSION['created_username'] = $username;

    header('Location: ../register/confirm');
    exit();
}


if (isset($_POST['create-account-on-order']))
{
    if ($loginsManager->checkUsername($username))
    {
        $_SESSION['error_message'] = "Ce nom d'utilisateur exite déjà";
        header('Location: ../register/create');
        exit();
    }

    // Vérification que les variables existent
    if (!(isset($_POST['username']) && isset($_POST['password']) && $_POST['passwordConfirm']))
    {
        // Redirection vers la page d'inscription avec un message d'erreur
        $_SESSION['error_message'] = "Entrez des valeurs";
        header('Location: ../register/create');
        exit();
    }

    // Vérification de la validité du mot de passe
    if (!($_POST['password'] === $_POST['passwordConfirm']))
    {
        // Redirection vers la page d'inscription avec un message d'erreur
        $_SESSION['error_message'] = "Les mots de passe ne correspondent pas";
        header('Location: ../register/create');
        exit();
    }

    // Enregistre dans la session
    $customer = unserialize($_SESSION['createdCustomer']);
    $customerId = $customersManager->addCustomer($customer);
    $customer->setId($customerId);

    $login = new Logins(array(
        "id" => -1,
        "customer_id" => $customerId,
        "username" => $username,
        "password" => $password
    ));

    $loginId = $loginsManager->addUser($login);
    $login->setId($loginId);

    $_SESSION['update_message'] = "Votre compte a bien été créé";

    // Variable de connexion
    $_SESSION['username'] = $login->username();
    $_SESSION['customerId'] = $login->customerId();
    $_SESSION['loginObject'] = serialize($login);
    $_SESSION['customerObject'] = serialize($customer);
    $_SESSION['connected'] = true;
    $_SESSION['status'] == 2;

    unset($_SESSION['createdCustomer']);
    
    header('Location: ../' . $_SESSION['redirect']);
    unset($_SESSION['redirect']);
    exit();
}