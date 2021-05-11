<?php

require_once('../../model/authors_db.php');

if($_SERVER['REQUEST_METHOD'] != 'POST') exit();

//Process the POST parameters
$author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_STRING);

//Verify all parameters present
if (empty($author))
    echo json_encode(array('error' => 'No author provided.'));
else {
    //Add the category to the database
    $quotes = AuthorsDB::add_author($author) ?? array("message"=>"Author Created");
    echo json_encode($quotes);
}




