////// BASIC CRUD REST API //////

1. Extract the folder called rest_task in your web server directory(www/htdocs)

2. Load the DB and the Table with the SQL.txt file content. The DB is called books_db and the table books. The books table will be preloaded with 2 records.
Table structure is:
id_book autoincremented integer
title string
description string
genre string
auth_first_name string
auth_last_name string

3. Use Postman or any other software to make the requests

3.1 Use the path http://localhost/rest_task/api/book/read.php to display all records. To do so set the method to GET.

3.2 Use the path http://localhost/rest_task/api/book/read_single_book.php to display a single book. To do so set the method to GET, set the headers Content-Type to application/json and add to the url ?id_book={number of your choice} or add a param in Postman - id_book/{number of your choice}

3.3 Use the path http://localhost/rest_task/api/book/create.php to add a new book. You have to set the method to POST, set the Content-Type to application/json and pass to the body the new data. All fields are required so you have to provide all of the fields with information.
To do so add to the Body ass raw data the needed info like a json object:
{
	"title" : "Test",
	"description" : "Test",
	"genre" : "Test",
	"auth_first_name" : "Test",
	"auth_last_name" : "Test"
}
You cant pass the data as form-data because the script is expecting an object not an array

3.4 Use the path http://localhost/rest_task/api/book/update.php to update the content of a book record. To do so set the method to PUT, set the headers Content-Type to applicaiton/json and pass the updated data in the Body as raw data. Specify the "id_book"!
{
	"id_book" : "{num}"
	"title" : "Test",
	"description" : "Test",
	"genre" : "Test",
	"auth_first_name" : "Test",
	"auth_last_name" : "Test"
}

3.5 Use the path http://localhost/rest_task/api/book/delete.php to delete a single book record. To do so set the method to DELETE, set the headers Content-Type to application/json and pass the "id_book" of the book that needs to be deleted as raw data in the Body.