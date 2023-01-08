<?php
session_start();
require_once('../Models/Model.php');
require_once('../Models/DeliveryAddresses.php');
//les fonctions
function addUser($id, $customerId, $userName, $password) 
{
    // connexion à la base de données
    $bdd = new PDO('mysql:host=localhost; dbname=web4shop; charset=utf8', 'root','');

    // préparation de la requête d'insertion
    $query = $bdd->prepare("INSERT INTO Logins(id, customer_id, username, password) VALUES (:id, :customerId, :userName, :password)");

    // liaison des variables à la requête
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->bindValue(':customerId', $customerId, PDO::PARAM_INT);
    $query->bindValue(':userName', $userName, PDO::PARAM_STR);
    $query->bindValue(':password', $password, PDO::PARAM_STR);

    // exécution de la requête
    $query->execute();
}

function addCustomer($id,$forname,$surname,$add1,$add2,$add3,$postcode,$phone,$email,$registered)
{
$bdd = new PDO('mysql:host=localhost; dbname=web4shop; charset=utf8', 'root','');

// préparation de la requête d'insertion
$query = $bdd->prepare("INSERT INTO Customers(id, forname, surname, add1, add2, add3, postcode, phone, email, registered) VALUES (:id, :forname, :surname, :add1, :add2, :add3, :postcode, :phone, :email, :registered)");

// liaison des variables à la requête
$query->bindValue(':id', $id, PDO::PARAM_INT);
$query->bindValue(':forename', $forname, PDO::PARAM_STR);
$query->bindValue(':surname', $surname, PDO::PARAM_STR);
$query->bindValue(':add1', $add1, PDO::PARAM_STR);
$query->bindValue(':add2', $add2, PDO::PARAM_STR);
$query->bindValue(':add3', $add3, PDO::PARAM_STR);
$query->bindValue(':postcode', $postcode, PDO::PARAM_INT);
$query->bindValue(':phone', $phone, PDO::PARAM_INT);
$query->bindValue(':email', $email, PDO::PARAM_STR);
$query->bindValue(':registered', $registered, PDO::PARAM_INT);

// exécution de la requête
$query->execute(array(
    ':id' => $id,
    ':forname' => $forname,
    ':surname' => $surname,
    ':add1' => $add1,
    ':add2' => $add2,
    ':add3' => $add3,
    ':postcode' => $postcode,
    ':phone' => $phone,
    ':email' => $email,
    ':registered' => $registered
));
}
//fin des fonctions

// Si toutes les variables requises sont passées en POST
if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['add1']) && isset($_POST['add2']) && isset($_POST['city']) && isset($_POST['zip']) && isset($_POST['phone'])) {
    
    // Vérifie que les variables ne sont pas vides
    if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['add1']) && !empty($_POST['city']) && !empty($_POST['zip']) && !empty($_POST['phone'])) {
       
        // Vérifie que l'email est valide (du côté du serveur)
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

            // Vérifie que le code postal est valide (du côté du serveur)
            if (preg_match('#^[0-9]{5}$#', $_POST['zip'])) {

                // Vérifie que le numéro de téléphone est valide (du côté du serveur)
                if (preg_match('#^[0-9]{10}$#', $_POST['phone'])) {
                    
                    // Met a jour le statut de la commande
                    $_SESSION['status'] = 1;
                    // Créer un nouvel objet DeliveryAddresses
                    $deliveryAddress = new DeliveryAddresses([
                        'firstname' => $_POST['firstname'],
                        'lastname' => $_POST['lastname'],
                        'add1' => $_POST['add1'],
                        'add2' => $_POST['add2'],
                        'city' => $_POST['city'],
                        'postcode' => $_POST['zip'],
                        'phone' => $_POST['phone'],
                        'email' => $_POST['email']
                    ]);

                    // Stocke l'objet DeliveryAddresses dans la session
                    $_SESSION['deliveryAddress'] = serialize($deliveryAddress);
                    
                    if (isset($_POST['create-account'])) {
                        // la case créer compte a été cochée
                        //on va donc créer un compte ici
                        
                        session_start();
                        
                        // Importation des modules nécessaires
                        require_once('../models/Model.php');
                        require_once('../models/Logins.php');
                        require_once('../models/LoginsManager.php');
                        require_once('../models/Customers.php');
                        require_once('../models/CustomersManager.php');
                        
                        // Connexion à la base de données
                        $loginsManager = new loginsManager();
                        $customersManager = new CustomersManager();
                        
                        
                        // Récupération des données du formulaire
                        //par défaut le mot de passe créé est le last et le firstname entreposés de nombres randoms
                        //ce mot de passe peut toujours être modifié dans le profile
                        $username = $_POST['lastname'];
                        $password = $_POST['lastname']. strval(mt_rand(1,100)) .$_POST['firstname'] . strval(mt_rand(1,100));
                        //création du compte :
                        //génération des id
                        //récupération du dernier indice
                        $bdd = new PDO('mysql:host=localhost; dbname=web4shop; charset=utf8', 'root','');
                        $query = $bdd->prepare("SELECT MAX(id) FROM Logins");
                        $query->execute();
                    
                        //vérification
                        if ($query->rowCount() > 0) {
                        // la requête a renvoyé un résultat
                        $result = $query->fetch();
                        $max = $result[0]; // récupère la première colonne du résultat (l'indice maximum)
                        $one=1; //on ajoute une seule personne à la bd
                        $id = $max + $one;
                        } 
                        else {
                        // la requête n'a pas renvoyé de résultat (la table est vide)
                        $id = 0;
                        }
                        $customerId=$id;
                    
                        //ajout de l'utilisateur
                        addUser($id,$customerId,$username,$password);
                        //ajout du customer avec ses données
                        $surname=$_POST['lastname'];$forname=$_POST['firstname'];$add1=$_POST['add1'];$add2=$_POST['add2'];$add3=$_POST['city'];$postcode=$_POST['zip'];$phone=$_POST['phone'];$email=$_POST['email'];$registered=1;
                        addCustomer($customerId,$forname,$surname,$add1,$add2,$add3,$postcode,$phone,$email,$registered);
                    
                        if ($loginsManager->checkLogin($username, $password)) //connexion après création
                        {
                            $user = $loginsManager->getLogin($username, $password);
                            $customerObj = $customersManager->getCustomerById($user->customerId());
                        
                            // Création des variables de session
                            $_SESSION['username'] = $user->username();
                            $_SESSION['customerId'] = $user->customerId();
                            $_SESSION['connected'] = true;
                            $_SESSION['customerObject'] = serialize($customerObj);
                            $_SESSION['loginObject'] = serialize($user);
                        }
                    }

                }
            }
        }
    }
}

else 
{
    // Redirection avec un message d'erreur
    $_SESSION['error_message'] = "Une erreur est survenue lors de la validation du formulaire, veuillez réessayer";
    header('Location: ../validation');
}

// Redirection à la page de paiement (étape suivante)
header('Location: ../validation/payment');
exit();
?>

