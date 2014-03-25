<?php
/**
 * Programmer:  Justin Murphy
 * Analyst:     Adam Howatt
 *      DATE        INITIALS        CHANGES
 *      03/18/2014  JM              INITIAL CREATION
 *      03/19/2014  JM              ADDED REDIRECT TO SEARCH RESULTS
 *
 * DESCRIPTION:
 * THIS CLASS WILL TAKE THE DATA PASSED FROM THE SEARCH BAR AND QUERY BOTH STUDENT AND TUTOR DATA.
 * IT WILL THEN PASS THE MATCHES TO THE SEARCH RESULTS PAGE FOR FURTHUR PROCESSING
 */
session_start();
include('../functions/database.php');

    $resultArray = array();
    $db = connectToDB();
    try{
        $studentSQL = "SELECT * FROM student WHERE MATCH (student_fname, student_lname, student_city, student_postal, student_email, student_about) AGAINST (:term)";
        $query = $db->prepare($studentSQL);
        $query->bindValue(':term', $_POST['srch-term']);
        if($query->execute()){
            while($row =  $query->fetch(PDO::FETCH_ASSOC)){
                $resultArray[]= array('id'=> $row['credentials_userid'],
                    'fname'=> $row['student_fname'],
                    'lname'=> $row['student_lname'],
                    'city'=>  $row['student_city'],
                    'postal'=>$row['student_postal'],
                    'email'=> $row['student_email'],
                    'about'=> $row['student_about'],
                    'type'=>  1);
            }
        }
    }
    catch(PDOException $e){
        writeLog('DB', $e);
    }

    try{
        $tutorSQL = "SELECT * FROM tutor WHERE MATCH (tutor_fname, tutor_lname, tutor_city, tutor_postal, tutor_email, tutor_company, tutor_bio) AGAINST (:term)";
        $query = $db->prepare($tutorSQL);
        $query->bindValue(':term', $_POST['srch-term']);

        if($query->execute()){
            while($row =  $query->fetch(PDO::FETCH_ASSOC)){
                $resultArray[]= array('id'=> $row['credentials_userid'],
                    'fname'=> $row['tutor_fname'],
                    'lname'=> $row['tutor_lname'],
                    'city'=>  $row['tutor_city'],
                    'postal'=>$row['tutor_postal'],
                    'email'=> $row['tutor_email'],
                    'about'=> $row['tutor_bio'],
                    'type'=>  2);
            }
        }
    }
    catch (PDOException $e){
        writeLog('DB', $e);
    }
$_SESSION['results'] = $resultArray;

header('Location: ../searchResults.php');


