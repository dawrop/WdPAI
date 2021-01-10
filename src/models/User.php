<?php


class User {
    private $login;
    private $password;
    private $email;

    public function __construct($login, $password, $email)
    {
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }



}