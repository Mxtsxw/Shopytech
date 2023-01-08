<?php 

class LoginsManager extends Model
{
    /**
     * Récupère tous les utilisateurs
     * @return array
     */
    public function getLogins() 
    {
        return $this->getAll('logins','Logins'); 
    }

    /**
     * Récupère un utilisateur par ses identifiants
     * La méthode est censée vérifiér le chiffrement du mot de passe
     * @param string $username
     * @param string $password
     * @return Logins
     * @throws Exception
     */
    public function getLogin($username, $password) 
    {
        $req = $this->getBdd()->prepare('SELECT * FROM logins WHERE username = :username AND password = :password');
        $req ->execute(array(
            'username' => $username,
            'password' => $password
        ));

        $data = $req ->fetch(PDO::FETCH_ASSOC);

        if ($data == false) {
            throw new Exception("Utilisateur ou mot de passe incorrect");
        }

        return new Logins($data);
    }

    /**
     * Vérifie si un utilisateur existe
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function checkLogin($username, $password) 
    {
        $req = $this->getBdd()->prepare('SELECT * FROM logins WHERE username = :username AND password = :password');
        $req ->execute(array(
            'username' => $username,
            'password' => $password
        ));

        $data = $req ->fetch(PDO::FETCH_ASSOC);

        if ($data == false) {
            return false;
        }

        return true;
    }

    /**
     * Vérifie si le nom d'utilisateur exite déjà
     * @param string $username
     * @return bool
     */
    public function checkUsername($username)
    {
        $req = $this->getBdd()->prepare('SELECT * FROM logins WHERE username = :username');
        $req ->execute(array(
            'username' => $username,
        ));

        $data = $req ->fetch(PDO::FETCH_ASSOC);

        if ($data == false) {
            return false;
        }

        return true;
    }

    /**
     * Mise à jour des identifiants d'un utilisateur
     * @param Logins $user
     * @return void
     */
    public function updateLogins($user) 
    {
        // Création de la requête générales pour la table
        $req = $this->getBdd()->prepare('UPDATE logins SET id = :id, customer_id = :customer_id, username = :username, password = :password WHERE id = :id');
        $req ->execute(array(
            'id' => $user->id(),
            'customer_id' => $user->customerId(),
            'username' => $user->username(),
            'password' => $user->password(),
        ));
    }

    /**
     * Ajoute un Login dans la base de données
     * @param Logins $user
     * @return void
     */
    function addUser(Logins $user) {
      
        // préparation de la requête d'insertion
        $req = $this->getBdd()->prepare("INSERT INTO Logins(customer_id, username, password) VALUES (:customerId, :username, :password)");
      
        // liaison des variables à la requête
        $req->bindValue(':customerId', $user->customerId(), PDO::PARAM_INT);
        $req->bindValue(':username', $user->username(), PDO::PARAM_STR);
        $req->bindValue(':password', $user->password(), PDO::PARAM_STR);
      
        // exécution de la requête
        $req->execute();

        // récupération de l'id du dernier enregistrement
        return $this->lastInsertedId();
      }

    /** 
     * Récupère l'ID du dernier login ajouté
     * @return int
     */
    public function lastInsertedId()
    {
        return $this->getLastInsertedId('logins');
    }
}