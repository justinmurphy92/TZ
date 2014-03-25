<?php
/**
 * Programmer:  Adam Howatt
 * Analyst:     Justin Murphy
 *      DATE        INITIALS        CHANGES
 *      03/12/2014  AH              INITAL CREATION
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
            if (empty($_POST['lessonID']) || empty($_POST['subjectID']) || empty($_POST['matchID']) || empty($_POST['date']) || empty($_POST['length']) || empty($_POST['title'])){
                echo "missing";
                exit;
            }
            else{
                // make sure the user is actually associated to the match (prevent unauthorized updates)
                $authSql = "SELECT student_userid, tutor_userid FROM matches WHERE match_id=:matchID";
                $authQuery = $db->prepare($authSql);
                $authQuery->bindValue(':matchID', $_POST['matchID']);

                // we'll need the student ID later on, creating a variable here so it has appropriate scope.
                $studentID;

                if ($authQuery->execute()) {
                    $row = $authQuery->fetch(PDO::FETCH_ASSOC);
                    if($_SESSION['USERID'] != $row['student_userid'] && $_SESSION['USERID'] != $row['tutor_userid']){
                        echo "unauthorized";
                        exit;
                    }
                    $studentID = $row['student_userid'];
                }

                // if we got here, the user is authorized, so let's update the lesson
                $updateSQL = "UPDATE lesson SET lesson_title=:title, subject_id=:subject, lesson_date=unix_timestamp(:date), lesson_length=:length, lesson_location=:location, statuscode_id = :status, lesson_comments=:comments, lesson_desc=:desc WHERE lesson_id=:lessonID AND match_id=:matchID";
                $updateQuery = $db->prepare($updateSQL);
                $updateQuery->bindValue(':title', $_POST['title']);
                $updateQuery->bindValue(':subject', $_POST['subjectID']);
                $updateQuery->bindValue(':date', $_POST['date']);
                $updateQuery->bindValue(':length', $_POST['length']);
                $updateQuery->bindValue(':location', $_POST['location']);
                $updateQuery->bindValue(':status', $_POST['status']);
                $updateQuery->bindValue(':comments', $_POST['comments']);
                $updateQuery->bindValue(':desc', $_POST['desc']);
                $updateQuery->bindValue(':lessonID', $_POST['lessonID']);
                $updateQuery->bindValue(':matchID', $_POST['matchID']);

                // if it executes successfully
                if($updateQuery->execute()){

                    // since it was successfully updated, let's create a notification, alerting the student of the updated lesson.
                    $date = DateTime::createFromFormat("Y-m-d H:i", $_POST['date']);
                    $content = "LESSON UPDATED: Tutor: " . $_SESSION['FNAME'] . " " . $_SESSION['LNAME'] . ". Lesson Date: " . $date->format('D, M jS @ g:ia');
                    insertNotification($studentID, $content);
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
