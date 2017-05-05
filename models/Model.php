<?php

namespace App/models;

Class Model{

  private $db;
  protected $table;

  public function __construct()
  {
    $this->db = require __DIR__.'/db.php';
  }

  public static function insert($fields = [], $values = [])
  {
    $fieldsStr = implode(",",$fields);
    $insert = "INSERT INTO {$this->table} ({$fieldsStr}) ";
    $insert .= "VALUES (:title, :message, :time)";
    $stmt = $this->db->prepare($insert);

    $bindParams = [];
    foreach ($fields as $k => $field) {
      $stmt->bindParam(":".$field, $bindParams[$k]);
    }

    foreach ($values as $i => $value) {
      $bindParams[$i] = $value;
      //$stmt->execute();
    }
  }
}
