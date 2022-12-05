<?php
class Orders
{
    // Les attributs de l'article
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
    // hydratation → vérificiationd des champs et attributions des variables
    public function hydrate(array $data)
    {
        foreach($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method))
                $this->$method($value);
        }
    }

    //setters
    public function setCustomerId($customerId)
    {
        $customerId=(int) $customerId;
        if($customerId>0)
        $this ->_customerId = $customerId;
    }

    public function setRegistered($registered)
    {
        $registered=(int) $registered;
        if($registered>0)
        $this ->_registered = $registered;
    }

    public function setTotal($total)
    {
        $total=(double) $total; //est un double
        if($total>0)
        $this ->_total = $total;
    }

    public function setStatus($status)
    {
        $status=(int) $status;
        if ($status > 0)
        $this ->_status = $status;
    }
    
    public function setPaymentType($paymentType)
    {
        if(is_string($paymentType)) //payment est un string
        $this->_paymentType =  $paymentType;
    }

    public function setSession($session)
    {
        if(is_string($session)) //payment est un string
        $this->_session =  $session;
    }

    public function setId($id)
    {
        $id=(int) $id;
        if ($id > 0) //l'attribut id est un int et doit être sup à 0
        $this ->_id = $id;
    }

    public function setDeliveryAddId($deliveryAddId)
    {
        $deliveryAddId=(int) $deliveryAddId;
        if ($deliveryAddId > 0)
        $this ->_deliveryAddId = $deliveryAddId;
    }

    public function setDate($date)
    { //pas besoin de vérifications
        $this->_date =  $date;
    }

    //getters
    public function id()
    {
        return $this->_id;
    }
    public function date()
    {
        return $this->_date;
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