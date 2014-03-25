<?php
/**
 * Programmer:  Justin Murphy
 * Analyst:     Adam Howatt
 *      DATE        INITIALS        CHANGES
 *      03/11/2014  JM              INITIAL CREATION
 *      03/24/2014  JM              ADDED ERROR HANDLING
 */

//include database class
include ('functions/database.php');


//connect to db and start session
$db = connectToDB();
session_start();

//move form data to working storage
$fname = trim($_POST['fname']);
$lname = trim($_POST['lname']);
$email = trim($_POST['email']);
$username = trim($_POST['username']);
$password = trim($_POST['password']);
$vPassword = trim($_POST['Vpassword']);
$type = trim($_POST['type']);

$sql = "SELECT * FROM credentials WHERE CREDENTIALS_USERNAME ='".$username."'";

try{

    $rs = $db->query($sql)->fetchAll();
    $count = count($rs);


}
catch (PDOException $e){
    writelog('DB',$e);
}

if (empty($fname) || empty($lname) || empty($email) || empty($username) || empty($password) || empty($vPassword) || empty($type) || !isset($_POST['terms']) || !filter_var($email, FILTER_VALIDATE_EMAIL) || $password <> $vPassword || $count > 0 ){
    //redirect back to register with error
    header('Location: register.php?error=3');
}
else{
    //save working storage to the session so it can be seen on the next page
    $_SESSION['fname'] = $fname;
    $_SESSION['lname'] = $lname;
    $_SESSION['email'] = $email;
    $_SESSION['username'] = $username;
    $_SESSION['password'] = sha1($password);
    $_SESSION['type'] = $type;
    $_SESSION['terms'] = "TRUE";

    //redirect to register page 2 based on user type
    if($type == "Student"){
        header('Location: register_student.php');
    }
    elseif($type == "Tutor"){
        header('Location: register_tutor.php');
    }
}

