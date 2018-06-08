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
        return $this->renderView('home', array(
            'user' => $this->authenticationManager->getAuthenticatedUser(),
            'products' => $this->dataLayer->getProducts()
        ));
    }
}
