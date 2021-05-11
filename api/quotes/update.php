<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');

require_once('../../model/quotes_db.php');

if($_SERVER['REQUEST_METHOD'] != 'PUT'){
    echo json_encode(array('error' => 'Invalid request method.'));
    exit();
}
if($_SERVER["CONTENT_TYPE"] != 'text/plain'){
    echo json_encode(array('error' => 'Invalid content-type encoding.'));
    exit();
}

echo "Decoding";
$_PUT = json_decode(file_get_contents("php://input"),true);
echo "Decoded";

//Verify all parameters present
/*if(!isset($_PUT["id"]) || !isset($_PUT["quote"]) || !isset($_PUT["authorId"]) || !isset($_PUT["categoryId"]))
{
    echo "Verify";
    echo json_encode(array('error' => 'A parameter is missing.'));
    exit();
}*/
//Sanitize the PUT parameters
echo "Sanitizing";
$id = filter_var( $_PUT["id"], FILTER_SANITIZE_NUMBER_INT);
$quote = filter_var( $_PUT["quote"], FILTER_SANITIZE_STRING);
$authorId = filter_var( $_PUT["authorId"], FILTER_SANITIZE_NUMBER_INT);
$categoryId = filter_var(($_PUT["categoryId"]), FILTER_SANITIZE_NUMBER_INT);
echo "Sanitized";

//Verify all parameters present
if (empty($id) || empty($quote) || empty($authorId) || empty($categoryId))
    echo json_encode(array('error' => 'A parameter is missing.'));
else {
    //Update the quote in the database
    echo "updating";
    $quote = QuoteDB::update_quote($id, $quote, $authorId, $categoryId) ?? array("message"=>"Quote Updated");
    echo "updated";
    echo json_encode($quote);
}