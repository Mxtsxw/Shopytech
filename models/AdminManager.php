<?php 

class AdminManager extends Model
{
    public function getAdmins() 
    {
        // Nom de la table ; objet créé
        return $this->getAll('admin','Admin'); 
    }

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

    // Vérifie si l'utilisateur existe
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