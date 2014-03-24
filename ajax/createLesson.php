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
if (isset($_SESSION['USERID']) && isset($_POST['lessonMatchID'])){
    $db = connectToDB();
    if ($db)
    {
        try{
            // make sure no required fields are null.
            if (empty($_POST['lessonMatchID']) || empty($_POST['lessonSubjectID']) || empty($_POST['lessonDate']) || empty($_POST['lessonLength']) || empty($_POST['lessonTitle'])){
                echo "missing";
                exit;
            }
            else{
                // make sure the user is actually associated to the match (prevent unauthorized updates)
                $authSql = "SELECT tutor_userid, student_userid FROM matches WHERE match_id=:matchID";
                $authQuery = $db->prepare($authSql);
                $authQuery->bindValue(':matchID', $_POST['lessonMatchID']);

                $studentID;

                if ($authQuery->execute()) {
                    $row = $authQuery->fetch(PDO::FETCH_ASSOC);
                    if($_SESSION['USERID'] != $row['tutor_userid']){
                        echo "unauthorized";
                        exit;
                    }

                    // store the student ID so we can create a notification if everything else goes well.
                    $studentID = $row['student_userid'];
                }

                $insertSQL = "INSERT INTO lesson(match_id, subject_id, lesson_date, lesson_length, lesson_title, lesson_desc, lesson_location, lesson_comments) VALUES(:matchID, :subjectID, unix_timestamp(:lessonDate), :length, :title, :desc, :location, :comments)";
                // if we got here, the user is authorized, so let's update the lesson
                $insertQuery = $db->prepare($insertSQL);
                $insertQuery->bindValue(':matchID', $_POST['lessonMatchID']);
                $insertQuery->bindValue(':subjectID', $_POST['lessonSubjectID']);
                $insertQuery->bindValue(':lessonDate', $_POST['lessonDate']);
                $insertQuery->bindValue(':length', $_POST['lessonLength']);
                $insertQuery->bindValue(':title', $_POST['lessonTitle']);
                $insertQuery->bindValue(':desc', $_POST['lessonDesc']);
                $insertQuery->bindValue(':location', $_POST['lessonLocation']);
                $insertQuery->bindValue(':comments', $_POST['lessonComments']);


                // if it executes successfully
                if($insertQuery->execute()){
                    // since it executed successfully, let's create a notification for the student.

                    // first we'll format the date
                    $date = DateTime::createFromFormat("Y-m-d H:i", $_POST['lessonDate']);

                    $content = "A lesson has been scheduled between you and " . $_SESSION['FNAME'] . " " . $_SESSION['LNAME'] . ". It is scheduled for: " . $date->format('D, M jS @ g:ia');
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
