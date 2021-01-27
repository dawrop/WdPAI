<?php

require_once 'AppController.php';
require_once __DIR__.'/../repository/BookRepository.php';
require_once __DIR__.'/../models/Book.php';


class BookController extends AppController {
    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpg'];
    const UPLOAD_DIRECOTRY = '/../public/img/uploads/';

    private $messages = [];
    private $bookRepository;


    public function __construct() {
        parent::__construct();
        $this->bookRepository = new BookRepository();
    }

    public function homepage() {
        $this->requireLogin();

        $books = $this->bookRepository->getBooks();
        $user = $this->getLoggedUser();

        $this->render('homepage', ['books' => $books, 'user' => $user]);
    }

    public function favourites() {
        $this->requireLogin();

        $books = $this->bookRepository->getFavouriteBooks($_SESSION['userId']);
        $user = $this->getLoggedUser();

        $this->render('favourites', ['books' => $books, 'user' => $user]);
    }

    public function trending() {
        $this->requireLogin();

        $books = $this->bookRepository->getTrendingBooks();
        $user = $this->getLoggedUser();

        $this->render('favourites', ['books' => $books, 'user' => $user]);
    }

    public function addBook() {
        $this->requireLogin();
        $user = $this->getLoggedUser();

        if ($user->getPermission() != 1) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/homepage");
        }

        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECOTRY.$_FILES['file']['name']
            );

            $book = new Book(0, $_POST['title'], $_POST['description'], $_POST['genre'], $_POST['author'], $_FILES['file']['name']);
            $this->bookRepository->addBook($book);



            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/homepage");
        }

        $this->render('addBook', ['messages' => $this->message, 'user' => $user]);
    }

    private function validate(array $file): bool {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->messages[] = 'File is too large.';
            return false;
        }

        if (!isset($file['type']) && !in_array($file['type'],self::SUPPORTED_TYPES)) {
            $this->messages[] = 'File type is not supported.';
            return false;
        }

        return true;
    }

    public function search() {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type" application/json');
            http_response_code(200);

            echo json_encode($this->bookRepository->getBookByTitle($decoded['search']));
        }
    }

    public function addBookToFav() {
        $bookId = $_POST['add'];
        $this->bookRepository->addBookToFav($bookId);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/homepage");
    }

    public function removeBookFromFav() {
        $bookId = $_POST['remove'];
        $this->bookRepository->removeBookFromFav($bookId);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/favourites");
    }
}