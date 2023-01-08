<?php
session_start();
if(isset($_POST['username']) && isset($_POST['password'])&& isset($_POST['varCo']))
{
 // connexion à la base de données
$bdd_username = 'root';
$bdd_password = '';
$bdd_name = 'web4shop';
$bdd_host = 'localhost';
$bdd = mysqli_connect($bdd_host, $bdd_username, $bdd_password,$bdd_name)
or die('could not connect to database');
 
// on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
// pour éliminer toute attaque de type injection SQL et XSS
$username = mysqli_real_escape_string($bdd,htmlspecialchars($_POST['username'])); 
$password = mysqli_real_escape_string($bdd,htmlspecialchars($_POST['password']));
$varCo=$_POST['varCo'];

if($varCo==0) //connexion
{
    if($username !== "" && $password !== "")
    {
    $requete = "SELECT count(*) FROM logins where 
    username = '".$username."' and password = '".$password."' ";
    $exec_requete = mysqli_query($bdd,$requete);
    $reponse = mysqli_fetch_array($exec_requete);
    $count = $reponse['count(*)'];
    if($count!=0) // nom d'utilisateur et mot de passe correctes
    {
    $_SESSION['username'] = $username;
    header('Location: index.php');
    }
    else if (isset($_POST['erreur'])) //si il y a eu des erreurs
    {
        $erreur= $_POST['erreur'];
        if ($erreur==1)
        {
        header('Location: ./logins?erreur=1'); // utilisateur ou mot de passe incorrect
        }
        }
        else
        {
        header('Location: ./logins?erreur=2'); // utilisateur ou mot de passe vide
        }
    }
    }
    else
    {
    header('Location:  ./logins?erreur=1');
    }
}
else  //inscription
{
    //génération des id
    $id = "SELECT mas(id) FROM logins";
    $id=$id +1;
    $customerId=$id;

    //ajout de l'utilisateur
    addUser($id,$customerId,$userName,$password);
    header('Location:  ./logins?varco=100');
}
    
mysqli_close($bdd); // fermer la connexion
?>
