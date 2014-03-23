<?php
/**
 * Created by PhpStorm.
 * User: Howatt
 * Date: 12/03/14
 * Time: 6:06 PM
 */
session_start();
include('../functions/database.php');
date_default_timezone_set('America/Halifax');
header('Content-type: application/json'); // we'll be returning JSON to be interpreted from inline javascript
if (isset($_SESSION['USERID'])){
    $db = connectToDB();
    if ($db)
    {
        try{
            // get the matches for the user first
            $matchSQL = "";
            if ($_SESSION['TYPECODE_ID'] == 1) {
                //student
                $matchSQL = "SELECT * FROM matches WHERE student_userid = :userid";
            }
            elseif($_SESSION['TYPECODE_ID'] == 2) {
                // tutor
                $matchSQL = "SELECT * FROM matches WHERE tutor_userid = :userid";
            }

            $matchQuery = "";
            if ($matchSQL != "") {
                $matchQuery = $db->prepare($matchSQL);
                $matchQuery->bindValue(":userid", $_SESSION['USERID']);
            }

            if ($matchQuery->execute()){
                $jsondata = array();
                $date = new DateTime();
                $date->setTimeZone(new DateTimeZone('US/Eastern'));
                // for each match, get all the lessons.
                while ($row = $matchQuery->fetch(PDO::FETCH_ASSOC)) {
                    $lessonSQL = "SELECT * FROM lesson WHERE match_id = :matchid AND (lesson_date BETWEEN :start AND :end)";
                    $lessonQuery = $db->prepare($lessonSQL);
                    $lessonQuery->bindValue(":matchid", $row['match_id']);
                    $lessonQuery->bindValue(":start", $_GET['start']);
                    $lessonQuery->bindValue(":end", $_GET['end']);
                    if ($lessonQuery->execute()){
                        while ($lessonRow = $lessonQuery->fetch(PDO::FETCH_ASSOC)){
                            $endTime = $lessonRow['lesson_date'] + ($lessonRow['lesson_length'] * 60);
                            $jsondata[] = array('id'=>$lessonRow['lesson_id'],
                                                'title'=>$lessonRow['lesson_title'],
                                                'subject'=>$lessonRow['subject_id'],
                                                'allDay'=> false,
                                                'color'=>$row['match_colour'],
                                                'start'=>$lessonRow['lesson_date'] + $date->getOffset(),
                                                'lessonLength'=>$lessonRow['lesson_length'],
                                                'lessonLocation'=>$lessonRow['lesson_location'],
                                                'unixTime'=>$lessonRow['lesson_date'],
                                                'matchID'=>$lessonRow['match_id'],
                                                'end'=>$endTime + $date->getOffset(),
                                                'lessonStatus'=>$lessonRow['statuscode_id'],
                                                'lessonDesc'=>$lessonRow['lesson_desc'],
                                                'lessonComments'=>$lessonRow['lesson_comments']);
                        }
                    }
                }
                // echo the data back, json encoded.
                echo json_encode($jsondata);
                exit;
            }
            var_dump($matchQuery->errorInfo());

        }catch(PDOException $e){
            writeLog('DB', $e);
            echo $e->getMessage();
        }
    }

}
echo 0;
