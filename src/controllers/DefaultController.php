<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    private UserRepository $userRepository;

    public function __construct() {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function index() {
        $this->render('login');
    }

    public function signup() {
        $this->render('signup');
    }

    public function profile() {
        $this->requireLogin();
        $user = $this->getLoggedUser();
        $this->render('profile', ['user' => $user]);
    }

    public function favourites() {
        $this->requireLogin();
        $user = $user = $this->getLoggedUser();
        $this->render('favourites', ['user' => $user]);
    }
}