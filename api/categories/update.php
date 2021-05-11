<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');

require_once('../../model/categories_db.php');

if($_SERVER['REQUEST_METHOD'] != 'PUT'){
    echo json_encode(array('error' => 'Invalid request method.'));
    exit();
}
if($_SERVER["CONTENT_TYPE"] != 'text/plain'){
    echo json_encode(array('error' => 'Invalid content-type encoding.'));
    exit();
}

$_PUT = json_decode(file_get_contents("php://input"),true);

//Verify all parameters present
if(!isset($_PUT["id"]) || !isset($_PUT["category"]))
{
    echo json_encode(array('error' => 'A parameter is missing.'));
    exit();
}

//Sanitize the PUT parameters
$categoryId = filter_var( $_PUT["id"], FILTER_SANITIZE_NUMBER_INT);
$category = filter_var( $_PUT["category"], FILTER_SANITIZE_STRING );

//Verify all parameters present
if (empty($categoryId) || empty($category))
    echo json_encode(array('error' => 'A parameter is missing.'));
else {
    //Update the author in the database
    $category = CategoriesDB::update_category($categoryId,$category) ?? array("message"=>"Category Updated");
    echo json_encode($category);
}