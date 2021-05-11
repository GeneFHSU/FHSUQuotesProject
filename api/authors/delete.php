<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

require_once('../../model/authors_db.php');

//if($_SERVER['REQUEST_METHOD'] != 'DELETE') exit();

//Process the DELETE parameters
//https://joshtronic.com/2014/06/01/how-to-process-put-requests-with-php/
if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
    parse_str(file_get_contents("php://input"), $_PUT);
    foreach ($_PUT as $key => $value)
    {
        unset($_PUT[$key]);
        $_PUT[str_replace('amp;', '', $key)] = $value;
    }
    $_REQUEST = array_merge($_REQUEST, $_PUT);
}

//Sanitize the DELETE parameters
if(isset($authorId)) $authorId = filter_var( $_REQUEST["id"], FILTER_SANITIZE_NUMBER_INT);

//Debug
$authorId = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);

//Verify all parameters present
if (empty($authorId))
    echo json_encode(array('error' => 'authorId is missing.'));
else {
    //Update the author in the database
    $author = AuthorsDB::delete_author($authorId) ?? array("message"=>"Author Deleted");
    echo json_encode($author);
}