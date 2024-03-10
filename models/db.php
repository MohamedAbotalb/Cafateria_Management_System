<?php

class DB
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

  public function selectAll($TbName, array $cond = [], array $values = [])
  {
    if (count($cond) !== count($values)) {
      throw new InvalidArgumentException("Number of conditions must match the number of values.");
    }
    $conditions = [];
    foreach ($cond as $column) {
      $conditions[] = "$column = ?";
    }
    $whereClause = !empty($conditions) ? 'WHERE ' . implode(' AND ', $conditions) : '';

    $sql = "SELECT * FROM $TbName $whereClause";

    $stmt = $this->connection->prepare($sql);
    $stmt->execute($values);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
  }

  public function select($TbName, array $cond = [], array $values = [])
  {
    if (count($cond) !== count($values)) {
      throw new InvalidArgumentException("Number of conditions must match the number of values.");
    }
    $conditions = [];
    foreach ($cond as $column) {
      $conditions[] = "$column = ?";
    }
    $whereClause = !empty($conditions) ? 'WHERE ' . implode(' AND ', $conditions) : '';
    $sql = "SELECT * FROM $TbName $whereClause";
    $stmt = $this->connection->prepare($sql);
    $stmt->execute($values);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  public function insert($TbName, array $values)
  {
    $keys = array_keys($values);
    $keys = implode(',', $keys);
    $value = array_values($values);
    $value = "'" . implode("','", $value) . "'";
    $array = [];
    for ($i = 0; $i < count($values); $i++) {
      $array[$i] = "?";
    }
    $marks = implode(",", $array);
    $sql = "INSERT INTO {$TbName} ({$keys}) VALUES ({$marks})";
    $stmt = $this->connection->prepare($sql);
    $stmt = $stmt->execute(array_values($values));
  }

  public function delete($TbName, array $cond = [], array $values = [])
  {
    try {
      if (count($cond) !== count($values)) {
        throw new InvalidArgumentException("Number of conditions must match the number of values.");
      }

      $conditions = [];
      foreach ($cond as $column) {
        $conditions[] = "$column = ?";
      }

      $whereClause = !empty($conditions) ? 'WHERE ' . implode(' AND ', $conditions) : '';

      $sql = "DELETE FROM {$TbName} {$whereClause}";

      $stmt = $this->connection->prepare($sql);
      $stmt->execute($values);
    } catch (PDOException $e) {

      throw new Exception("Error in delete operation.", 0, $e);
    }
  }

  public function update($TbName, array $values, array $cond)
  {
    $cols = [];
    $params = [];

    foreach ($values as $key => $val) {
      $cols[] = "$key = ?";
      $params[] = $val;
    }

    $columns = implode(', ', $cols);

    $conditions = [];
    foreach ($cond as $key => $val) {
      $conditions[] = "$key = ?";
      $params[] = $val;
    }

    $condition = implode(" AND ", $conditions);

    $sql = "UPDATE {$TbName} SET {$columns} WHERE {$condition}";

    $stmt = $this->connection->prepare($sql);
    $stmt->execute($params);
  }
}
