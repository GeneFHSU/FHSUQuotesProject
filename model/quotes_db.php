<?php

require_once ('database.php');

class QuoteDB
{

    //Returns a single quote with the id, quote, author, and category fields.
    public static function get_quote($quote_id)
    {
        $db = Database::getDB();

        $query = 'SELECT Q.id, Q.quote, A.author, C.category
                    FROM quotes Q
                    LEFT JOIN authors A ON Q.authorId = A.id
                    LEFT JOIN categories C ON Q.categoryId = C.id
                    WHERE Q.id = :quote_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':quote_id', $quote_id);
        $statement->execute();
        $quote = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $quote;
    }

    //Get quotes by authorID or Category
    public static function get_quotes($authorId = null, $categoryId = null, $limit = null)
    {
        $db = Database::getDB();

        $query = 'SELECT Q.id, Q.quote, A.author, C.category
                    FROM quotes Q
                    LEFT JOIN authors A ON Q.authorId = A.id
                    LEFT JOIN categories C ON Q.categoryId = C.id';
        if(!is_null($authorId)) $query .= ' WHERE A.id = :author_id ';
        if(!is_null($authorId) && !is_null($categoryId)) $query .= ' AND ';
        if(!is_null($categoryId)){
            if(is_null($authorId)) $query .= ' WHERE ';
            $query .= ' C.id = :category_id ';
        }

        $query.= ' ORDER BY Q.id ';
        if(!is_null($limit)) $query .= ' LIMIT :limit';

        $statement = $db->prepare($query);
        if(!is_null($authorId))  $statement->bindValue(':author_id', $authorId);
        if(!is_null($categoryId))  $statement->bindValue(':category_id', $categoryId);
        if(!is_null($limit))  $statement->bindValue(':limit', $limit, PDO::PARAM_INT);

        $statement->execute();
        $quotes = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $quotes;
    }

    //Add a quote
    public static function add_quote($quote, $authorId, $categoryId)
    {
        $db = Database::getDB();
        $query = 'INSERT INTO quotes (quote, authorId, categoryId)
              VALUES
                 (:quote, :author_id, :category_id)';
        $statement = $db->prepare($query);
        $statement->bindValue(':quote', $quote);
        $statement->bindValue(':author_id', $authorId);
        $statement->bindValue(':category_id', $categoryId);
        try {
            $statement->execute();
        } catch (PDOException $e) {
            if ($e->getCode() == '23000') //Foreign key exception
                return array('error' => 'Unable to add quote. Either the authorId or categoryId is invalid.');
            else throw $e;
        }
        $statement->execute();
        $statement->closeCursor();
    }

    public static function delete_quote($quote_id)
    {
        $db = Database::getDB();

        //verify author exists
        if(empty(QuoteDB::get_quote($quote_id)))
            return  array('error' => 'QuoteId does not exist.');

        //delete quote
        $query = 'DELETE FROM quotes WHERE id = :quote_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':quote_id', $quote_id,PDO::PARAM_INT);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function update_quote($quoteId, $quote, $authorId, $categoryId)
    {
        $db = Database::getDB();

        //verify quote exists
        if(empty(QuoteDB::get_quote($quoteId)))
            return  array('error' => 'QuoteId does not exist.');

        //Update the quote
        $query = 'UPDATE quotes
                    SET quote = :quote, authorId = :author_id, categoryId = :category_id 
                    WHERE id = :quote_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':quote_id', $quoteId);
        $statement->bindValue(':quote', $quote);
        $statement->bindValue(':author_id', $authorId);
        $statement->bindValue(':category_id', $categoryId);
        $statement->execute();
        $statement->closeCursor();
    }
}