<?php
namespace Controllers;

class Home extends \Framework\Controller
{
    private $authenticationManager;
    private $dataLayer;
    public function __construct(\DataLayer\DataLayer $dataLayer, \BusinessLogic\AuthenticationManager $authenticationManager)
    {
        $this->dataLayer = $dataLayer;
        $this->authenticationManager = $authenticationManager;
    }
    public function GET_Index()
    {

        $products = array();

        foreach ($this->dataLayer->getProducts() as $product) {
            $d = array();
            $d[0] = $this->dataLayer->getAvarageRating($product->getId());
            $d[1] = $this->dataLayer->getNumRatings($product->getId());
            $d[2] = $product;
            $d[3] = $this->dataLayer->getUser($product->getUserID());
            array_push($products, $d);
        }

        return $this->renderView('home', array(
            'user' => $this->authenticationManager->getAuthenticatedUser(),
            'products' => $products,
        ));
    }

    public function POST_Index()
    {
        $products = array();

        foreach ($this->dataLayer->getProductsWithFilter($this->getParam('f')) as $product) {
            $d = array();
            $d[0] = $this->dataLayer->getAvarageRating($product->getId());
            $d[1] = $this->dataLayer->getNumRatings($product->getId());
            $d[2] = $product;
            $d[3] = $this->dataLayer->getUser($product->getUserID());
            array_push($products, $d);
        }

        return $this->renderView('home', array(
            'user' => $this->authenticationManager->getAuthenticatedUser(),
            'products' => $products,
        ));
    }
}
