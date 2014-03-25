<?php
/**
 * Programmer:  Justin Murphy
 * Analyst:     Adam Howatt
 *      DATE        INITIALS        CHANGES
 *      03/10/2014  JM              INITIAL CREATION
 *      03/24/2014  JM              ADDED ERROR HANDLING
 *
 * DESCRIPTION:
 * THIS FUNCTION WILL CHECK THE DATABASE TO SEE IF THE USER NAME AND PASSWORD ARE CORRECT.
 * IF THEY ARE, SESSION INFROMATION IF STORED
 */

//start session, declare variables and call the database class
session_start();
$userType = '';
$failed;
$locked;


include('functions/database.php');
$db = connectToDB();

//save form data from login page to working storage
$username = $_POST['username'];

$password = sha1($_POST['password']);


$sql = "SELECT * FROM credentials WHERE CREDENTIALS_USERNAME ='".$username."' AND CREDENTIALS_PASSWORD ='". $password."'";

try{
    //execute query and save session data
    $rs = $db->query($sql);
    $row = $rs->fetch(PDO::FETCH_ASSOC);
    $_SESSION['USERID'] = $row['CREDENTIALS_USERID'];
    $_SESSION['TYPECODE_ID'] = $row['TYPECODE_ID'];
    $failed = $row['CREDENTIALS_FAILED_ATTEMPTS'];
    $locked = $row['CREDENTIALS_LOCKED'];
}

catch (PDOException $e){
    //catch exception and write to log
    writelog('DB',$e);
}

if($row['TYPECODE_ID'] == '1' || $row['TYPECODE_ID'] == 1){
    $userType = 'student';
}
elseif ($row['TYPECODE_ID'] == '2' || $row['TYPECODE_ID'] == 2){
    $userType = 'tutor';
}
else{
    //return to login with error
    header('Location: login.php?error=1');

}


$sql = "SELECT * FROM ".$userType." WHERE credentials_userid = ".$_SESSION['USERID'];

try{
    //get first name and last name from database and save to session
    $rs = $db->query($sql);
    $row = $rs->fetch(PDO::FETCH_ASSOC);
    $_SESSION['FNAME'] = $row[$userType.'_fname'];
    $_SESSION['LNAME'] = $row[$userType.'_lname'];

}
catch (PDOException $e){
    //catch exception and write to log
    writelog('DB',$e);
}

if($rs->columnCount() > 0){
    //return to index logged in
    header('Location: index.php');
    exit;
}

