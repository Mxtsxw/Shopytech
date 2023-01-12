<?php
class OrdersManager extends Model
{
    /**
     * Récupère toutes les commandes
     * @return array
     */
    public function getOrders() 
    {
        return $this->getAll('orders','Orders'); 
    }

    /**
     * Récupère une commande par son ID
     * @param int $id
     * @return Orders
     * @throws Exception
     */
    public function getOrderById($id)
    {
        $req = $this->getBdd()->prepare('SELECT * FROM orders WHERE id = '. $id);
        $req ->execute();

        if ($req->rowCount() == 0) {
            throw new Exception("Unvalid ID");
        }

        $data = $req ->fetch(PDO::FETCH_ASSOC);
        return new Orders($data);
    }

    /**
     * Récupère les commandes d'un client via son ID
     * @param int $id
     * @return array[Orders]
     */
    public function getOrdersByCustomerId($id)
    {
        $objects = [];

        $req = $this->getBdd()->prepare('SELECT * FROM orders WHERE customer_id = '. $id . ' ORDER BY id');
        $req ->execute();

        while($data = $req ->fetch(PDO::FETCH_ASSOC))
        {
            $objects[] = new Orders($data);
        }
        
        $req->closeCursor();

        return $objects; 
    }

    /**
     * Ajouter une commande dans la base de données
     * @param Orders
     * @return int l'ID de la commande ajoutée
     */
    public function addOrder(Orders $order)
    {
        $req = $this->getBdd()->prepare('INSERT INTO orders (customer_id, registered, delivery_add_id, payment_type, date, status, session, total) VALUES (:customer_id, :registered, :delivery_add_id, :payment_type, :date, :status, :session, :total)');
        $req->bindValue(':customer_id', $order->customerId(), PDO::PARAM_INT);
        $req->bindValue(':registered', $order->registered(), PDO::PARAM_INT);
        $req->bindValue(':delivery_add_id', $order->deliveryAddId(), PDO::PARAM_INT);
        $req->bindValue(':payment_type', $order->paymentType(), PDO::PARAM_STR);
        $req->bindValue(':date', $order->date(), PDO::PARAM_STR);        
        $req->bindValue(':status', $order->status(), PDO::PARAM_STR);
        $req->bindValue(':session', $order->session(), PDO::PARAM_STR);
        $req->bindValue(':total', $order->total(), PDO::PARAM_STR);
        $req->execute();

        return $this->lastInsertedId();
    }

    /**
     * Mise à jour d'une commande dans la base de données
     * @param Orders
     * @return void
     */
    public function updateOrder(Orders $order)
    {
        $req = $this->getBdd()->prepare('UPDATE orders SET customer_id = :customer_id, registered = :registered, delivery_add_id = :delivery_add_id, payment_type = :payment_type, date = :date, status = :status, session = :session, total = :total WHERE id = :id');
        $req->bindValue(':customer_id', $order->customerId(), PDO::PARAM_INT);
        $req->bindValue(':registered', $order->registered(), PDO::PARAM_INT);
        $req->bindValue(':delivery_add_id', $order->deliveryAddId(), PDO::PARAM_INT);
        $req->bindValue(':payment_type', $order->paymentType(), PDO::PARAM_STR);
        $req->bindValue(':date', $order->date(), PDO::PARAM_STR);        
        $req->bindValue(':status', $order->status(), PDO::PARAM_STR);
        $req->bindValue(':session', $order->session(), PDO::PARAM_STR);
        $req->bindValue(':total', $order->total(), PDO::PARAM_STR);
        $req->bindValue(':id', $order->id(), PDO::PARAM_INT);
        $req->execute();
    }

    /**
     * Récupère l'ID de la dernière commande ajoutée
     * @return int
     */
    public function lastInsertedId()
    {
        return $this->getLastInsertedId('orders');
    }

    /**
     * Met à jour le status de la commande dans la base de données
     * @param int $id : L'ID de la commande
     * @param int $status : Le status à mettre à jour
     * @return void
     */
    public function updateOrderStatus(int $id, int $status){
        $req = $this->getBdd()->prepare('UPDATE orders SET status = :status WHERE id = :id');
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->bindValue(':status', $status, PDO::PARAM_INT);
        $req->execute();
        $req->closeCursor();
    }
}