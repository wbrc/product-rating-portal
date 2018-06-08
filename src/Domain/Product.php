<?php
namespace Domain;

class Product extends Entity
{
    private $productName;
    private $userID;
    private $manufacturer;
    private $description;

    public function __construct($id, $productName, $userID, $manufacturer, $description)
    {
        parent::__construct($id);
        $this->productName = $productName;
        $this->userID = $userID;
        $this->manufacturer = $manufacturer;
        $this->description = $description;
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

    public function getDescription()
    {
        return $this->description;
    }
}
