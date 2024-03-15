<?php

class allup
{
    private $host = 'sql.freedb.tech';
    private $dbname = 'freedb_cafeteria';
    private $user = 'freedb_cafeteria_admin';
    private $password = 'ke4$FA*d4xgqhG3';
    private $connection;

    function __construct()
    {
        $this->connection = new PDO("mysql:host=$this->host;dbname=$this->dbname;", $this->user, $this->password);
    }

    function getConnection()
    {
        return $this->connection;
    }



    public function select1($sql, $params = [])
    {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle the exception (e.g., log error, display error message)
            echo "Error executing query: " . $e->getMessage();
            // You might want to throw the exception again for the caller to handle
            throw $e;
        }
    }

    // public function insert1($TbName, array $values)
    // {
    //     $keys = array_keys($values);
    //     $keys = implode(',', $keys);
    //     $value = array_values($values);
    //     $value = "'" . implode("','", $value) . "'";
    //     $array = [];
    //     for ($i = 0; $i < count($values); $i++) {
    //         $array[$i] = "?";
    //     }
    //     $marks = implode(",", $array);
    //     $sql = "INSERT INTO {$TbName} ({$keys}) VALUES ({$marks})";
    //     $stmt = $this->connection->prepare($sql);
    //     $stmt->execute(array_values($values));

    //     // Return the last inserted ID
    //     return $this->connection->lastInsertId();
    // }



    public function exists($table, $conditions, $excludeId = null)
    {
        $query = "SELECT COUNT(*) FROM $table WHERE ";
        $keys = array_keys($conditions);

        // Exclude ID condition if provided
        if ($excludeId !== null) {
            $conditions["id[!]"] = $excludeId;
        }

        foreach ($keys as $key) {
            $query .= "$key = :$key AND ";
        }
        // Remove the last "AND" from the query
        $query = rtrim($query, "AND ");

        $stmt = $this->connection->prepare($query);
        $stmt->execute($conditions);
        $count = $stmt->fetchColumn();

        return $count > 0;
    }

}
