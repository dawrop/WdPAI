<?php

class AppController {
    private $request;
    private UserRepository $userRepository;

    public function __construct() {
        $this->request = $_SERVER['REQUEST_METHOD'];
        $this->userRepository = new UserRepository();
    }

    protected function isGet(): bool {
        return $this->request === 'GET';
    }

    protected function isPost(): bool {
        return $this->request === 'POST';
    }

    protected function render(string $template = null, array $variables = []) {
        $templatePath = 'public/views/'.$template.'.php';
        $output = 'File not found';

        if(file_exists($templatePath)){
            extract($variables);

            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }
        print $output;
    }

    protected function requireLogin() {
        if (!$_SESSION['isUserLogged']) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/login");
            die();
        }
    }

    protected function getLoggedUser() {
        return $this->userRepository->getUserByLogin($_SESSION['userLogin']);
    }
}