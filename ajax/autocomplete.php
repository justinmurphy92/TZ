<?php
/**
 * Created by PhpStorm.
 * User: justinmurphy
 * Date: 3/18/2014
 * Time: 7:45 PM
 */

session_start();
include('../functions/database.php');

header('Content-type: application/json'); // we'll be returning JSON to be interpreted from inline javascript


$resultArray = array();

    $db = connectToDB();
    try{
            $studentSQL = "SELECT * FROM student WHERE student_fname LIKE (:term) OR student_lname LIKE (:term)";
            $query = $db->prepare($studentSQL);
            $query->bindValue(':term', '%'.trim(strip_tags($_GET['term'])).'%');
            if($query->execute()){
                while($row =  $query->fetch(PDO::FETCH_ASSOC)){
                    $resultArray[]= array('id'=> $row['credentials_userid'],
                                          'value'=> $row['student_fname']." ".$row['student_lname'],
                                          'label'=>  $row['student_fname']." ".$row['student_lname']);
                }
            }
        }
    catch(PDOException $e){
        writeLog('DB', $e);
    }

    try{
        $tutorSQL = "SELECT * FROM tutor WHERE tutor_fname LIKE (:term) OR tutor_lname LIKE (:term)";
        $query = $db->prepare($tutorSQL);
        $query->bindValue(':term', '%'.trim(strip_tags($_GET['term'])).'%');

        if($query->execute()){
            while($row =  $query->fetch(PDO::FETCH_ASSOC)){
                $resultArray[]= array('id'=> $row['credentials_userid'],
                    'value'=> $row['credentials_userid'],
                    'label'=>  $row['tutor_fname']);
            }
        }
    }
    catch (PDOException $e){
        writeLog('DB', $e);
    }

echo json_encode($resultArray);

