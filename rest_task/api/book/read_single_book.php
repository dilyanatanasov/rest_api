<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Book.php';

$database = new Database();
$db = $database->connect();

$book = new Book($db);

$book->id_book = isset($_GET['id_book']) ? $_GET['id_book'] : die();

$result = $book->read_single_book();

$book_array = array(
    'id' => $book->id_book,
    'title' => $book->title,
    'description' => $book->description,
    'genre' => $book->genre,
    'author' => array(
        'first_name' => $book->auth_first_name,
        'last_name' => $book->auth_last_name
    )
);

print_r(json_encode($book_array));