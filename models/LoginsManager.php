<?php 

class LoginsManager extends Model
{
    public function getLogins() 
    {
        // Nom de la table ; objet créé
        return $this->getAll('logins','Logins'); 
    }

    public function getLogin($username, $password) 
    {
        // Création de la requête générales pour la table
        $req = $this->getBdd()->prepare('SELECT * FROM logins WHERE username = :username AND password = :password');
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

        return new Logins($data);
    }

    // Vérifie si l'utilisateur existe
    public function checkLogin($username, $password) 
    {
        // Création de la requête générales pour la table
        $req = $this->getBdd()->prepare('SELECT * FROM logins WHERE username = :username AND password = :password');
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