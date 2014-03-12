<?php
/**
 * Created by PhpStorm.
 * User: justinmurphy
 * Date: 3/10/2014
 * Time: 7:19 PM
 */

define("DB", "DB ERROR");
define("UNDEFINED", "MISC ERROR");

function writeLog($errorClass, $e){
    $FILENAME = 'tzLog.txt';
    $timestamp = date('F dS Y h:i:s');
    switch($errorClass)
    {
        case 'DB':
            $errorClass = DB;
            break;
        default:
            $errorClass = UNDEFINED;
            break;
    }
    $error = $e->getFile()." ". $e->getLine(). "\n MESSAGE: ". $e->getMessage() ."\n";
    $writeQueue = "************************************************ \n". $errorClass . " -> " . $timestamp . ":\n". $error;
    file_put_contents($FILENAME, $writeQueue, FILE_APPEND);

    echo "<script>alert('".$writeQueue."')</script>";
}

function connectToDB() {
    try{
        $name = 'TutleZone';
        $pass ='Passw0rd!';
        $DBcon = new PDO('mysql:host=TutleZone.db.11939703.hostedresource.com;dbname=TutleZone',$name, $pass);
    }
    catch (PDOException $e){


        writeLog('DB', $e);
        return false;
    }
    return $DBcon;
}




