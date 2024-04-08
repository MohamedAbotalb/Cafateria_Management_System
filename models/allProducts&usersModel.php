<?php

class UsersandProducts
{
    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function select($sql, $params = [])
    {
        try {
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle the exception (e.g., log error, display error message)
            echo "Error executing query: " . $e->getMessage();
            // You might want to throw the exception again for the caller to handle
            throw $e;
        }
    }

    public function exists($table, $conditions)
    {
        $query = "SELECT COUNT(*) FROM $table WHERE ";
        $keys = array_keys($conditions);
        foreach ($keys as $key) {
            $query .= "$key = :$key AND ";
        }
        // Remove the last "AND" from the query
        $query = rtrim($query, "AND ");

        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->execute($conditions);
        $count = $stmt->fetchColumn();

        return $count > 0;
    }
}
