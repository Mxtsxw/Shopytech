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
     * Récupère l'ID du dernier login ajouté
     * @return int
     */
    public function lastInsertedId()
    {
        return $this->getLastInsertedId('logins');
    }

}