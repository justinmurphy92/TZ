<?php
/**
 * Created by PhpStorm.
 * User: justinmurphy
 * Date: 3/11/2014
 * Time: 8:44 PM
 */
session_start();
include('functions/database.php');
$db = connectToDB();

$fname= $_SESSION['fname'];
$lname = $_SESSION['lname'];
$email = $_SESSION['email'];
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$type = $_SESSION['type'];
$address = trim($_POST['address']);
$city = trim($_POST['city']);
$postalcode = trim($_POST['postalcode']);
$about = trim($_POST['about']);
$picture = $_POST['picture'];

if($type == "Student"){
    if(empty($address) || empty($city) || empty($postalcode) || empty($about)){
        header('Location: register_student.php');
    }
    $sql = "INSERT INTO credentials (CREDENTIALS_USERNAME, CREDENTIALS_PASSWORD, TYPECODE_ID) VALUES (:username, :password, :type)";
    $query = $db->prepare($sql);
    $query->bindValue(':username', $username);
    $query->bindValue(':password', $password);
    $query->bindValue(':type', '1');
    $query->execute();


}
