<?php


class Book {
    private $title;
    private $description;
    private $genre;
    private $author;
    private $image;

    public function __construct($id, $title, $description, $genre, $author, $image) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->genre = $genre;
        $this->author = $author;
        $this->image = $image;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function getGenre(): string {
        return $this->genre;
    }

    public function setGenre(string $genre): void {
        $this->genre = $genre;
    }

    public function getAuthor(): string {
        return $this->author;
    }

    public function setAuthor(string $author): void {
        $this->author = $author;
    }

    public function getImage(): string {
        return $this->image;
    }

    public function setImage(string $image): void {
        $this->image = $image;
    }
}