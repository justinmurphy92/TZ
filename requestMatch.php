<?php
/**
 * Created by PhpStorm.
 * User: justinmurphy
 * Date: 3/23/2014
 * Time: 6:06 PM
 */
session_start();
include('functions/database.php');

$db = connectToDB();

$content = $_SESSION['FNAME']." ".$_SESSION['LNAME']." has asked to make a match with you! <a href='acceptMatch.php?user=".$_SESSION['USERID']."'>Click Here</a> to accept!";

if(isset($_GET['user']) && isset($_SESSION['USERID'])){
    $sql = "INSERT INTO matches (match_colour, student_userid, tutor_userid, match_rop, matches_type) VALUES (:colour, :student, :tutor, :rop, :match_type)";
    $query = $db->prepare($sql);


    if ($_SESSION['TYPECODE_ID'] == '1' || $_SESSION['TYPECODE_ID'] == 1){
        $query->bindValue(':student', $_SESSION['USERID']);
        $query->bindValue(':tutor', $_GET['user']);
        $userType = '2';

    }
    elseif($_SESSION['TYPECODE_ID'] == '2' || $_SESSION['TYPECODE_ID'] == 2){
        $query->bindValue(':student', $_GET['user']);
        $query->bindValue(':tutor', $_SESSION['USERID']);
        $userType = '1';
    }
    $query->bindValue(':colour', 'Blue');
    $query->bindValue(':rop', '20');
    $query->bindValue(':match_type', '0');
    try{
        if($query->execute()){
            insertNotification($_GET['user'], $content);
            $url = "Location: viewProfile.php?userid=".$_GET['user']."&type=".$userType;
            header($url);
        }
    }
    catch (PDOException $e){
        writeLog('DB', $e);
    }
}