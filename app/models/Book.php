<?php

class Book extends Dbcore
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getTotalBook()
    {
        $row = $this->countRow('select bookid from book');
        return $row;
    }
    public function getAllBook()
    {
        $sql = "SELECT * FROM book";
        $result = $this->getAll($sql);
        return $result;
    }
    public function getBookHome($bookperpage, $curpage, $offset)
    {
        /*
        truyền data vào cho render()
        */
        $sql = "SELECT * FROM book ORDER BY sold DESC LIMIT $bookperpage OFFSET $offset";
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
        $sql = "SELECT * FROM book WHERE bookid = $bookid";
        $result = $this->getOne($sql);
        return $result;
    }
}
