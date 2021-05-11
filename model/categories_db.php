<?php

require_once 'database.php';

class CategoriesDB
{
    public static function get_categories()
    {
        $db = Database::getDB();
        $query = 'SELECT * FROM categories ORDER BY id';
        $statement = $db->prepare($query);
        $statement->execute();
        $categories = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $categories;
    }

    public static function get_category($category_id)
    {
        $db = Database::getDB();
        $query = 'SELECT * FROM categories WHERE id = :category_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id, PDO::PARAM_INT);
        $statement->execute();
        $category = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $category;
    }

    public static function delete_category($category_id)
    {
        $db = Database::getDB();

        //verify author exists
        if(empty(CategoriesDB::get_category($category_id)))
            return  array('error' => 'categoryId does not exist.');

        //delete linked quotes
        $query = 'DELETE FROM quotes WHERE categoryId = :category_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id, PDO::PARAM_INT);
        $statement->execute();

        //delete category
        $query = 'DELETE FROM categories WHERE id = :category_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id,PDO::PARAM_INT);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function add_category($category_name)
    {
        $db = Database::getDB();
        $query = 'INSERT INTO categories (category)
              VALUES
                 (:category_name)';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_name', $category_name);
        try {
            $statement->execute();
        } catch (PDOException $e) {
            if ($e->getCode() == '23000') //Unique key exception
                return array('error' => 'Unable to add category. It already exists.');
            else throw $e;
        }
        $statement->closeCursor();
    }

    public static function update_category($category_id,$category_name)
    {
        $db = Database::getDB();

        //verify author exists
        if(empty(CategoriesDB::get_category($category_id)))
            return  array('error' => 'categoryId does not exist.');

        $query = 'UPDATE categories
                    SET category = :category_name
                    WHERE id = :category_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->bindValue(':category_name', $category_name);
        $statement->execute();
        $statement->closeCursor();
    }
}