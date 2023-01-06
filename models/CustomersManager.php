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

    // update customers takes object as argument
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

}