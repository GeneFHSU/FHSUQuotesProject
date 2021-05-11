<?php
require('model/authors_db.php');
require('model/categories_db.php');
require('model/quotes_db.php');

//sanitize url query parameters
$authorId = filter_input(INPUT_GET, 'author_id', FILTER_VALIDATE_INT);
$categoryId = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);

//If empty, set to null
if(empty($authorId)) $authorId = null;
if(empty($categoryId)) $categoryId = null;

//Get data from models
$authors = AuthorsDB::get_authors();
$categories = CategoriesDB::get_categories();
$quotes = QuoteDB::get_quotes($authorId, $categoryId);

include('view/quotes_list.php');