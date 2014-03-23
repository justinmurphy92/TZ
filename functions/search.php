<?php
/**
 * Created by PhpStorm.
 * User: justinmurphy
 * Date: 3/20/2014
 * Time: 8:19 PM
 */
session_start();
include('../functions/database.php');

    $resultArray = array();
    $db = connectToDB();
    try{
        $studentSQL = "SELECT * FROM student WHERE MATCH (student_fname, student_lname, student_city, student_postal, student_email) AGAINST (:term)";
        $query = $db->prepare($studentSQL);
        $query->bindValue(':term', $_POST['srch-term']);
        if($query->execute()){
            while($row =  $query->fetch(PDO::FETCH_ASSOC)){
                $resultArray[]= array('id'=> $row['credentials_userid'],
                    'fname'=> $row['student_fname'],
                    'lname'=> $row['student_lname'],
                    'city'=>  $row['student_city'],
                    'postal'=>$row['student_postal'],
                    'email'=> $row['student_email']);
            }
        }
    }
    catch(PDOException $e){
        writeLog('DB', $e);
    }

    try{
        $tutorSQL = "SELECT * FROM student WHERE MATCH (tutor_fname, tutor_lname, tutor_city, tutor_postal, tutor_email) AGAINST (:term)";
        $query = $db->prepare($tutorSQL);
        $query->bindValue(':term', $_POST['srch-term']);

        if($query->execute()){
            while($row =  $query->fetch(PDO::FETCH_ASSOC)){
                $resultArray[]= array('id'=> $row['credentials_userid'],
                    'fname'=> $row['student_fname'],
                    'lname'=> $row['student_lname'],
                    'city'=>  $row['student_city'],
                    'postal'=>$row['student_postal'],
                    'email'=> $row['student_email']);
            }
        }
    }
    catch (PDOException $e){
        writeLog('DB', $e);
    }
$_SESSION['results'] = $resultArray;

header('Location: ../searchResults.php');


