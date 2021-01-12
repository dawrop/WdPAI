<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('homepage', 'DefaultController');
Routing::get('profile', 'DefaultController');
Routing::get('settings', 'DefaultController');
Routing::post('login', 'SecurityController');
Routing::post('signup', 'SecurityController');

Routing::run($path);