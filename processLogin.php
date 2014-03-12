<?php
/**
 * Created by PhpStorm.
 * User: justinmurphy
 * Date: 3/10/2014
 * Time: 7:38 PM
 */
session_start();

include('functions/database.php');
$db = connectToDB();

$username = $_POST['username'];

$password = sha1($_POST['password']);


$sql = "SELECT * FROM credentials WHERE CREDENTIALS_USERNAME ='".$username."' AND CREDENTIALS_PASSWORD ='". $password."'";

try{
    $rs = $db->query($sql);
    $row = $rs->fetch(PDO::FETCH_ASSOC);
    $_SESSION['USERID'] = $row['CREDENTIALS_USERID'];

}
catch (PDOException $e){
    $error =$e->getMessage();
    writelog('DB',$error);
}

if($rs->columnCount() > 0){
    header('Location: index.php');
    exit;
}
else{
    header('Location: login.php');
    exit;
}
