<?php
namespace DataLayer;

interface DataLayer
{
    public function getUser($id);
    public function getUserForUserNameAndPassword($userName, $password);
    public function createUser($userName, $password);

    public function getProducts();
    public function getProductById($id);
    public function getProductsWithFilter($filter);
    public function getRatingsByProductId($productID);
    public function getProductsByUser($userName);
    public function getRatingsByUser($userName);
    public function createProduct($productName, $manufacturer, $uid);
    public function createRating($pid, $uid, $score, $comment);
    public function getAvarageRating($pid);
    public function getNumRatings($pid);
    public function deleteRating($rid);
    public function deleteProduct($pid);
    public function updateProduct($pid, $productName, $manufacturer, $uid);
    public function getRatingById($rid);
    public function updateRating($rid, $uid, $score, $comment);
}
