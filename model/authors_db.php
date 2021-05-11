<?php

require_once 'database.php';

class AuthorsDB
{
    public static function get_authors()
    {
        $db = Database::getDB();
        $query = 'SELECT * FROM authors ORDER BY id';
        $statement = $db->prepare($query);
        $statement->execute();
        $authors = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $authors;
    }

    public static function get_author($author_id)
    {
        if(empty($author_id)) return [];
        $db = Database::getDB();
        $query = 'SELECT * FROM authors WHERE id = :author_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':author_id', $author_id);
        $statement->execute();
        $author = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $author;
    }

    public static function delete_author($author_id)
    {
        $db = Database::getDB();

        //verify author exists
        if(empty(AuthorsDB::get_author($author_id)))
            return  array('error' => 'authorId does not exist.');

        //delete linked quotes
        $query = 'DELETE FROM quotes WHERE authorId = :author_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':author_id', $author_id);
        $statement->execute();

        //delete author
        $query = 'DELETE FROM authors WHERE id = :author_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':author_id', $author_id);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function add_author($author_name)
    {
        $db = Database::getDB();
        $query = 'INSERT INTO authors (author)
              VALUES
                 (:author_name)';
        $statement = $db->prepare($query);
        $statement->bindValue(':author_name', $author_name);
        try {
            $statement->execute();
        } catch (PDOException $e) {
            if ($e->getCode() == '23000') //Unique key exception
                return array('error' => 'Unable to add author. They already exist.');
            else throw $e;
        }
        $statement->closeCursor();
    }

    public static function update_author($author_id,$author_name)
    {
        $db = Database::getDB();

        //verify author exists
        if(empty(AuthorsDB::get_author($author_id)))
            return  array('error' => 'authorId does not exist.');

        $query = 'UPDATE authors
                    SET author = :author_name
                    WHERE id = :author_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':author_id', $author_id);
        $statement->bindValue(':author_name', $author_name);
        $statement->execute();
        $statement->closeCursor();
    }
}