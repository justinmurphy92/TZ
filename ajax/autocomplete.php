<?php
/**
 * Programmer:  Justin Murphy
 * Analyst:     Adam Howatt
 *
 *      DATE        INITIAL         CHANGE
 *      3/18/2014   JM              INITIAL CREATION
 *      3/19/2014   JM              ADDED TUTOR SEARCH
 *
 * DESCRIPTION:
 * THIS AJAX FUNCTION IS CALLED FROM THE SEARCH BAR AND QUERIES THE DATABASE FOR A QUICK SEARCH RESULTS TO HELP
 * THE USER SEARCH QUICKER.
 */

//start session and include need classes
session_start();
include('../functions/database.php');

//this header is needed to pass the JSON back to the search bar
header('Content-type: application/json');


$resultArray = array();

    //connect to the database
    $db = connectToDB();
    try{
            $studentSQL = "SELECT * FROM student WHERE student_fname LIKE (:term) OR student_lname LIKE (:term)";

            //prepare the query by binding the variable in the query to a value
            $query = $db->prepare($studentSQL);
            $query->bindValue(':term', '%'.trim(strip_tags($_GET['term'])).'%');
            if($query->execute()){
                while($row =  $query->fetch(PDO::FETCH_ASSOC)){
                    //write results to the array that will be passed back
                    $resultArray[]= array('id'=> $row['credentials_userid'],
                                          'value'=> $row['student_fname']." ".$row['student_lname'],
                                          'label'=>  $row['student_fname']." ".$row['student_lname']);
                }
            }
        }
    catch(PDOException $e){
        //catch exception and write to log
        writeLog('DB', $e);
    }

    try{
        $tutorSQL = "SELECT * FROM tutor WHERE tutor_fname LIKE (:term) OR tutor_lname LIKE (:term)";

        //prepare tutor query for binding
        $query = $db->prepare($tutorSQL);
        $query->bindValue(':term', '%'.trim(strip_tags($_GET['term'])).'%');

        if($query->execute()){
            while($row =  $query->fetch(PDO::FETCH_ASSOC)){
                //write results to array
                $resultArray[]= array('id'=> $row['credentials_userid'],
                    'value'=>  $row['tutor_fname']. " ". $row['tutor_lname'],
                    'label'=>  $row['tutor_fname']. " ". $row['tutor_lname']);
            }
        }
    }
    catch (PDOException $e){
        //catch errors and write to log
        writeLog('DB', $e);
    }
//pass the array back to the search bar in JSON
echo json_encode($resultArray);

