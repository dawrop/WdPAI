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

        return new Book($book['title'], $book['description'], $book['genre'], $book['author'], $book['image']);
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
            SELECT * FROM books ORDER BY id DESC LIMIT 10
        ');
        $stmt->execute();
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($books as $book) {
            $result[] = new Book(
                $book['title'],
                $book['description'],
                $book['genre'],
                $book['author'],
                $book['image']
            );
        }

        return $result;
    }
}