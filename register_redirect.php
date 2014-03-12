<?php
/**
 * Created by PhpStorm.
 * User: justinmurphy
 * Date: 3/11/2014
 * Time: 8:18 PM
 */
session_start();

$fname = trim($_POST['fname']);
$lname = trim($_POST['lname']);
$email = trim($_POST['email']);
$username = trim($_POST['username']);
$password = trim($_POST['password']);
$vPassword = trim($_POST['Vpassword']);
$type = trim($_POST['type']);

if (empty($fname) || empty($lname) || empty($email) || empty($username) || empty($password) || empty($vPassword) || empty($type) || !isset($_POST['terms']) || !filter_var($email, FILTER_VALIDATE_EMAIL) || $password <> $vPassword){
    header('Location: register.php');
}
else{
    $_SESSION['fname'] = $fname;
    $_SESSION['lname'] = $lname;
    $_SESSION['email'] = $email;
    $_SESSION['username'] = $username;
    $_SESSION['password'] = sha1($password);
    $_SESSION['type'] = $type;
    $_SESSION['terms'] = "TRUE";

    if($type == "Student"){
        header('Location: register_student.php');
    }
    elseif($type == "Tutor"){
        header('Location: register_tutor.php');
    }
}

