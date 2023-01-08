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
     * Récupère l'ID du dernier login ajouté
     * @return int
     */
    public function lastInsertedId()
    {
        return $this->getLastInsertedId('logins');
    }
}