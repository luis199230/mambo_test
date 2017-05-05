<?php

namespace App\Models;

use App\Database\DB;

Class Model{

    protected $db;
    protected $table;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->db = (new DB)->getConnection();
    }

    /**
     * @return mixed
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @return \PDO
     */
    public function getDB()
    {
        return $this->db;
    }

    /**
     * @param array $fields
     * @param array $values
     */
    public static function insert($fields = [], $values = [])
    {
        $model =  new static();
        $fieldsStr = implode(", ",$fields);
        $bindFields = array_map(function($field){ return ":".$field; },$fields);
        $size = count($values);

        $query = "INSERT INTO ".$model->getTable()." (".$fieldsStr.") ";
        foreach ($values as $i => $params){
            if($i==0) $query .= "VALUES";
            $query .= "(".implode(",", array_map(function($field){ return "?"; },$fields)).")";
            if($i+1 != $size) $query .= ", ";
            elseif($i+1 == $size) $query .= ";";
        }

        $result = $model->getDB()->prepare($query);

        $bindParams = [];
        foreach($values as $params){
            foreach ($bindFields as $i => $bindField) {
                $bindParams[] = $params[$i];
            }
        }
        $result->execute($bindParams);
    }

    /**
     * @return array
     */
    public static function all()
    {
        $rows = [];
        $model =  new static();
        $result = $model->getDB()->query('SELECT * FROM '.$model->getTable());
        foreach($result as $row){
            array_push($rows, $row);
        }
        return $rows;
    }
}
