<?php
namespace Controllers;

class Product extends \Framework\Controller
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
        return $this->renderView('product', array(
            'user' => $this->authenticationManager->getAuthenticatedUser(),
            'product' => $this->dataLayer->getProductById($this->getParam('pid')),
            'score' => $this->dataLayer->getAvarageRating($this->getParam('pid')),
            'ratings' => $this->dataLayer->getRatingsByProductId($this->getParam('pid'))
        ));
    }
}
