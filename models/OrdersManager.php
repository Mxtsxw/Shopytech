<?php
class OrderManager extends Model
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

        return $this->getLastInsertedId('orders');
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
}