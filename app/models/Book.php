<?php

class Book extends Dbcore
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getTotalBook()
    {
        $row = $this->countRow('SELECT bookid FROM book WHERE is_active = TRUE');
        return $row;
    }
    public function getAllBook()
    {
        $sql = "SELECT * FROM book WHERE is_active = TRUE";
        $result = $this->getAll($sql);
        return $result;
    }
    public function getBookHome($bookperpage, $curpage, $offset)
    {
        /*
        truyền data vào cho render()
        */
        $sql = "SELECT * FROM book WHERE is_active = TRUE ORDER BY sold DESC LIMIT $bookperpage OFFSET $offset";
        $result = $this->getAll($sql);
        return $result;
    }
    public function searchBook($query)
    {
        $sql = "SELECT * FROM book WHERE is_active = TRUE AND (title ILIKE '%$query%' OR author ILIKE '%$query%')";

        $result = $this->getAll($sql);

        return $result;
    }

    public function getOneBook($bookid)
    {
        $sql = "SELECT * FROM book WHERE bookid = $bookid AND is_active = TRUE";
        $result = $this->getOne($sql);
        return $result;
    }

    //modify
    public function deleteBook($bookid)
    {
        $sql = "UPDATE book 
            SET is_active = FALSE
            WHERE bookid = $bookid
        ";
        $result = $this->update($sql);
    }
    public function editBook()
    {
        $bookCategories = $_POST['category'];
        $bookid = $_POST['bookid'] ?? '';
        $title = $_POST['title'] ?? '';
        $author = $_POST['author'] ?? '';
        $price = $_POST['price'] ?? '';
        $stock_quantity = $_POST['stock_quantity'] ?? '';
        $description = $_POST['description'] ?? '';

        try {
            // BEGIN TRANSACTION
            $this->beginTransaction();

            //phase 1: udpate book infor
            $sql = "UPDATE book
                SET 
                    title = '$title',
                    author = '$author',
                    price = $price,
                    stock_quantity = $stock_quantity,
                    description = '$description'
                WHERE 
                    bookid = $bookid;
            ";

            $this->update($sql);

            //phase 2: udpate book_category (delete the existings and add new categories)
            $sql = "DELETE FROM book_category WHERE bookid = $bookid";
            $this->update($sql);

            foreach ($bookCategories as $bookCategory):
                $insertData = [
                    'bookid' => $bookid,
                    'categoryid' => $bookCategory
                ];
                $this->insert('book_category', $insertData);
            endforeach;
            // END TRANSACTION
            $this->commit();
        } catch (Exception $e) {
            if ($this->inTransaction()) {
                $this->rollBack();
            }
            throw $e;
        }
    }
    public function addBook()
    {
        $bookCategories = $_POST['category'] ?? [];
        $title = $_POST['title'] ?? '';
        $author = $_POST['author'] ?? '';
        $price = $_POST['price'] ?? '';
        $stock_quantity = $_POST['stock_quantity'] ?? '';
        $description = $_POST['description'] ?? '';
        $isbn = $_POST['isbn'] ?? '';


        try {
            // BEGIN TRANSACTION
            $this->beginTransaction();

            //phase 1: add book 
            $insertData = [
                'title' => $title,
                'author' => $author,
                'isbn' => $isbn,
                'price' => $price,
                'stock_quantity' => $stock_quantity,
                'description' => $description
            ];
            $this->insert('book', $insertData);

            //phase 2: add into book_category

            $bookid = $this->getLastInsertId();

            foreach ($bookCategories as $bookCategory):
                $insertData = [
                    'bookid' => $bookid,
                    'categoryid' => $bookCategory
                ];
                $this->insert('book_category', $insertData);
            endforeach;
            // END TRANSACTION
            $this->commit();
        } catch (Exception $e) {
            if ($this->inTransaction()) {
                $this->rollBack();
            }
            throw $e;
        }
    }
}
