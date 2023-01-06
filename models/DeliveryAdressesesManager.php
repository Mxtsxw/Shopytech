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
        $req ->execute(array(
            'firsnname' => $address->firstname(),
            'lastname' => $address->lastname(),
            'add1' => $address->add1(),
            'add2' => $address->add2(),
            'city' => $address->city(),
            'postcode' => $address->postcode(),
            'phone' => $address->phone(),
            'email' => $address->email(),
        ));

        return $this->getLastInsertedId('delivery_addresses');
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
}