<?php
namespace Domain;

class Product extends Entity
{
    private $productName;
    private $userID;
    private $manufacturer;

    public function __construct($id, $productName, $userID, $manufacturer)
    {
        parent::__construct($id);
        $this->productName = $productName;
        $this->userID = $userID;
        $this->manufacturer = $manufacturer;
    }

    public function getProductName()
    {
        return $this->productName;
    }

    public function getUserID(){
        return $this->userID;
    }

    public function getManufacturer()
    {
        return $this->manufacturer;
    }
}
