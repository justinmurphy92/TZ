<?php
/**
 * Created by PhpStorm.
 * User: justinmurphy
 * Date: 3/10/2014
 * Time: 7:19 PM
 */

define("DB", "DB ERROR");
define("UNDEFINED", "MISC ERROR");

function writeLog($errorClass, $error){
    $FILENAME = 'tzLog.txt';
    $date = new DateTime();
    $timestamp = $date->getTimestamp();
    switch($errorClass)
    {
        case 'DB':
            $errorClass = DB;
            break;
        default:
            $errorClass = UNDEFINED;
            break;
    }

    $writeQueue = $errorClass . " -> " . $timestamp . ": " . $error . "\n";
    file_put_contents($FILENAME, $writeQueue, FILE_APPEND);
}

function connectToDB() {
    try{
        $name = 'TutleZone';
        $pass ='Passw0rd!';
        $DBcon = new PDO('mysql:host=TutleZone.db.11939703.hostedresource.com;dbname=TutleZone',$name, $pass);
    }
    catch (PDOException $e){
        echo '<script>alert("'.$e.'");</script>';
        $error =$e->getMessage();
        writelog('DB', $error);
        return false;
    }
    return $DBcon;
}




