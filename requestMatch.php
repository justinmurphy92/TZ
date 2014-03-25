<?php
/**
 * Programmer:  Justin Murphy
 * Analyst:     Adam Howatt
 *      DATE        INITIALS        CHANGES
 *      03/22/2014  JM              INITIAL CREATION
 *      03/23/2014  JM              FIXED RATE OF PAY (ROP)
 *      03/23/2014  JM              ADDED MATCH COLOUR
 *
 * DESCRIPTION:
 * THIS FUNCTION WILL SEND A NOTIFICATION TO ANOTHER USER TO INFORM THAT THAT USER 1 WHISHES TO CREATE
 * A MATCH WITH THEM
 *
 */

//start session and include database function
session_start();
include('functions/database.php');

//connect to database
$db = connectToDB();

//setup notification content
$content = $_SESSION['FNAME']." ".$_SESSION['LNAME']." has asked to make a match with you! <a href='acceptMatch.php?user=".$_SESSION['USERID']."'>Click Here</a> to accept!";

//if both user id's required to request the match are present, insert the notification to the database
if(isset($_GET['user']) && isset($_SESSION['USERID'])){
    $sql = "INSERT INTO matches (match_colour, student_userid, tutor_userid, match_rop, matches_type) VALUES (:colour, :student, :tutor, :rop, :match_type)";
    $query = $db->prepare($sql);

    //bind query
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
        //execute query
        if($query->execute()){
            insertNotification($_GET['user'], $content);
            $url = "Location: viewProfile.php?userid=".$_GET['user']."&type=".$userType;
            //redirect to view profile
            header($url);
        }
    }
    catch (PDOException $e){
        //catch exception and write to log
        writeLog('DB', $e);
    }
}