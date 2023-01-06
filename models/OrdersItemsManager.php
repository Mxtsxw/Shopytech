<?php 
class OrdersItemsManager extends Model
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
        $req = $this->getBdd()->prepare('SELECT * FROM ordersitems WHERE id = '. $id);
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
     * @return array
     * @throws Exception
     */
    public function getOrderItemsByOrderId($id)
    {
        $req = $this->getBdd()->prepare('SELECT * FROM ordersitems WHERE order_id = '. $id);
        $req ->execute();

        if ($req->rowCount() == 0) {
            throw new Exception("Unvalid ID");
        }

        $data = $req ->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}