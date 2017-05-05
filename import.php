<?php

try{

    system('php composer.phar install 2>&1');

    /**
     * Load all the classes for that working successfully
     */

    require __DIR__.'/vendor/autoload.php';

    /**
     * Class that execute process of read, transform and save in database
     */

    require __DIR__.'/app/Console/Import.php';

    $import = new App\Console\Import;
    $import->execute();

}catch (Exception $e)
{
    print_r($e->getMessage());
}