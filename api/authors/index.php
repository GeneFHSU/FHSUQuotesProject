<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

require_once('../../model/authors_db.php');

//Verify no POST, PUT, or DELETE data
if ($_SERVER['REQUEST_METHOD'] != 'GET') exit();

//Process the GET parameters
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$random = filter_input(INPUT_GET, 'random', FILTER_VALIDATE_BOOLEAN);

$authors = AuthorsDB::get_authors();

if(!is_null($random))
    echo json_encode($authors[array_rand($authors)]);
else
    echo json_encode($authors);


