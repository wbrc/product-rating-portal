<?php
namespace DataLayer;

interface DataLayer
{
    public function getUser($id);
    public function getUserForUserNameAndPassword($userName, $password);
    public function createUser($userName, $password);

    public function getProducts();
    public function getProductById($id);
    public function getProductFilter($filter);
    public function getRatingsByProductId($productID);
}
