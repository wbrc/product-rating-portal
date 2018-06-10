<?php
namespace Controllers;

class NewProduct extends \Framework\Controller
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
        return $this->renderView('newproduct', array(
            'user' => $this->authenticationManager->getAuthenticatedUser(),
        ));
    }

    public function GET_Update()
    {
        return $this->renderView('newproduct', array(
            'user' => $this->authenticationManager->getAuthenticatedUser(),
            'product' => $this->dataLayer->getProductById($this->getParam('pid'))
        ));
    }



    public function POST_Create(){
        if ($this->getParam('pn') == "" || $this->getParam('manu') == "") {
            return $this->renderView('newproduct', array(
                'user' => $this->authenticationManager->getAuthenticatedUser(),
                'errors' => array('No empty fields allowed'),
            ));
        }


        $p = $this->dataLayer->createProduct(
            $this->getParam('pn'),
            $this->getParam('manu'),
            $this->authenticationManager->getAuthenticatedUser()->getUserName()
        );

        return $this->redirect('Index', 'Product', array(
            'pid' => $p
        ));
    }

    public function POST_Update(){
        if ($this->getParam('pn') == "" || $this->getParam('manu') == "") {
            return $this->renderView('newproduct', array(
                'user' => $this->authenticationManager->getAuthenticatedUser(),
                'product' => $this->dataLayer->getProductById($this->getParam('pid')),
                'errors' => array('No empty fields allowed')
            ));
        }


        $p = $this->dataLayer->updateProduct(
            $this->getParam('pid'),
            $this->getParam('pn'),
            $this->getParam('manu'),
            $this->authenticationManager->getAuthenticatedUser()->getUserName()
        );

        return $this->redirect('Index', 'Product', array(
            'pid' => $p
        ));
    }

    public function GET_Delete(){

        $this->dataLayer->deleteProduct($this->getParam('pid'));

        return $this->redirect('Index', 'UserHome');
    }
}
