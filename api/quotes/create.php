<?php

require_once('../../model/quotes_db.php');

if($_SERVER['REQUEST_METHOD'] != 'POST') exit();

//Process the POST parameters
$quote = filter_input(INPUT_POST, 'quote', FILTER_SANITIZE_STRING);
$authorId = filter_input(INPUT_POST, 'authorId', FILTER_VALIDATE_INT);
$categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_VALIDATE_INT);

//Verify all parameters present
if (empty($quote) || empty($authorId) || empty($categoryId))
    echo json_encode(array('error' => 'Not all all parameters present.'));
else {
    //Add the quote to the database
    $quotes = QuoteDB::add_quote($quote, $authorId, $categoryId) ?? array("message"=>"Quote Created");
    echo json_encode($quotes);
}




