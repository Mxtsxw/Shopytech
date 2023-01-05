<?php 

class CustomersManager extends Model
{
    public function getCustomers() 
    {
        // Nom de la table ; objet créé
        return $this->getAll('customers','Customers'); 
    }

    public function getCustomerbyId($id){

        // Création de la requête générales pour la table
        $req = $this->getBdd()->prepare('SELECT * FROM customers WHERE id = '. $id);
        $req ->execute();

        if ($req->rowCount() == 0) {
            throw new Exception("Unvalid ID");                // lève une exception
        }

        // Retourne le résultat
        $data = $req ->fetch(PDO::FETCH_ASSOC);
        return new Customers($data);
    }
}