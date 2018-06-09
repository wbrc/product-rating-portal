<?php
namespace Controllers;

class UserHome extends \Framework\Controller
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
        $productRatings = array();
        $ratings = $this->dataLayer->getRatingsByUser($this->authenticationManager->getAuthenticatedUser()->getUserName());

        
        foreach ($ratings as $rating) {
            $d = array();
            $d[0] = $this->dataLayer->getProductById($rating->getProductID());
            $d[1] = $rating;
            array_push($productRatings, $d);
        }

        return $this->renderView('userhome', array(
            'user' => $this->authenticationManager->getAuthenticatedUser(),
            'products' => $this->dataLayer->getProductsByUser($this->authenticationManager->getAuthenticatedUser()->getUserName()),
            'ratings' => $productRatings,
        ));
    }
}
