<?php

namespace App\Console;

use App\Controllers\TimeController;
use App\Controllers\CsvController;

Class Import
{
    private $time;
    private $csv;
    private $file;

    /**
     * Import constructor.
     */
    public function __construct()
    {
        $this->time = new TimeController;
        $this->csv = new CsvController;
        $this->file = "files/users.csv";
    }

    /**
     * Execute the read, transform and save in sqlite database
     */
    public function execute()
    {
        $this->time->setTimeStart();
        if($this->csv->openCSV($this->file)){
            $this->csv->readCSV();
            $this->csv->saveInDB();
        }
        $this->csv->showDB();
        $this->time->setTimeEnd();
        $this->time->calculateTime();
    }
}
