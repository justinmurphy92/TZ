<?php
/**
 * Programmer:  Justin Murphy
 * Analyst:     Adam Howatt
 *      DATE        INITIALS        CHANGES
 *      03/24/2013  JM              INITIAL CREATION
 *
 * DESCRIPTION:
 * THIS CLASS WILL INSERT A PAYMENT TO THE DATABASE WHEN CALLED
 */

//include database class
include('../functions/database.php');

//connect to database
$db = connectToDB();

//if there is a database connection and all fields are populated, start binding to the query
if($db){
    if(!empty($_POST['methodID']) || !empty($_POST['matchID']) || !empty($_POST['amount']) || !empty($_POST['date'])){
        $sql = "INSERT INTO transactions (match_id, transaction_amount, transaction_date, transaction_notes, method_id) VALUES (:matchID, :tranAmount, :tranDate, tranNote, :methodID)";
        $query = $db->prepare($sql);
        $query->bindValue(':matchID', $_POST['methodID']);
        $query->bindValue(':tranAmount', $_POST['amount']);
        $query->bindValue(':tranDate', $_POST['date']);
        $query->bindValue(':tranNote', $_POST['notes']);
        $query->bindValue(':methodID', $_POST['methodID']);

        try{
            //if query executes, redirect to payment page
            if($query->execute()){
                header('Location: payments.php');
            }

        }
        catch (PDOException $e){
            //catch exception and write to log
            writeLog('DB', $e);
        }
    }
}