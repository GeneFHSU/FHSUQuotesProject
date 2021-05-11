<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');

require_once('../../model/authors_db.php');

//if($_SERVER['REQUEST_METHOD'] != 'PUT') exit();

//Process the PUT parameters
//https://joshtronic.com/2014/06/01/how-to-process-put-requests-with-php/
if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{
    parse_str(file_get_contents("php://input"), $_PUT);
    foreach ($_PUT as $key => $value)
    {
        unset($_PUT[$key]);
        echo "PUT1";
        $_PUT[str_replace('amp;', '', $key)] = $value;
    }
    $_REQUEST = array_merge($_REQUEST, $_PUT);
}

//Sanitize the PUT parameters
$authorId = filter_var( $_REQUEST["id"], FILTER_SANITIZE_NUMBER_INT);
$author = filter_var( $_REQUEST["author"], FILTER_SANITIZE_STRING );

//Debug
$authorId = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
$author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_STRING);


//Verify all parameters present
if (empty($authorId) || empty($author))
    echo json_encode(array('error' => 'Either the author or authorId is missing.'));
else {
    //Update the author in the database
    $author = AuthorsDB::update_author($authorId,$author) ?? array("message"=>"Author Updated");
    echo json_encode($author);
}