<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

require_once('../../model/categories_db.php');

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
    $categoryId = filter_var( $_DELETE["id"], FILTER_SANITIZE_NUMBER_INT);

//Verify all parameters present
if (empty($categoryId))
    echo json_encode(array('error' => 'categoryId is missing.'));
else {
    //Delete the category in the database
    $category = CategoriesDB::delete_category($categoryId) ?? array("message"=>"Category Deleted");
    echo json_encode($category);
}