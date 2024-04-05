<?php

class DB
{
  private $host = 'sql.freedb.tech';
  private $dbname = 'freedb_cafeteria';
  private $user = 'freedb_cafeteria_admin';
  private $password = 'ke4$FA*d4xgqhG3';
  private static $connection;

  public function __construct()
  {
    if (!self::$connection) {
      self::$connection = new PDO("mysql:host=$this->host;dbname=$this->dbname;", $this->user, $this->password);
    }

  }

  public function getConnection()
  {
   
    return self::$connection;
  }

  public function select($tableName, array $conditions = [], array $values = [], $fetchOne = false)
  {
    if (count($conditions) !== count($values)) {
      throw new InvalidArgumentException("Number of conditions must match the number of values.");
    }

    $whereClause = '';
    if (!empty($conditions)) {
      $whereClause = 'WHERE ' . implode(' = ? AND ', $conditions) . ' = ?';
    }

    $sql = "SELECT * FROM $tableName $whereClause";
    $stmt = $this->connection->prepare($sql);
    $stmt->execute($values);

    $result = $fetchOne ? $stmt->fetch(PDO::FETCH_ASSOC) : $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
  }

  public function insert($tableName, array $values)
  {
    $columns = implode(',', array_keys($values));
    $placeholders = implode(',', array_fill(0, count($values), '?'));

    $sql = "INSERT INTO $tableName ($columns) VALUES ($placeholders)";
    $stmt = $this->connection->prepare($sql);
    $stmt->execute(array_values($values));
  }

  public function update($tableName, array $conditions, array $values)
  {
    $setClause = implode(' = ?, ', array_keys($values)) . ' = ?';
    $whereClause = implode(' = ? AND ', array_keys($conditions)) . ' = ?';

    $sql = "UPDATE $tableName SET $setClause WHERE $whereClause";
    $stmt = $this->connection->prepare($sql);
    $stmt->execute(array_merge(array_values($values), array_values($conditions)));
  }

  public function delete($tableName, array $conditions = [], array $values = [])
  {
    if (count($conditions) !== count($values)) {
      throw new InvalidArgumentException("Number of conditions must match the number of values.");
    }

    $whereClause = '';
    if (!empty($conditions)) {
      $whereClause = 'WHERE ' . implode(' = ? AND ', $conditions) . ' = ?';
    }

    $sql = "DELETE FROM $tableName $whereClause";
    $stmt = $this->connection->prepare($sql);
    $stmt->execute($values);
  }
}
