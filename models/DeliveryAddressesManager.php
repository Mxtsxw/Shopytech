<?php

class DeliveryAddressesManager extends Model
{
    /**
     * Récupère toutes les adresses de livraison
     * @return array
     * @throws Exception
     */
    public function getDeliveryAddresses() 
    {
        return $this->getAll('delivery_addresses','DeliveryAddresses'); 
    }

    /**
     * Récupère une adresse de livraison par son ID
     * @param int $id
     * @return DeliveryAddresses
     * @throws Exception
     */
    public function getDeliveryAddressById($id) 
    {
        // Création de la requête générales pour la table
        $req = $this->getBdd()->prepare('SELECT * FROM delivery_addresses WHERE id = '. $id);
        $req ->execute();

        if ($req->rowCount() == 0) {
            throw new Exception("Unvalid ID");
        }

        // Retourne le résultat
        $data = $req ->fetch(PDO::FETCH_ASSOC);
        return new DeliveryAddresses($data);
    }

    /**
     * Ajoute une adresse de livraison à la base de données
     * @param DeliveryAddresses 
     * @return int ID de l'adresse de livraison ajoutée
     */
    public function addDeliveryAddress($address)
    {
        // Création de la requête générales pour la table
        $req = $this->getBdd()->prepare('INSERT INTO delivery_addresses (firstname, lastname, add1, add2, city, postcode, phone, email) VALUES (:firstname, :lastname, :add1, :add2, :city, :postcode, :phone, :email)');
        $req->bindValue(':firstname', $address->firstname(), PDO::PARAM_STR);
        $req->bindValue(':lastname', $address->lastname(), PDO::PARAM_STR);
        $req->bindValue(':add1', $address->add1(), PDO::PARAM_STR);
        $req->bindValue(':add2', $address->add2(), PDO::PARAM_STR);
        $req->bindValue(':city', $address->city(), PDO::PARAM_STR);
        $req->bindValue(':postcode', $address->postcode(), PDO::PARAM_INT);
        $req->bindValue(':phone', $address->phone(), PDO::PARAM_INT);
        $req->bindValue(':email', $address->email(), PDO::PARAM_STR);
        $req->execute();
        
        return $this->lastInsertedId();
    }

    /**
     * Mise à jour d'une adresse de livraison dans la base de données
     * @param DeliveryAddresses
     * @return void
     */
    public function updateDeliveryAddress($address)
    {
        // Création de la requête générales pour la table
        $req = $this->getBdd()->prepare('UPDATE delivery_addresses SET firstname = :firstname, lastname = :lastname, add1 = :add1, add2 = :add2, city = :city, postcode = :postcode, phone = :phone, email = :email WHERE id = :id');
        $req ->execute(array(
            'firstname' => $address->firstname(),
            'lastname' => $address->lastname(),
            'add1' => $address->add1(),
            'add2' => $address->add2(),
            'city' => $address->city(),
            'postcode' => $address->postcode(),
            'phone' => $address->phone(),
            'email' => $address->email(),
            'id' => $address->id()
        ));
    }

    /**
     * Récupère l'ID de la dernière adresse de livraison ajoutée
     * @return int
     */
    public function lastInsertedId()
    {
        return $this->getLastInsertedId('delivery_addresses');
    }
}