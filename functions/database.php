<?php
/**
 * Programmer:  Justin Murphy
 * Analyst:     Adam Howatt
 *      DATE        INITIALS        CHANGES
 *      03/10/2014  JM              INITIAL CREATION
 *      03/11/2014  JM              ADDED ERROR LOGIN
 *      03/12/2014  AH              ADDED INSERT NOTIFICATION
 *      03/14/2014  AH              ADDED UNDEFINED ERROR
 *      03/14/2014  JM              ADDED IMG ERROR
 *      03/24/2014  JM              ADDED CREATE TRANSACTION
 *      03/24/2014  AH              ADDED NEWEST MEMBER
 *      03/24/2014  JM              CHANGED TRANSACTION METHOD ID TO 4
 *
 * DESCRIPTION:
 * THIS CLASS HOLDS COMMON DATABASE FUNCTION TO BE CALLED BY OTHER PAGES
 */

//define the types of error
define("DB", "DB ERROR");
define("UNDEFINED", "MISC ERROR");
define("IMG", "IMAGE UPLOAD ERROR");

function writeLog($errorClass, $e){
    //file path to the log
    $FILENAME = 'tzLog.txt';
    //set a proper time stamp
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
    //write error to log
    $error = $e->getFile()." ". $e->getLine(). "\n MESSAGE: ". $e->getMessage() ."\n";
    $writeQueue = "************************************************ \n". $errorClass . " -> " . $timestamp . ":\n". $error;
    file_put_contents($FILENAME, $writeQueue, FILE_APPEND);

}

// used to connect to the DB And return the connection string
function connectToDB() {
    try{
        $name = 'tutleZ0N3b0t';
        $pass ='0kj531G@81jd01951mma2';
        $DBcon = new PDO('mysql:host=localhost;dbname=TutleZone',$name, $pass);
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
//used to create a transaction in the transaction table
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
            $sql = "INSERT INTO transactions (match_id, transaction_amount, transaction_date, method_id) VALUE (:matchID, :amount, :tranDate, :methodID)";
            $query = $db->prepare($sql);
            $query->bindValue(':matchID', $match);
            $query->bindValue(':amount', $lessonTotal);
            $query->bindValue(':tranDate', $date);
            $query->bindValue(':methodID', 4);

            $query->execute();

            return $db->lastInsertId();

        }
        catch (PDOException $e){
            writeLog('DB', $e);
        }
    }



}

//used to generate the newest members display on the footer
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




