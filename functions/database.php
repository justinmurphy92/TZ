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
        $DBcon = new PDO('mysql:host=127.0.0.1;dbname=tutlezone', 'root', '');

    }
    catch (PDOException $e){
        $date = new DateTime();
        $writeQueue = null;
        $error =$e->getMessage();

        $timestamp = $date->getTimestamp();

        $writeQueue = "DB_ERROR ->" . $timestamp . ': '. $error . '\n';

        writelog($writeQueue);
        return false;
    }
    return $DBcon;
}


