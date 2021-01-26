<?php


class User {
    private $login;
    private $password;
    private $email;
    private $profileImage;
    private $permission;

    public function __construct(string $login, string $password, string $email, string $profileImage = "default.png", int $permission = 0) {
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->profileImage = $profileImage;
        $this->permission = $permission;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getProfileImage()
    {
        return $this->profileImage;
    }

    public function getPermission()
    {
        return $this->permission;
    }


}