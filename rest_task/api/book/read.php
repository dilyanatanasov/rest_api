<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Book.php';

$database = new Database();
$db = $database->connect();

$book = new Book($db);
$result = $book->read();
$num = $result->rowCount();

if($num > 0){
    $books_array = [];
    $books_array['data'] = [];

    while($row = $result->fetch(PDO::FETCH_ASSOC)){

        $book_item = array(
            'id' => $row['id_book'],
            'title' => $row['title'],
            'description' => $row['description'],
            'genre' => $row['genre'],
            'author' => array(
                'first_name' => $row['auth_first_name'],
                'last_name' => $row['auth_last_name']
            )
        );

        array_push($books_array['data'], $book_item);
    }

    echo json_encode($books_array);

} else {
    echo json_encode(
        array('message' => 'No Books Found')
    );
}