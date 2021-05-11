<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

require_once('../../model/quotes_db.php');

//If not a GET request, exit
if($_SERVER['REQUEST_METHOD'] != 'GET') exit();

//Filter input for id
$quoteid = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

//If no valid id input, return empty array
if(empty($quoteid))
    echo json_encode([]);
else {
    //Process the provided id against the Quote DB
    $quote = QuoteDB::get_quote($quoteid);

    //Returns a single quote with the id, quote, author, and category fields.
    //If no quote found, returns empty []
    echo json_encode((!empty($quote) ? $quote : []));
}


