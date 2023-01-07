<?php
class Orders
{
    // Les attributs de la classe Orders
    private $_id;
    private $_customerId;
    private $_registered;
    private $_deliveryAddId;
    private $_paymentType;
    private $_date;
    private $_status;
    private $_session;
    private $_total;


    // Constructeur
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    // "hydratation" → pour chaque champs passé dans le tableau $data, on vérifie si un setter existe et on l'appelle
    public function hydrate(array $data)
    {
        foreach($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method))
                $this->$method($value);
        }
    }

    // -- Setters --
    public function setId($id)
    {
        $this ->_id = (int) $id;
    }

    public function setCustomer_id($customerId)
    {
        $this ->_customerId = (int) $customerId;
    }

    public function setRegistered($registered)
    {
        $this ->_registered = (int) $registered;
    }

    public function setDelivery_add_id($deliveryAddId)
    {
        $this ->_deliveryAddId = (int) $deliveryAddId;
    }
    
    public function setPayment_type($paymentType)
    {
        $this->_paymentType = (string) $paymentType;
    }

    public function setDate($date)
    { 
        $this->_date = $date;
    }

    public function setStatus($status)
    {
        $this ->_status = (int) $status;
    }

    public function setSession($session)
    {
        $this->_session = (string) $session;
    }

    public function setTotal($total)
    {
        if($total >= 0)
            $this ->_total =(double) $total;
    }

    // -- Getters --
    public function id()
    {
        return $this->_id;
    }
    
    public function customerId()
    {
        return $this->_customerId;
    }

    public function registered()
    {
        return $this->_registered;
    }

    public function deliveryAddId()
    {
        return $this->_deliveryAddId;
    }

    public function paymentType()
    {
        return $this->_paymentType;
    }

    public function date()
    {
        return $this->_date;
    }

    public function status()
    {
        return $this->_status;
    }

    public function session()
    {
        return $this->_session;
    }

    public function total()
    {
        return $this->_total;
    }
}