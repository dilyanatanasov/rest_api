<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Book.php';

$database = new Database();
$db = $database->connect();

$book = new Book($db);

$data = json_decode(file_get_contents("php://input"));

$book->id_book = $data->id_book;

$book->title = $data->title;
$book->description = $data->description;
$book->genre = $data->genre;
$book->auth_first_name = $data->auth_first_name;
$book->auth_last_name = $data->auth_last_name;

if($book->update()){
    echo json_encode(
        array('message' => 'Book Updated')
    );
}else{
    echo json_encode(
        array('message' => 'Book Not Updated')
    );
}