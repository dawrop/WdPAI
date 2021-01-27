<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Book.php';

class BookRepository extends Repository {

    public function getBook(int $id): ?Book {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM book WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $book = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($book == false) {
            return null;
        }

        return new Book($book['id'], $book['title'], $book['description'], $book['genre'], $book['author'], $book['image']);
    }

    public function addBook(Book $book): void {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO books (title, description, genre, author, image)
            VALUES (?, ?, ?, ?, ?)
        ');

        $stmt->execute([
            $book->getTitle(),
            $book->getDescription(),
            $book->getGenre(),
            $book->getAuthor(),
            $book->getImage()
        ]);
    }

    public function getBooks(): array {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM books ORDER BY id DESC
        ');

        $stmt->execute();
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($books as $book) {
            $result[] = new Book(
                $book['id'],
                $book['title'],
                $book['description'],
                $book['genre'],
                $book['author'],
                $book['image']
            );
        }

        return $result;
    }

    public function addBookToFav(int $book_id) {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO user_fav_books (id_user, id_book)
            VALUES (:id_user, :book_id) 
        ');

        $stmt->bindParam(':id_user', $_SESSION['userId'], PDO::PARAM_INT);
        $stmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function removeBookFromFav(int $book_id) {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM user_fav_books WHERE :id_user = id_user AND :book_id = id_book
        ');

        $stmt->bindParam(':id_user', $_SESSION['userId'], PDO::PARAM_INT);
        $stmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);

        $stmt->execute();
    }



    public function getFavouriteBooks(int $id_user): array {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM books INNER JOIN user_fav_books ON books.id = user_fav_books.id_book WHERE :id_user = user_fav_books.id_user 
        ');
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->execute();
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($books as $book) {
            $result[] = new Book(
                $book['id'],
                $book['title'],
                $book['description'],
                $book['genre'],
                $book['author'],
                $book['image']
            );
        }

        return $result;
    }

    public function getTrendingBooks(): array {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM books INNER JOIN user_fav_books ON books.id = user_fav_books.id_book 
        ');

        $stmt->execute();
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($books as $book) {
            $result[] = new Book(
                $book['id'],
                $book['title'],
                $book['description'],
                $book['genre'],
                $book['author'],
                $book['image']
            );
        }

        return $result;
    }

    public function getBookByTitle(string $searchString) {
        $searchString = '%'.strtolower($searchString).'%';

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM books WHERE LOWER(title) LIKE :search OR LOWER(genre) LIKE :search OR LOWER(author) LIKE :search
        ');

        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}