<?php

namespace App\Controllers;

use App\Models\User;
use Exception;

Class CsvController{

    private $file;
    private $mode;
    private $limiter;

    private $size;
    private $fields;
    private $values;

    /**
     * CsvController constructor.
     */
    public function __construct()
    {
        $this->mode = "r";
        $this->limiter = 1*(1024*1024);
        $this->size = 6;
        $this->fields = [];
        $this->values = [];
    }

    /**
     * @param $filePath
     * @return bool
     */
    public function openCSV($filePath)
    {
        try{
            if(!file_exists($filePath)){
                throw new Exception("El archivo no existe!");
            }
            if (!($this->file = fopen($filePath, $this->mode))){
                throw new Exception("El archivo no se pudo analizar!");
            }
            $response = true;
        }catch(Exception $e){
            print_r($e->getMessage());
            $response = false;
        }
        return $response;
    }

    /**
     * @param bool $process
     */
    public function readCSV($process = true)
    {
        $cont = 0;
        while (!feof($this->file)) {
            $line = fgets($this->file, $this->limiter);
            if($process){
                $this->processCSV($line, $cont);
            }
            $cont++;
        }
        fclose($this->file);
    }

    /**
     * @param $line
     * @param $cont
     */
    public function processCSV($line, $cont)
    {
        $array = preg_split("/[|-]+/", $line);
        if(count($array)==$this->size){
            if($cont==0){
                $this->fields = $array;
            }else{
                array_push($this->values, $array);
            }
        }
    }

    /**
     * Insert in database the data of csv file
     */
    public function saveInDB()
    {
        User::insert($this->fields, $this->values);
    }

    /**
     * Show all the rows of the users table
     */
    public function showDB()
    {
        print_r(User::all());
    }
}
