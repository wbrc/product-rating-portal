<?php
namespace Domain;

class Rating extends Entity
{
    private $userID;
    private $score;
    private $productId;
    private $description;

    public function __construct($id, $productID, $userID, $score, $description)
    {
        parent::__construct($id);
        $this->productId = $productID;
        $this->userID = $userID;
        $this->score = $score;
        $this->description = $description;
    }

    public function getProductID()
    {
        return $this->productId;
    }

    public function getUserID()
    {
        return $this->userID;
    }

    public function getScore()
    {
        return $this->score;
    }

    public function getDescription()
    {
        return $this->description;
    }
}
