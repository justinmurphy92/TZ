<?php
/**
 * Programmer:  Justin Murphy
 * Analyst:     Adam Howatt
 *      DATE        INITIALS        CHANGES
 *      03/22/2014  JM              INITIAL CREATION
 *
 * DESCRIPTION:
 * THIS FUNCTION IS CALLED WHEN A USER ACCEPTS A MATCH REQUEST. THIS FUNCTION CHANGE THE STATUS OF THE MATCH FROM 0 TO 1
 * MEANING THE MATCH IS NOW OFFICIAL AND NOT PENDING
 */

//start session and include needed classes
session_start();
include('functions/database.php');


//get database connection and declare variables
$db = connectToDB();
$student;
$tutor;
$updateID;


if ($_SESSION['TYPECODE_ID'] == '1' || $_SESSION['TYPECODE_ID'] == 1){
    $student = $_SESSION['USERID'];
    $tutor = $_GET['user'];
}
elseif($_SESSION['TYPECODE_ID'] == '2' || $_SESSION['TYPECODE_ID'] == 2){
    $student = $_GET['user'];
    $tutor = $_SESSION['USERID'];
}

//bind values to query
$sql = "SELECT * FROM matches WHERE student_userid = :student AND tutor_userid = :tutor";
$query = $db->prepare($sql);

$query->bindValue(':student', $student);
$query->bindValue(':tutor', $tutor);

try{
    if($query->execute()){
        //find the match that has both that tutor and that student
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $updateID = $row['match_id'];

        //set query to change the match type to 1
        $sql = "UPDATE matches SET matches_type = 1 WHERE match_id = :matchid";
        $query = $db->prepare($sql);

        $query->bindValue(':matchid', $updateID);
        try{
            if($query->execute()){
                //if everything works (which it will) redirect to notifications.php
                header('Location: notifications.php');
            }
        }
        catch (PDOException $e){
            //catch error and write to log
            writeLog('DB', $e);
        }
    }
}
catch (PDOException $e){
    //catch error and write to log
    writeLog('DB', $e);
}