<?php
/**
 * Created by PhpStorm.
 * User: justinmurphy
 * Date: 3/10/2014
 * Time: 7:19 PM
 */

define("DB", "DB ERROR");
define("UNDEFINED", "MISC ERROR");
define("IMG", "IMAGE UPLOAD ERROR");

function writeLog($errorClass, $e){
    $FILENAME = 'tzLog.txt';
    $timestamp = date('F dS Y h:i:s');
    switch($errorClass)
    {
        case 'DB':
            $errorClass = DB;
            break;
        case 'IMG':
            $errorClass = IMG;
        default:
            $errorClass = UNDEFINED;
            break;
    }
    $error = $e->getFile()." ". $e->getLine(). "\n MESSAGE: ". $e->getMessage() ."\n";
    $writeQueue = "************************************************ \n". $errorClass . " -> " . $timestamp . ":\n". $error;
    file_put_contents($FILENAME, $writeQueue, FILE_APPEND);

    echo "<script>alert('".$writeQueue."')</script>";
}

// used to connect to the DB And return the connection string
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

// used to insert standard notifications into the database.
// currently used, for instance, when a new lesson is added or a lesson is modified.
function insertNotification($userID, $content){
    $db = connectToDB();
    if ($db)
    {
        try{
            //try the update
            $sql = "INSERT INTO notification(credentials_userid, notification_content) VALUES(:userID, :content)";
            $query = $db->prepare($sql);
            $query->bindValue(':userID', $userID);
            $query->bindValue(':content', $content);
            $query->execute();
        }
        catch(Exception $e){
            writeLog("DB", $e);
        }
    }

}




