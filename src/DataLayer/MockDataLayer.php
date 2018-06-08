<?php
namespace DataLayer;

use \Domain\Product;
use \Domain\Rating;
use \Domain\User;

class MockDataLayer implements DataLayer
{
    private $__products;
    private $__users;
    private $__ratings;

    public function __construct()
    {
        $this->__users = array(1 => new User(1, "test"),
            2 => new User(2, "smitty"));
        $this->__products = array(1 => new Product(1, "IPhone 6", 1, "Apple", "A smartphone"));
        $this->__ratings = array(1 => new Rating(1, 1, 1, 4, "Gut aber nicht perfekt"),
            2 => new Rating(2, 1, 2, 5, "iphone is so geil man"));
    
    }
    
    
    public function getUser($id)
    {
        return array_key_exists($id, $this->__users) ? $this->__users[$id] : null;
    }

    public function getUserForUserNameAndPassword($userName, $password)
    {
        foreach ($this->__users as $user) {
            if ($user->getUserName() == $userName && $userName == $password) {
                return $user;
            }
        }
        return null;
    }

    public function createUser($userName, $password){
        return false;
    }


    public function getProducts(){
        $products = $this->__products;
        return $products;
    }

    public function getProductById($id){
        foreach ($this->__products as $product) {
            if ($product->getId() == $id){
                return $product;
            }
        }
        return null;
    }

    public function getProductFilter($filter){
        $products = array();
        foreach ($this->__products as $product) {
            if (strpos($product->getProductName(), $filter) !== false ){
                array_push($products, $product);
            }
        }
        return $products;
    }

    public function getRatingsByProductId($productID){
        $ratings = array();
        foreach ($this->__ratings as $rating) {
            if ($rating->getProductID() == $productID){
                array_push($ratings, $rating);
            }
        }
        return $ratings;
    }
}
