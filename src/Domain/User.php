<?php
namespace Domain;

class User extends Entity
{
    private $userName;
    private $password;

    public function __construct($id, $userName, $password)
    {
        parent::__construct($id);
        $this->userName = $userName;
        $this->password = $password;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function getPassword()
    {
        return $this->password;
    }
}
