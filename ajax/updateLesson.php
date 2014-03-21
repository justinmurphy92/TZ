<?php
/**
 * Created by PhpStorm.
 * User: Howatt
 * Date: 12/03/14
 * Time: 6:06 PM
 */
session_start();
include('../functions/database.php');

// make sure the user is logged in, and a post was submitted.
if (isset($_SESSION['USERID']) && isset($_POST['lessonID'])){
    $db = connectToDB();
    if ($db)
    {
        try{
            // make sure no required fields are null.
            if (empty($_POST['lessonID']) || empty($_POST['matchID']) || empty($_POST['date']) || empty($_POST['length']) || empty($_POST['title'])){
                echo "missing";
                exit;
            }
            else{
                // make sure the user is actually associated to the match (prevent unauthorized updates)
                $authSql = "SELECT student_userid, tutor_userid FROM matches WHERE match_id=:matchID";
                $authQuery = $db->prepare($authSql);
                $authQuery->bindValue(':matchID', $_POST['matchID']);

                if ($authQuery->execute()) {
                    $row = $authQuery->fetch(PDO::FETCH_ASSOC);
                    if($_SESSION['USERID'] != $row['student_userid'] && $_SESSION['USERID'] != $row['tutor_userid']){
                        echo "unauthorized";
                        exit;
                    }
                }

                // if we got here, the user is authorized, so let's update the lesson
                $updateSQL = "UPDATE lesson SET lesson_title=:title, lesson_date=unix_timestamp(:date), lesson_length=:length, lesson_location=:location, lesson_comments=:comments, lesson_desc=:desc WHERE lesson_id=:lessonID AND match_id=:matchID";
                $updateQuery = $db->prepare($updateSQL);
                $updateQuery->bindValue(':title', $_POST['title']);
                $updateQuery->bindValue(':date', $_POST['date']);
                $updateQuery->bindValue(':length', $_POST['length']);
                $updateQuery->bindValue(':location', $_POST['location']);
                $updateQuery->bindValue(':comments', $_POST['comments']);
                $updateQuery->bindValue(':desc', $_POST['desc']);
                $updateQuery->bindValue(':lessonID', $_POST['lessonID']);
                $updateQuery->bindValue(':matchID', $_POST['matchID']);

                // if it executes successfully
                if($updateQuery->execute()){
                    echo "success";
                    exit;
                }
            }

        }
        // echo specific string for any caught exceptions.
        catch(Exception $e){
            echo "unexpected error";
            exit;
        }
    }
}
// if it caught here, display a general failure error.
echo 'failure';
