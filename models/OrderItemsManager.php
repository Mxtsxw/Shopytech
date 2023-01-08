<?php 
class OrderItemsManager extends Model
{
    /**
     * Récupère tous les articles des commandes
     * @return array
     */
    public function getOrderItems() 
    {
        return $this->getAll('ordersitems','OrdersItems'); 
    }

    /**
     * Récupère un article d'une commande par son ID
     * @param int $id
     * @return OrdersItems
     * @throws Exception
     */
    public function getOrderItemById($id)
    {
        $req = $this->getBdd()->prepare('SELECT * FROM orderitems WHERE id = '. $id);
        $req ->execute();

        if ($req->rowCount() == 0) {
            throw new Exception("Unvalid ID");
        }

        $data = $req ->fetch(PDO::FETCH_ASSOC);
        return new OrdersItems($data);
    }

    /**
     * Récupère tous les articles d'une commande via son ID
     * @param int $id
     * @return array[OrdersItems]
     * @throws Exception
     */
    public function getOrderItemsByOrderId($id)
    {
        $req = $this->getBdd()->prepare('SELECT * FROM orderitems WHERE order_id = '. $id);
        $req ->execute();

        if ($req->rowCount() == 0) {
            throw new Exception("Unvalid ID");
        }

        $items = [];

        while ($data = $req ->fetch(PDO::FETCH_ASSOC))
        {
            $items[] = new OrderItems($data);
        }
        
        return $items;
    }

    /**
     * Ajoute un article de commande dans la base de données
     * @param OrderItems
     * @return int
     */
    public function addOrderItem(OrderItems $orderItem)
    {
        $req = $this->getBdd()->prepare('INSERT INTO orderitems (order_id, product_id, quantity) VALUES (:order_id, :product_id, :quantity)');
        $req->bindValue(':order_id', $orderItem->orderId(), PDO::PARAM_INT);
        $req->bindValue(':product_id', $orderItem->productId(), PDO::PARAM_INT);
        $req->bindValue(':quantity', $orderItem->quantity(), PDO::PARAM_INT);
        $req->execute();

        return $this->lastInsertedId();
    }

    /**
     * Récupère l'ID du dernier article de commande ajouté
     * @return int
     */
    public function lastInsertedId()
    {
        return $this->getLastInsertedId('orderitems');
    }
}