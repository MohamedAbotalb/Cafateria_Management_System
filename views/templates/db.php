<?php
class Database {
    private $host="localhost";
    private $username="root";
    private $password="";
    private $dbname="emps";
    private $connection="";

    function __construct() {
        try {
            $this->connection = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    function getConnection() {
        return $this->connection;
    }

    function get_data($tableName, $condition=1){
        return $this->connection->query("select * from $tableName where $condition");
    }
    function insert_data($tableName,$tableCols, $vals){
        return $this->connection->query("insert into $tableName ($tableCols) values ($vals)");
    }
    function update_data($tableName, $values, $condition){
        return $this->connection->query("UPDATE $tableName SET $values WHERE $condition");
    }
    function delete_data($tableName, $condition){
        return $this->connection->query("delete from $tableName where $condition");
    }
}
?>