<?php
/**
 * Created by PhpStorm.
 * User: justinmurphy
 * Date: 3/24/2014
 * Time: 5:01 PM
 */
include('../functions/database.php');

$db = connectToDB();

if($db){
    if(empty($_POST['methodID']) || empty($_POST['matchID']) || empty($_POST['amount']) || empty($_POST['date'])){
        $sql = "INSERT INTO transactions (match_id, transaction_amount, transaction_date, transaction_notes, method_id) VALUES (:matchID, :tranAmount, :tranDate, tranNote, :methodID)";
        $query = $db->prepare($sql);
        $query->bindValue(':matchID', $_POST['methodID']);
        $query->bindValue(':tranAmount', $_POST['amount']);
        $query->bindValue(':tranDate', $_POST['date']);
        $query->bindValue(':tranNote', $_POST['notes']);
        $query->bindValue(':methodID', $_POST['methodID']);

        try{
            if($query->execute()){
                header('Location: payments.php');
            }
            else{
                echo "shit's broken son";
            }
        }
        catch (PDOException $e){
            writeLog('DB', $e);
        }
    }
}