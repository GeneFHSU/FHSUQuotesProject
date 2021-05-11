<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

require_once('../../model/quotes_db.php');

//Verify no POST, PUT, or DELETE data
if($_SERVER['REQUEST_METHOD'] != 'GET') exit();

//Process the GET parameters
$authorId = filter_input(INPUT_GET, 'authorId', FILTER_VALIDATE_INT);
$categoryId = filter_input(INPUT_GET, 'categoryId', FILTER_VALIDATE_INT);
$limit = filter_input(INPUT_GET, 'limit', FILTER_VALIDATE_INT);
$random = filter_input(INPUT_GET, 'random', FILTER_VALIDATE_BOOLEAN);

$quotes = QuoteDB::get_quotes($authorId,$categoryId,$limit);

//Add random field
if(!is_null($random))
    echo json_encode($quotes[array_rand($quotes)]);
else
    echo json_encode($quotes);

?>

