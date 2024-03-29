<?php
namespace Controllers;

class User extends \Framework\Controller
{

    private $authenticationManager;
    private $dataLayer;

    const PARAM_USER_NAME = 'un';
    const PARAM_PASSWORD = 'pwd';
    public function __construct(\DataLayer\DataLayer $dataLayer, \BusinessLogic\AuthenticationManager $authenticationManager)
    {
        $this->dataLayer = $dataLayer;
        $this->authenticationManager = $authenticationManager;
    }

    public function GET_LogIn()
    {
        if ($this->authenticationManager->isAuthenticated()) {
            return $this->redirect('Index', 'Home');
        }
        return $this->renderView('login', array(
            'user' => $this->authenticationManager->getAuthenticatedUser(),
            'userName' => $this->getParam(self::PARAM_USER_NAME),
        ));
    }
    public function POST_LogIn()
    {
        if (!$this->authenticationManager->authenticate(
            $this->getParam(self::PARAM_USER_NAME),
            $this->getParam(self::PARAM_PASSWORD)
        )) {
            return $this->renderView('login', array(
                'user' => $this->authenticationManager->getAuthenticatedUser(),
                'userName' => $this->getParam(self::PARAM_USER_NAME),
                'errors' => array('Invalid user name or password.'),
            ));
        }
        return $this->redirect('Index', 'Home');
    }
    public function POST_LogOut()
    {
        $this->authenticationManager->signOut();
        return $this->redirect('Index', 'Home');
    }

    public function GET_Register()
    {
        return $this->renderView('register', array(
            'user' => $this->authenticationManager->getAuthenticatedUser(),
            'userName' => $this->getParam(self::PARAM_USER_NAME),
        ));
    }

    public function POST_Register()
    {
        if ($this->getParam(self::PARAM_USER_NAME) == "" || $this->getParam(self::PARAM_PASSWORD) == ""){
            return $this->renderView('register', array(
                'user' => $this->authenticationManager->getAuthenticatedUser(),
                'userName' => $this->getParam(self::PARAM_USER_NAME),
                'errors' => array('invalid username or password'),
            ));
        }

        if ($this->dataLayer->createUser(
            $this->getParam(self::PARAM_USER_NAME),
            $this->getParam(self::PARAM_PASSWORD))) {
            return $this->redirect('LogIn', 'User');
        } else {
            return $this->renderView('register', array(
                'user' => $this->authenticationManager->getAuthenticatedUser(),
                'userName' => $this->getParam(self::PARAM_USER_NAME),
                'errors' => array('User already exists'),
            ));
        }
    }
}
