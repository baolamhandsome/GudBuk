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
        $bookid = $_POST['bookid'] ?? '';
        $title = $_POST['title'] ?? '';
        $author = $_POST['author'] ?? '';
        $price = $_POST['price'] ?? '';
        $stock_quantity = $_POST['stock_quantity'] ?? '';
        $description = $_POST['description'] ?? '';
        $category = $_POST['category'] ?? '';
        $isbn = $_POST['isbn'] ?? '';
        $sql = "UPDATE book
        SET 
            title = '$title',
            author = '$author',
            price = $price,
            stock_quantity = $stock_quantity,
            isbn = '$isbn',
            description = '$description'
        WHERE 
            bookid = $bookid;
        ";

        $this->update($sql);
    }
}
