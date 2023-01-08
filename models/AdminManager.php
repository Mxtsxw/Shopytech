<?php 

class AdminManager extends Model
{
    public function getAdmins() 
    {
        return $this->getAll('admin','Admin'); 
    }

    /**
     * Récupère un utilisateur par ses identifiants
     * La méthode est censée vérifiér le chiffrement du mot de passe
     * @param string $username
     * @param string $password
     * @return Admin
     */
    public function getAdmin($username, $password) 
    {
        // Création de la requête générales pour la table
        $req = $this->getBdd()->prepare('SELECT * FROM admin WHERE username = :username AND password = :password');
        $req ->execute(array(
            'username' => $username,
            'password' => $password
        ));

        // Retourne le résultat
        $data = $req ->fetch(PDO::FETCH_ASSOC);

        // Si le résultat est vide, on lève une exception
        if ($data == false) {
            throw new Exception("Utilisateur ou mot de passe incorrect");   // lève une exception
        }

        return new Admin($data);
    }

    /**
     * Vérifie que l'utilisteur Admin existe
     * La méthode est censée vérifiér le chiffrement du mot de passe
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function checkAdmin($username, $password) 
    {
        // Création de la requête générales pour la table
        $req = $this->getBdd()->prepare('SELECT * FROM admin WHERE username = :username AND password = :password');
        $req ->execute(array(
            'username' => $username,
            'password' => $password
        ));

        // Retourne le résultat
        $data = $req ->fetch(PDO::FETCH_ASSOC);

        // Si le résultat est vide, on lève une exception
        if ($data == false) {
            return false;
        }

        return true;
    }

}