<?php
// All the SQL injection is manage inside this by using prepare()
require_once './configs/database.php';
class Dbcore
{
    private $conn;
    public function __construct()
    {
        $this->conn = Database::connectPDO();
    }
    // get all rows of the query result
    public function getAll($sql, $params = [])
    {
        $stm = $this->conn->prepare($sql);
        $stm->execute($params);
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    // get first row of the query result
    public function getOne($sql,  $params = [])
    {
        $stm = $this->conn->prepare($sql);
        $stm->execute($params);
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    //countRow : đếm số lượng bản ghi trả về sau khi thực hiện
    public function countRow($sql,  $params = [])
    {
        $stm = $this->conn->prepare($sql);
        $stm->execute($params);
        return $stm->rowCount();
    }


    /*
        $data = [
            'key1' => value1;
            ...
        ]
        $sql = "INSERT INTO $table ('key1',...) VALUES (':value1',...);  
    */
    public function insert($table, $data)
    {
        // no parameters are provided
        if (empty($data)) {
            $sql = "INSERT INTO $table DEFAULT VALUES";
            $stm = $this->conn->prepare($sql);
            return $stm->execute();
        }

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

    // insert into table set col1 = val1, col2 = val2 where id = 1;
    public function insertReturn($table, $data, $returning)
    {

        // no parameters are provided
        if (empty($data)) {
            $sql = "INSERT INTO $table DEFAULT VALUES RETURNING $returning";
            $stm = $this->conn->prepare($sql);
            $stm->execute();
            return $stm->fetchColumn();
        }

        $key = array_keys($data);
        $val = array_values($data);

        // Tạo danh sách cột: col1, col2, col3
        $columns = implode(',', $key);

        // Tạo danh sách placeholder: ?, ?, ?
        $placeholders = implode(',', array_fill(0, count($key), '?'));

        // Tạo SQL query
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders) RETURNING $returning";

        // Prepare và execute với parameterized query
        $stm = $this->conn->prepare($sql);
        $stm->execute($val);
        return $stm->fetchColumn();
    }

    public function query($sql, $params = [])
    {
        $stm = $this->conn->prepare($sql);
        return $stm->execute($params);
    }

    public function update($table, $data, $where, $whereParams = [])
    {
        if (empty($data)) {
            return false;
        }

        $key = array_keys($data);
        $val = array_values($data);

        // Tạo "col1 = ?, col2 = ?, col3 = ?"
        $setClause = implode(', ', array_map(fn($col) => "$col = ?", $key));

        $sql = "UPDATE $table SET $setClause WHERE $where";

        // Giá trị bind theo đúng thứ tự: SET trước, rồi tới WHERE
        $params = array_merge($val, $whereParams);

        $stm = $this->conn->prepare($sql);
        return $stm->execute($params);
    }
}
