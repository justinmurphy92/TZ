<?php
/**
 * Created by PhpStorm.
 * User: Howatt
 * Date: 12/03/14
 * Time: 6:06 PM
 * Used to cancel all lessons for t
 */
session_start();
include('../functions/database.php');
include('../functions/codeTables.php');
if (isset($_SESSION['USERID']) && isset($_GET['confirm'])){
    $db = connectToDB();
    if ($db)
    {
        try{

            //try the update
            $sql = "UPDATE notification SET notification_read = TRUE WHERE credentials_userid = :userID AND notification_id = :notifID";
            $query = $db->prepare($sql);
            $query->bindValue(':userID', $_SESSION['USERID']);
            $query->bindValue(':notifID', $_POST['notifID']);

            if ($query->execute() && $query->rowCount() == 1){
             echo "worked";
                exit;
            }
        }
        catch(Exception $e){
            echo "Nuh uh";
        }
    }
}
echo 'failure';
