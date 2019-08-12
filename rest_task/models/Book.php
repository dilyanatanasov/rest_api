<?php

class Book{
    private $conn;
    private $table = 'books';

    public $id_book;
    public $title;
    public $description;
    public $genre;
    public $auth_first_name;
    public $auth_last_name;

    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
        $query = 'SELECT * FROM '. $this->table;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function read_single_book(){
        $query = 'SELECT * FROM '. $this->table .
        ' WHERE id_book = ? LIMIT 1';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id_book);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->title = $row['title'];
        $this->description = $row['description'];
        $this->genre = $row['genre'];
        $this->auth_first_name = $row['auth_first_name'];
        $this->auth_last_name = $row['auth_last_name'];
    }

    public function create(){
        $query = 'INSERT INTO ' . $this->table . ' 
            SET
                title = :title,
                description = :description,
                genre = :genre,
                auth_first_name = :auth_first_name,
                auth_last_name = :auth_last_name 
        ';

        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->genre = htmlspecialchars(strip_tags($this->genre));
        $this->auth_first_name = htmlspecialchars(strip_tags($this->auth_first_name));
        $this->auth_last_name = htmlspecialchars(strip_tags($this->auth_last_name));

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':genre', $this->genre);
        $stmt->bindParam(':auth_first_name', $this->auth_first_name);
        $stmt->bindParam(':auth_last_name', $this->auth_last_name);

        if($stmt->execute()){
            return true;
        }

        print_f("Error: %s.\n". $stmt->error);

        return false;
    }

    public function update(){
        $query = "UPDATE " . $this->table . " 
            SET
                title = :title,
                description = :description,
                genre = :genre,
                auth_first_name = :auth_first_name,
                auth_last_name = :auth_last_name, 
                auth_last_name = :auth_last_name 
            WHERE
                id_book = :id_book";

        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->genre = htmlspecialchars(strip_tags($this->genre));
        $this->auth_first_name = htmlspecialchars(strip_tags($this->auth_first_name));
        $this->auth_last_name = htmlspecialchars(strip_tags($this->auth_last_name));
        $this->id_book = htmlspecialchars(strip_tags($this->id_book));

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':genre', $this->genre);
        $stmt->bindParam(':auth_first_name', $this->auth_first_name);
        $stmt->bindParam(':auth_last_name', $this->auth_last_name);
        $stmt->bindParam(':id_book', $this->id_book);

        if($stmt->execute()){
            return true;
        }

        print_f("Error: %s.\n". $stmt->error);

        return false;
    }

    public function delete(){
        $query = 'DELETE FROM ' . $this->table . ' 
            WHERE
                id_book = :id_book
        ';

        $stmt = $this->conn->prepare($query);

        $this->id_book = htmlspecialchars(strip_tags($this->id_book));

        $stmt->bindParam(':id_book', $this->id_book);

        if($stmt->execute()){
            return true;
        }

        print_f("Error: %s.\n". $stmt->error);

        return false;
    }
}
