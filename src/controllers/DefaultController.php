<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    public function index() {
        $this->render('login');
    }

    public function signup() {
        $this->render('signup');
    }

    public function homepage() {
        $this->render('homepage');
    }

    public function profile() {
        $this->render('profile');
    }

    public function settings() {
        $this->render('settings');
    }
}