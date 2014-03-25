<?php
/**
 * Programmer:  Adam Howatt
 * Analyst:     Justin Murphy
 *      DATE        INITIALS        CHANGES
 *      03/12/2014  AH              INITIAL CREATION
 *
 * Used to cancel all lessons for a specific day.
 * Loops through all matches for a specific user, and checks to see if any of those matches have any lessons scheduled.
 * if so, change the status of said lessons to "Sick" & creates notifications for the other users.
 * Once done, this cannot be reversed automatically, the user must reschedule them.
 */
session_start();
include('../functions/database.php');
include('../functions/codeTables.php');
if (isset($_SESSION['USERID']) && loadMatches() && isset($_POST['sickConfirm'])){
    $db = connectToDB();
    if ($db)
    {
        try{
            // let's get the dates first.
            $beginOfDay = strtotime("midnight", time() - 14400);
            $endOfDay   = strtotime("tomorrow", $beginOfDay) - 1;

            $formattedStart = date('Y-m-d H:i', $beginOfDay);
            $formattedEnd = date('Y-m-d H:i', $endOfDay);

            // get the content entered by the user, if none entered, use a generic message.
            $content = $_SESSION['FNAME'] . " " . $_SESSION['LNAME'] . " has taken a sick day";
            if (!empty($_POST['sickMessage'])) {
                $content .= ":  " . $_POST['sickMessage'];
            }

            // generic update query, sets to status 8 which is "Sick"
            $sql = "UPDATE lesson set statuscode_id = 8 WHERE match_id = :matchID AND (lesson_date BETWEEN unix_timestamp(:startTime) AND unix_timestamp(:endTime))";
            $query = $db->prepare($sql);
            $query->bindValue(":startTime", $formattedStart);
            $query->bindValue(":endTime", $formattedEnd);

            // we'll collect a count of lessons as well, to provide contextual feedack to the user.
            $counter = 0;

            // perform the update for each match
            foreach($_SESSION['matches'] as $thisMatch){
                $query->bindValue(":matchID", $thisMatch['match_id']);

                // if the query was successful, and rows were affected, we'll create a notification for the other paty.
                if ($query->execute() && $query->rowCount() > 0) {
                    $counter += $query->rowCount();
                    insertNotification($thisMatch['match_userid'], $content);
                }
            }

            echo $counter;
            exit;
        }
        catch(Exception $e){
            echo "error";
            exit;
        }
    }
}
if (!isset($_POST['sickConfirm'])) {
    echo "missing";
    exit;
}
// general catch all - to be handled via javascript
echo 'failure';
