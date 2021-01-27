<?php

session_start();

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('homepage', 'BookController');
Routing::get('profile', 'DefaultController');
Routing::get('favourites', 'BookController');
Routing::get('trending', 'BookController');
Routing::post('login', 'SecurityController');
Routing::post('signup', 'SecurityController');
Routing::post('addBook', 'BookController');
Routing::post('logout', 'SecurityController');
Routing::post('changePassword', 'SecurityController');
Routing::post('search', 'BookController');
Routing::post('addBookToFav', 'BookController');
Routing::post('removeBookFromFav', 'BookController');

Routing::run($path);