<?php
/**
 * Created by PhpStorm.
 * User: justinmurphy
 * Date: 3/23/2014
 * Time: 7:32 PM
 */
session_start();
include('functions/database.php');

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

$sql = "SELECT * FROM matches WHERE student_userid = :student AND tutor_userid = :tutor";
$query = $db->prepare($sql);

$query->bindValue(':student', $student);
$query->bindValue(':tutor', $tutor);

try{
    if($query->execute()){
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $updateID = $row['match_id'];

        $sql = "UPDATE matches SET matches_type = 1 WHERE match_id = :matchid";
        $query = $db->prepare($sql);

        $query->bindValue(':matchid', $updateID);
        try{
            if($query->execute()){
                header('Location: notifications.php');
            }
            else{
                echo "oh hi";
            }
        }
        catch (PDOException $e){
            writeLog('DB', $e);
        }
    }
}
catch (PDOException $e){
    writeLog('DB', $e);
}