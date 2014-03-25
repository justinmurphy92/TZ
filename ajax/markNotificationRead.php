<?php
/**
 * Programmer:  Adam Howatt
 * Analyst:     Justin Murphy
 *      DATE        INITIALS        CHANGES
 *      03/12/2014  AH              INITIAL CREATION
 */
session_start();
include('../functions/database.php');
if (isset($_SESSION['USERID']) && isset($_POST['notifID'])){
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
