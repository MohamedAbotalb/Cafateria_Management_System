<?php

class DB {
  private $host = 'sql.freedb.tech';
  private $dbname = 'freedb_cafateria';
  private $user = 'freedb_cafateria_admin';
  private $password = 'Kk7Yhs#?Xt?*Kc*';
  private $connection;

  function __construct() {
    $this->connection = new PDO("mysql:host=$this->host;dbname=$this->dbname;", $this->user, $this->password);
  }
  public function selectAll($TbName,$cond=1,$value=1){
    $query = "SELECT * FROM {$TbName} WHERE $cond=?";
    $stmt = $this->connection->prepare($query);
    $stmt->execute([$value]); 
    if($stmt->rowCount() > 0){
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }else{
    throw new Exception("not Found");
}
}
  public function select($TbName,$cond=1,$value=1){
    $query = "SELECT * FROM {$TbName} WHERE $cond = ?";
    $stmt = $this->connection->prepare($query);
    $stmt->execute([$value]);
    if($stmt->rowCount() > 0){
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }else{
        throw new Exception("not Found");
    }
}

  public function insert($TbName,array $values){
    $keys = array_keys($values);
    $keys = implode(',', $keys);
    $value = array_values($values);
    $value = "'".implode("','" , $value)."'";
    $array=[];
    for( $i=0 ; $i<count($values); $i++ ){
      $array[$i]="?";
    }
    $marks=implode(",", $array);
    $sql = "INSERT INTO {$TbName} ({$keys}) VALUES ({$marks})";
    $stmt = $this->connection->prepare($sql);
    $stmt = $stmt->execute(array_values($values));
  }
  public function Delete($TbName,$cond , $value) {
    try{
        $stmt = $this->connection->prepare("DELETE FROM {$TbName} WHERE {$cond} = (?)");
        $stmt->execute([$value]);
    }catch(Exception $e){
        throw new Exception("Table not found");
    }
  }


public function Update($TbName, array $values, array $cond) {
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

?>