<?php
/**
 * Created by PhpStorm.
 * User: justinmurphy
 * Date: 3/10/2014
 * Time: 7:38 PM
 */

include('functions/database.php');
$db = connectToDB();

$username = $_POST['username'];

$password = sha1($_POST['password']);


$sql = "SELECT * FROM credentials WHERE credentials_username ='".$username."' AND credentials_password ='". $password."'";

try{
    $rs = $db->query($sql);

    if($rs->columnCount() > 0){
        header('Location: index.php');
        exit;
    }
    else{
        header('Location: login.php');
        exit;
    }
}
catch (PDOException $e){
    $error =$e->getMessage();
    writelog('DB',$error);
}
