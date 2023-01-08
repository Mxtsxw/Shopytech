<?php 

class CustomersManager extends Model
{
    /**
     * Récupère tous les clients
     * @return array
     * @throws Exception
     */
    public function getCustomers() 
    {
        return $this->getAll('customers','Customers'); 
    }

    /**
     * Récupère un client par son ID
     * @param int $id
     * @return Customers
     * @throws Exception
     */
    public function getCustomerbyId($id){

        $req = $this->getBdd()->prepare('SELECT * FROM customers WHERE id = '. $id);
        $req ->execute();

        if ($req->rowCount() == 0) {
            throw new Exception("Unvalid ID");
        }

        $data = $req ->fetch(PDO::FETCH_ASSOC);
        return new Customers($data);
    }

    /**
     * Mise à jour d'un client dans la base de données
     * @param Customers
     * @return void
     */
    public function updateCustomer($customer) 
    {
        // Création de la requête générales pour la table
        $req = $this->getBdd()->prepare('UPDATE customers SET forname = :firstname, surname = :lastname, email = :email, phone = :phone, add1 = :add1, add2 = :add2, add3 = :add3, postcode = :zip  WHERE id = :id');
        $req ->execute(array(
            'firstname' => $customer->forename(),
            'lastname' => $customer->surname(),
            'email' => $customer->email(),
            'phone' => $customer->phone(),
            'add1' => $customer->add1(),
            'add2' => $customer->add2(),
            'add3' => $customer->add3(),
            'zip' => $customer->postcode(),
            'id' => $customer->id()
        ));
    }

    /**
     * Ajoute un client dans la base de données
     * @param Customers $customer
     * @return int l'ID du client ajouté
     */
    public function addCustomer($customer)
    {
        $req = $this->getBdd()->prepare('INSERT INTO customers (forname, surname, email, phone, add1, add2, add3, postcode) VALUES (:firstname, :lastname, :email, :phone, :add1, :add2, :add3, :zip)');
        $req ->execute(array(
            'firstname' => $customer->forename(),
            'lastname' => $customer->surname(),
            'email' => $customer->email(),
            'phone' => $customer->phone(),
            'add1' => $customer->add1(),
            'add2' => $customer->add2(),
            'add3' => $customer->add3(),
            'zip' => $customer->postcode(),
        ));

        return $this->lastInsertedId();
    }

    /**
     * Récupère l'ID du dernier client ajouté
     * @return int
     */
    public function lastInsertedId()
    {
        return $this->getLastInsertedId('customers');
    }
}