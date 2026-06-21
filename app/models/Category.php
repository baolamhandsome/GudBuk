<?php

class Category extends Dbcore
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllCat()
    {
        $sql = "SELECT * FROM category ORDER BY categoryname ASC";
        return $this->getAll($sql);
    }
    public function getBookCat($bookid)
    {
        $sql = "SELECT categoryid FROM book_category WHERE bookid = $bookid";
        return $this->getAll($sql);
    }
}
