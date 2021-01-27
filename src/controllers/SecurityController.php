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
        $passwordHash = hash('sha512', $password);

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

        $_SESSION['userId'] = $user->getId();
        $_SESSION['userLogin'] = $user->getLogin();
        $_SESSION['isUserLogged'] = true;

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/homepage");


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

        $user = new User(0, $login, hash('sha512', $password), $email);
        $this->userRepository->addUser($user);

        return $this->render('login', ['messages' => ['You\'ve been succesfully registrated!']]);
    }

    public function logout() {
        $this->requireLogin();
        if (!$this->isPost()) {
            return $this->render('profile');
        }

        $_SESSION['isUserLogged'] = false;
        session_unset();
        session_destroy();

        return $this->render('login', ['messages' => ['You\'ve succesfully logged out!']]);
    }

    public function changePassword() {
        $this->requireLogin();
        if (!$this->isPost()) {
            return $this->render('profile');
        }

        $oldPassword = $_POST['oldPassword'];
        $newPassword = $_POST['newPassword'];
        $repeatNewPassword = $_POST['repeatNewPassword'];

        $user = $this->userRepository->getUserByLogin($_SESSION['userLogin']);

        if ($newPassword !== $repeatNewPassword) {
            return $this->render('profile', ['messages' => ['Passwords don\'t match!'], 'user' => $user]);
        }

        if (hash('sha512', $oldPassword) !== $user->getPassword()) {
            return $this->render('profile', ['messages' => ['Old password doesn\'t match!'], 'user' => $user]);
        }

        $this->userRepository->changePassword(hash('sha512', $newPassword));

        return $this->render('profile', ['messages' => ['Password successfully changed!'], 'user' => $user]);
    }
}