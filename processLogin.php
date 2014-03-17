<?php
/**
 * Created by PhpStorm.
 * User: justinmurphy
 * Date: 3/10/2014
 * Time: 7:38 PM
 * send user fname, lname and type code through session
 */
session_start();
$userType = '';

include('functions/database.php');
$db = connectToDB();

$username = $_POST['username'];

$password = sha1($_POST['password']);


$sql = "SELECT * FROM credentials WHERE CREDENTIALS_USERNAME ='".$username."' AND CREDENTIALS_PASSWORD ='". $password."'";

try{
    $rs = $db->query($sql);
    $row = $rs->fetch(PDO::FETCH_ASSOC);
    $_SESSION['USERID'] = $row['CREDENTIALS_USERID'];
    $_SESSION['TYPECODE_ID'] = $row['TYPECODE_ID'];
}

catch (PDOException $e){
    writelog('DB',$e);
}

if($row['TYPECODE_ID'] == '1' || $row['TYPECODE_ID'] == 1){
    $userType = 'student';
}
elseif ($row['TYPECODE_ID'] == '2' || $row['TYPECODE_ID'] == 2){
    $userType = 'tutor';
}


$sql = "SELECT * FROM ".$userType." WHERE credentials_userid = ".$_SESSION['USERID'];

try{
    $rs = $db->query($sql);
    $row = $rs->fetch(PDO::FETCH_ASSOC);
    $_SESSION['FNAME'] = $row[$userType.'_fname'];
    $_SESSION['LNAME'] = $row[$userType.'_lname'];

}
catch (PDOException $e){
    writelog('DB',$e);
}

if($rs->columnCount() > 0){
    header('Location: index.php');
    exit;
}
else{
    header('Location: login.php');
    exit;
}
