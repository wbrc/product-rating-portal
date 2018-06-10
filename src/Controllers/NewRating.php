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
            'product' => $this->dataLayer->getProductById($this->getParam('pid')),
        ));
    }

    public function GET_Update()
    {
        return $this->renderView('newrating', array(
            'user' => $this->authenticationManager->getAuthenticatedUser(),
            'product' => $this->dataLayer->getProductById($this->getParam('pid')),
            'rating' => $this->dataLayer->getRatingById($this->getParam('rid')),
        ));
    }

    public function POST_Create()
    {
        if ($this->getParam('rating') < 1 || $this->getParam('rating') > 5) {
            return $this->renderView('newrating', array(
                'user' => $this->authenticationManager->getAuthenticatedUser(),
                'product' => $this->dataLayer->getProductById($this->getParam('pid')),
                'errors' => array("Invalid data provided"),
            ));
        }

        $p = $this->dataLayer->createRating(
            $this->getParam('pid'),
            $this->authenticationManager->getAuthenticatedUser()->getUserName(),
            $this->getParam('rating'),
            $this->getParam('cm')
        );

        return $this->redirect('Index', 'Product', array(
            'pid' => $p,
        ));
    }

    public function POST_Update()
    {

        if ($this->getParam('rating') < 1 || $this->getParam('rating') > 5) {
            return $this->renderView('newrating', array(
                'user' => $this->authenticationManager->getAuthenticatedUser(),
                'product' => $this->dataLayer->getProductById($this->getParam('pid')),
                'rating' => $this->dataLayer->getRatingById($this->getParam('rid')),
                'errors' => array("Invalid data provided"),
            ));
        }

        $this->dataLayer->updateRating(
            $this->getParam('rid'),
            $this->authenticationManager->getAuthenticatedUser()->getUserName(),
            $this->getParam('rating'),
            $this->getParam('cm')
        );

        return $this->redirect('Index', 'Product', array(
            'pid' => $this->getParam('pid'),
        ));
    }

    public function GET_Delete()
    {

        $this->dataLayer->deleteRating($this->getParam('rid'));

        return $this->redirect('Index', 'UserHome');
    }
}
