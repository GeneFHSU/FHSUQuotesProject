<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

require_once('../../model/authors_db.php');

if($_SERVER['REQUEST_METHOD'] != 'DELETE'){
    echo json_encode(array('error' => 'Invalid request method.'));
    exit();
}
if($_SERVER["CONTENT_TYPE"] != 'text/plain'){
    echo json_encode(array('error' => 'Invalid content-type encoding.'));
    exit();
}

$_DELETE = json_decode(file_get_contents("php://input"),true);

//Verify all parameters present
if(!isset($_DELETE["id"]))
{
    echo json_encode(array('error' => 'A parameter is missing.'));
    exit();
}

//Sanitize the DELETE parameters
if(isset($_DELETE["id"]))
    $authorId = filter_var( $_DELETE["id"], FILTER_SANITIZE_NUMBER_INT);

//Verify all parameters present
if (empty($authorId))
    echo json_encode(array('error' => 'authorId is missing.'));
else {
    //Update the author in the database
    $author = AuthorsDB::delete_author($authorId) ?? array("message"=>"Author Deleted");
    echo json_encode($author);
}