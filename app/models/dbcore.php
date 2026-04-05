<?php
require_once './configs/database.php';
class dbcore{
    private $conn;
    public function __construct(){
        $this->conn = Database::connectPDO();
    }
	// get all rows of the query result
    public function getAll($sql){
        $stm = $this->conn -> prepare($sql);
        $stm -> execute();
        $result = $stm -> fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
	// get first row of the query result
    public function getOne($sql){
        $stm = $this->conn -> prepare($sql);
        $stm -> execute();
        $result = $stm -> fetch(PDO::FETCH_ASSOC);
        return $result;
    }

//countRow : đếm số lượng bản ghi trả về sau khi thực hiện
    public function countRow($sql){
        $stm = $this->conn -> prepare($sql);
        $stm -> execute();
        return $stm -> rowCount();
    }
// insert into table set col1 = val1, col2 = val2 where id = 1;
    public function insert($table, $data){
        $key = array_keys($data);
    }

	public function update($sql) {
		$stm = $this->conn -> prepare($sql);
		$stm -> execute();
	}

}
