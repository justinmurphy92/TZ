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

function createTransaction($match, $length, $date){
    $db = connectToDB();

    if($db){
        try{
            $sql = "SELECT * FROM matches WHERE match_id = :matchid";
            $query = $db->prepare($sql);
            $query->bindValue(':matchid', $match);

            $query->execute();
            $row = $query->fetch(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e){
            writeLog('DB', $e);
        }
        $lessonTotal = $length * $row['match_rop'];

        try{
            $sql = "INSERT INTO transaction(match_id, transaction_amount, transaction_date, method_id) VALUE (:matchID, :amount, :tranDate)";
            $query = $db->prepare($sql);
            $query->bindValue(':matchID', $match);
            $query->bindValue(':amount', $lessonTotal);
            $query->bindValue(':tranDate', $date);
        }
        catch (PDOException $e){
            writeLog('DB', $e);
        }
    }



}

function newestMembers() {
    $db = connectToDB();

    if($db){
        try{
            $sql = " SELECT credentials.CREDENTIALS_USERID as 'userid', CREDENTIALS_USERNAME as 'username', TYPECODE_ID as 'type', COALESCE( tutor_fname, student_fname ) AS 'fname', COALESCE( tutor_lname, student_lname ) AS 'lname'
                     FROM credentials
                     LEFT JOIN student ON credentials.credentials_userid = student.credentials_userid
                     LEFT JOIN tutor ON credentials.credentials_userid = tutor.credentials_userid
                     ORDER BY credentials_create_date DESC
                     LIMIT 5 ";
            $query = $db->prepare($sql);
            $query->execute();
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
               echo "<li><a href='viewProfile.php?userid=" . $row['userid'] . "&type=" . $row['type'] . "'> " . $row['fname'] . " " . $row['lname'] . " </a></li>";
            }

        }
        catch (PDOException $e){
            writeLog('DB', $e);
        }

    }
}




