<?php
/**
 * Created by PhpStorm.
 * User: justinmurphy
 * Date: 3/10/2014
 * Time: 7:19 PM
 */
function writeLog($errorString){
    $FILENAME = '../tzLog.txt';
    file_put_contents(self::$FILENAME, $errorString, FILE_APPEND);
}

function connectToDB() {
    try{
        $DBcon = new PDO('mysql:host=127.0.0.1;dbname=tz', 'root', '');

    }
    catch (PDOException $e){
        $date = new DateTime();
        $writeQueue = null;
        $this->error =$e->getMessage();

        $timestamp = $date->getTimestamp();

        $writeQueue = "DB_ERROR ->" . $timestamp . ': '. $this->error . '\n';

        writelog($writeQueue);
        return false;
    }
    return $DBcon;
}


