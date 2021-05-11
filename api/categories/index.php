<?php

require_once('../../model/categories_db.php');

//Verify no POST, PUT, or DELETE data
if ($_SERVER['REQUEST_METHOD'] != 'GET') exit();

//Process the GET parameters
$random = filter_input(INPUT_GET, 'random', FILTER_VALIDATE_BOOLEAN);

$categories = CategoriesDB::get_categories();

if(!is_null($random))
    echo json_encode($categories[array_rand($categories)]);
else
    echo json_encode($categories);


