<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

require_once('../../model/categories_db.php');

if($_SERVER['REQUEST_METHOD'] != 'POST') exit();

//Process the POST parameters
$category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);

//Verify all parameters present
if (empty($category))
    echo json_encode(array('error' => 'No category provided.'));
else {
    //Add the category to the database
    $quotes = CategoriesDB::add_category($category) ?? array("message"=>"Category Created");
    echo json_encode($quotes);
}




