<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');

require_once('../../model/quotes_db.php');

//if($_SERVER['REQUEST_METHOD'] != 'PUT') exit();

//Process the PUT parameters
//https://joshtronic.com/2014/06/01/how-to-process-put-requests-with-php/
if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{
    parse_str(file_get_contents("php://input"), $_PUT);
    foreach ($_PUT as $key => $value)
    {
        unset($_PUT[$key]);
        $_PUT[str_replace('amp;', '', $key)] = $value;
    }
    $_REQUEST = array_merge($_REQUEST, $_PUT);
}

//Sanitize the PUT parameters
$id = filter_var( $_REQUEST["id"], FILTER_SANITIZE_NUMBER_INT);
$quote = filter_var( $_REQUEST["quote"], FILTER_SANITIZE_STRING);
$authorId = filter_var( $_REQUEST["authorId"], FILTER_SANITIZE_NUMBER_INT);
$categoryId = filter_var( $_REQUEST["categoryId"], FILTER_SANITIZE_NUMBER_INT);

//Debug
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
$quote = filter_input(INPUT_POST, 'quote', FILTER_SANITIZE_STRING);
$authorId = filter_input(INPUT_POST, 'authorId', FILTER_SANITIZE_STRING);
$categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_STRING);


//Verify all parameters present
if (empty($id) || empty($quote) || empty($authorId) || empty($categoryId))
    echo json_encode(array('error' => 'A parameter is missing.'));
else {
    //Update the quote in the database
    $quote = QuoteDB::update_quote($id, $quote, $authorId, $categoryId) ?? array("message"=>"Quote Updated");
    echo json_encode($quote);
}