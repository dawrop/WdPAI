<?php


class User {
    private $id;
    private $login;
    private $password;
    private $email;
    private $profileImage;
    private $permission;

    public function __construct(int $id, string $login, string $password, string $email, string $profileImage = "default.png", int $permission = 0) {
        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->profileImage = $profileImage;
        $this->permission = $permission;
    }

    public function getId(): int
    {
        return $this->id;
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