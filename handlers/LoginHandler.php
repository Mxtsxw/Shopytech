<?php 
session_start();

// Importation des modules nécessaires
require_once('../models/Model.php');
require_once('../models/Logins.php');
require_once('../models/LoginsManager.php');
require_once('../models/Customers.php');
require_once('../models/CustomersManager.php');

// Vérification que les variables existent
if (!(isset($_POST['username']) && isset($_POST['password'])))
{
    // Redirection vers la page de connexion avec un message d'erreur
    $_SESSION['error_message'] = "Utilisateur ou mot de passe incorrect";
    header('Location: ../login');
}

// Connexion à la base de données
$loginsManager = new loginsManager();
$customersManager = new CustomersManager();


// Récupération des données du formulaire
$username = $_POST['username'];
$password = $_POST['password'];

if ($loginsManager->checkLogin($username, $password))
{
    $user = $loginsManager->getLogin($username, $password);
    $userObj = $customersManager->getCustomerById($user->customerId());
    var_dump($userObj);

    // Création des variables de session
    $_SESSION['username'] = $user->username();
    $_SESSION['customerId'] = $user->customerId();
    $_SESSION['connected'] = true;

    // Redirection vers la page d'accueil
    // header('Location: ../');
    // exit();
}
else
{
    // Redirection vers la page de connexion avec un message d'erreur
    $_SESSION['error_message'] = "Utilisateur ou mot de passe incorrect";
    header('Location: ../login');
}

