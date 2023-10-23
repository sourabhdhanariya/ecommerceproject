<?php

class Database
{
    protected $db_host = "localhost";
    protected $db_user = "root";
    protected $db_pass = "";
    protected $db_name = "project123";
    protected $conn = false;
    protected $result = [];
    protected $mysqli;

    public function __construct()
    {
        if (!$this->conn) {
            $this->mysqli = new mysqli(
                $this->db_host,
                $this->db_user,
                $this->db_pass,
                $this->db_name
            );
            $this->conn = true;
            if ($this->mysqli->connect_error) {
                array_push($this->result, $this->mysqli->connect_error);
            }
        }
    }

    /**
     * InsertCactegory class.
     */
    public function insertData($table, $params = [])
    {
        if ($this->tableExists($table)) {
            $table_columns = implode(",", array_keys($params));
            $table_value = implode("','", $params);

            $sql = "insert into $table($table_columns) values('$table_value')";
            if ($this->mysqli->query($sql)) {
                array_push($this->result, $this->mysqli->insert_id);

                return true;
            } else {
                $error_message =
                    "Error executing query: " . $this->mysqli->error;
                array_push($this->result, $error_message);
                return false;
            }
        } else {
            return false;
        }
    }

    //update data
    public function updateData($table, $params = [], $where = null)
    {
        if ($this->tableExists($table)) {
            $args = [];
            foreach ($params as $key => $value) {
                $args[] = "$key = '$value'";
            }

            $sql = "UPDATE $table SET " . implode(", ", $args);

            if ($where != null) {
                $sql .= " WHERE $where";
            }

            $result = $this->mysqli->query($sql);

            if ($result) {
                array_push($this->result, $this->mysqli->affected_rows);
                return true;
            } else {
                array_push(
                    $this->result,
                    "Error executing query: " . $this->mysqli->error
                );
                return false;
            }
        } else {
            array_push($this->result, "Table does not exist.");
            return false;
        }
    }
    //delete data

    public function deleteData($table, $where = null)
    {
        if ($this->tableExists($table)) {
            $sql = "DELETE FROM $table";
            if ($where != null) {
                $sql .= " WHERE $where";
            }
            if ($this->mysqli->query($sql)) {
                array_push($this->result, $this->mysqli->affected_rows);
                return true;
            } else {
                array_push($this->result, $this->mysqli->error);
            }
        } else {
            return false;
        }
    }
    
    // selectdata
public function selectData(
    $table,
    $columns = "*",
    $join = null,
    $where = null,
    $order = null,
    $limit = null
) {
    $sql = "SELECT $columns FROM $table";

    if ($join !== null) {
        $sql .= " $join";
    }

    if ($where !== null) {
        $sql .= " WHERE $where";
    }

    if ($order !== null) {
        $sql .= " ORDER BY $order";
    }

    if ($limit !== null) {
        $sql .= " LIMIT $limit";
    }

    // Execute the query
    $result = $this->mysqli->query($sql);

    if (!$result) {
        return "Query failed: " . $this->mysqli->error;
    }

    // Fetch and return the results as an associative array
    return $result->fetch_all(MYSQLI_ASSOC);
}

    //sql data
    public function sqlData($sql)
    {
        $query = $this->mysqli->query($sql);
        if ($query) {
            $this->result = $query->fetch_all(MYSQLI_ASSOC);
            return true;
        } else {
            array_push($this->result, $this->mysqli->error);
            return false;
        }
    }
    // table exists
    private function tableExists($table)
    {
        $sql = "SHOW TABLES FROM $this->db_name LIKE '$table'";
        $tableInDb = $this->mysqli->query($sql);
        if ($tableInDb) {
            if ($tableInDb->num_rows == 1) {
                return true;
            } else {
                array_push($this->result, $table . "does not ecits");
                return false;
            }
        }
    }
    //  insert mutiple data
    public function insertMutipleData($table, $params = [])
    {
        if ($this->tableExists($table)) {
            $table_columns = implode(",", array_keys($params));
            $table_value = implode("','", $params);
            $sql = "INSERT INTO $table ($table_columns) VALUES ('$table_value')";

            if ($this->mysqli->query($sql)) {
                $lastInsertedId = $this->mysqli->insert_id;
                return $lastInsertedId;
            } else {
                $error_message =
                    "Error executing query: " . $this->mysqli->error;
                error_log($error_message);
                array_push($this->result, $error_message);
                return false;
            }
        } else {
            return false;
        }
    }
    
  
    public function getProduct()
    {
        $query = 'SELECT p.product_id, p.product_title, p.product_quantity, p.product_price, p.status, c.category_id, c.category_name
                 FROM products p LEFT JOIN categories c ON p.category_id = c.category_id';

        $result = $this->mysqli->query($query);

        if (!$result) {
            die("Query failed: " . $this->mysqli->error);
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getResult()
    {
        return $this->result;
    }
    public function __destruct()
    {
        if ($this->conn) {
            if ($this->mysqli->close()) {
                $this->conn = false;
                return true;
            } else {
                return false;
            }
        }
    }

}
