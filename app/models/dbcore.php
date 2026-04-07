<?php
require_once './configs/database.php';
class Dbcore{
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
        $val = array_values($data);
        
        // Tạo danh sách cột: col1, col2, col3
        $columns = implode(',', $key);
        
        // Tạo danh sách placeholder: ?, ?, ?
        $placeholders = implode(',', array_fill(0, count($key), '?'));
        
        // Tạo SQL query
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        
        // Prepare và execute với parameterized query
        $stm = $this->conn->prepare($sql);
        return $stm->execute($val);
    }

	public function update($sql) {
		$stm = $this->conn -> prepare($sql);
		$stm -> execute();
	}

}
