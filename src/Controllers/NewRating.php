<?php
namespace Controllers;

class NewRating extends \Framework\Controller
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
        return $this->renderView('newrating', array(
            'user' => $this->authenticationManager->getAuthenticatedUser(),
            'product' => $this->dataLayer->getProductById($this->getParam('pid'))
        ));
    }

    public function POST_Create(){
        $p = $this->dataLayer->createRating(
            $this->getParam('pid'),
            $this->authenticationManager->getAuthenticatedUser()->getUserName(),
            $this->getParam('rating'),
            $this->getParam('cm')
        );

        return $this->redirect('Index', 'Product', array(
            'pid' => $p
        ));
    }

    public function GET_Delete(){

        $this->dataLayer->deleteRating($this->getParam('rid'));

        return $this->redirect('Index', 'UserHome');
    }
}
