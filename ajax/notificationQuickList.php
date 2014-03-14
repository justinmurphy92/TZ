<?php
/**
 * Created by PhpStorm.
 * User: Howatt
 * Date: 12/03/14
 * Time: 6:06 PM
 */
session_start();
include('../functions/database.php');
header('Content-type: application/json'); // we'll be returning JSON to be interpreted from inline javascript
if (isset($_SESSION['USERID'])){
    $db = connectToDB();
    if ($db)
    {
        try{
            // get the count first
            $countSQL = "SELECT COUNT(*) as 'count' FROM notification WHERE credentials_userid = :userID AND notification_read = false";
            $countQuery = $db->prepare($countSQL);
            $countQuery->bindValue(':userID', $_SESSION['USERID']);
            if ($countQuery->execute()){
                // if the query was successful, store the result.
                $count = $countQuery->fetch(PDO::FETCH_ASSOC);
                $rowCount = $count['count'];

                // if the user has any unread notifications, get them.
                if ($rowCount > 0){
                    $sql = "SELECT * FROM notification WHERE credentials_userid = :userID AND notification_read = false ORDER BY notification_date asc LIMIT 10";
                    $query = $db->prepare($sql);
                    $query->bindValue(':userID', $_SESSION['USERID']);
                    $jsondata = array();

                    if ($query->execute()){
                        // we'll loop through any results.
                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                            // format the data
                            $date = date_create($row['notification_date']);
                            $date = date_format($date, 'F jS');
                            $content = $row["notification_content"];

                            // if the content is too long, concatenate it.
                            if (strlen($content) > 40)
                            {
                                $content = substr($content, 0, 40) . " ...";
                            }

                            // store the data in a JSON array
                            $jsondata[]= array('id'=>$row['notification_id'],
                                'content'=>$content,
                                'date'=>$date,
                                'notificationCount'=>$rowCount);
                        }
                        // echo the data back, json encoded.
                        echo json_encode($jsondata);
                        exit;
                    }
                }

            }

        }catch(PDOException $e){
            writeLog('DB', $e);
        }
    }

}
echo 0;
