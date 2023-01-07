<?php if (isset($_POST['create-account'])) {
    // la case créer compte a été cochée
    //on va donc créer un compte ici

    //les fonctions
    function addUser($id, $customerId, $userName, $password) {
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
      
      function addCustomer($id,$forname,$surname,$add1,$add2,$add3,$postcode,$phone,$email,$registered){
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
          // Redirection vers la page d'inscription avec un message d'erreur
          $_SESSION['error_message'] = "Veuillez entrez des valeurs";
          header('Location: ../register');
      }
      
      // Connexion à la base de données
      $loginsManager = new loginsManager();
      $customersManager = new CustomersManager();
      
      
      // Récupération des données du formulaire
      $username = $_POST['username'];
      $password = $_POST['password'];
      
      if ($loginsManager->checkLogin($username, $password)) //si les valeures rentrée existent déjà, on le connecte
      {
          $user = $loginsManager->getLogin($username, $password);
          $customerObj = $customersManager->getCustomerById($user->customerId());
      
          // Création des variables de session
          $_SESSION['username'] = $user->username();
          $_SESSION['customerId'] = $user->customerId();
          $_SESSION['connected'] = true;
          $_SESSION['customerObject'] = serialize($customerObj);
      
          // Redirection vers la page de profile
          header('Location: ../profile');
          exit();
      }
      else
      {
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
          $one=1;
          $id = $max + $one;
          } 
          else {
          // la requête n'a pas renvoyé de résultat (par exemple, la table est vide)
          // gérez cette situation en conséquence (par exemple, initialisez $newIndex à 0 ou à un autre nombre)
          $id = 0;
          }
          $customerId=$id;
      
          //ajout de l'utilisateur
          addUser($id,$customerId,$username,$password);
          //ajout du customer
          $surname="Nom";
          $forname="Prénom";$add1="ligne add1";$add2="ligne add2";$add3="ligne add3";$postcode=1;$phone=1;$email="user@email.mail";$registered=1;
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
          
              exit();
          }
      }
}?>

<div class="mt-5">
    <div class="mb-4 text-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="75" height="75"
            fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
            <path
                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </svg>
    </div>
    <div class="text-center">
        <h1>Nous vous remercions !</h1>
        <p>Cliquez sur le bouton pour recevoir votre facture.</p> 
        <form action="pdf.php" method="post">
            <!-- téléchargement de la facture -->
            <a href="#" type="submit" name="pdf" class="btn btn-primary">Télécharger la facture</a>
        </form>
        <br>
        <a href="<?=ROOT?>/" class="btn btn-primary">Retourner à l'accueuil</a>
    </div>
</div>