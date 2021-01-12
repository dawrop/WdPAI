<?php

require_once 'AppController.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../models/User.php';

class SecurityController extends AppController {
    private UserRepository $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function login() {
        if (!$this->isPost()) {
            return $this->render('login');
        }

        $login = $_POST['login'];
        $password = $_POST['password'];
        $passwordHash = md5($password);

        $user = $this->userRepository->getUserByLogin($login);

        if (!$user) {
            return $this->render('login', ['messages' => ['User does not exist!']]);
        }

        if($user->getLogin() !== $login) {
            return $this->render('login', ['messages' => ['User with this login does not exist!']]);
        }

        if($user->getPassword() !== $passwordHash) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        return  $this->render('homepage');
//        $url = "http://$_SERVER[HTTP_HOST]";
//        header("Lociation: {$url}/homepage");
    }

    public function signup() {
        if (!$this->isPost()) {
            return $this->render('signup');
        }

        $login = $_POST['login'];
        $password = $_POST['password'];
        $repeatPassword = $_POST['repeatPassword'];
        $email = $_POST['email'];

        if ($password !== $repeatPassword) {
            return $this->render('signup', ['messages' => ['Please provide proper password']]);
        }

        if ($this->userRepository->getUserByLogin($login) !== null) {
            return $this->render('signup', ['messages' => ['Login is already taken!']]);
        }

        if ($this->userRepository->getUserByEmail($email) !== null) {
            return $this->render('signup', ['messages' => ['Email is already in use!']]);
        }

        $user = new User($login, md5($password), $email);
        $this->userRepository->addUser($user);

        return $this->render('login', ['messages' => ['You\'ve been succesfully registrated!']]);
    }
}