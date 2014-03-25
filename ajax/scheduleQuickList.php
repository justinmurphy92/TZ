<?php
/**
 * Programmer:      Adam Howatt
 * Analyst:         Justin Murphy
 *      DATE        INITIALS        CHANGES
 *      03/12/2014  AH              INITIAL CREATION
 *      03/13/2014  AH              FIXED JSON ERRORS
 *
 * Used to return a list of the user's lessons over the next 24 hours.
 */
session_start();
include('../functions/database.php');
include('../functions/codeTables.php');
header('Content-type: application/json'); // we'll be returning JSON to be interpreted from inline javascript

// determine the start and end times (for the 24 hours)
// stored in database as a unix timestamp, so have to use some magic to get these numbers accurately.
$date = new DateTime();
$date->setTimeZone(new DateTimeZone('US/Eastern'));
$startTime = time() - $date->getOffset();
$endTime = $startTime + (24*60*60);
$jsondata = array();


if (isset($_SESSION['USERID'])){
    $db = connectToDB();
    if ($db && loadMatches())
    {
        try{
            // get the count first
            // we'll have to loop through each of the matches associated with the user
            $sql = "SELECT * FROM lesson WHERE match_id = :matchID AND (lesson_date BETWEEN " . $startTime . " AND " . $endTime . ") ORDER BY lesson_date desc";
            $query = $db->prepare($sql);

            foreach($_SESSION['matches'] as $thisMatch){
                $matchID = $thisMatch['match_id'];
                $query->bindValue(":matchID", $matchID);
                if ($query->execute()) {
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        $t = $row['lesson_date'] - 28800;
                        $formattedDate = date('D, M jS @ g:ia', $t);

                        $jsondata[] = array('id'=>$row['lesson_id'],
                                'title'=>$row['lesson_title'],
                                'location'=>$row['lesson_location'],
                                'date'=>$formattedDate,
                                'party'=>$thisMatch['fname'] . ' ' . $thisMatch['lname']);
                    }
                }

            }


        }catch(PDOException $e){
            writeLog('DB', $e);
        }
    }

}

if (count($jsondata) > 0) {
    echo json_encode($jsondata);
    exit;
}
echo 0;
