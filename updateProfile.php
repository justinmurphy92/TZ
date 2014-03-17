<?php
/**
 * Created by PhpStorm.
 * User: justinmurphy
 * Date: 3/16/2014
 * Time: 8:44 PM
 */
session_start();
include('functions/database.php');
$db = connectToDB();

$moreThanOne = null;
$comma = ",";

if ($_SESSION['TYPECODE_ID'] == '1' || $_SESSION['TYPECODE_ID'] == 1){
    $userType = 'student';
}
elseif($_SESSION['TYPECODE_ID'] == '2' || $_SESSION['TYPECODE_ID'] == 2){
    $userType = 'tutor';
}

$rowAtt = "row['".$userType."_";
$sql = "UPDATE ".$userType. " SET ";


if(trim($_POST['fname']) != trim($_SESSION[$rowAtt."fname"])){
    $sql = $sql + $userType."_fname = '".$_SESSION[$rowAtt."fname"]."'";
    $moreThanOne = true;
}
if(trim($_POST['lname']) != trim($_SESSION[$rowAtt."lname"])){
    if($moreThanOne){
        $sql = $sql + $comma;
    }
$sql = $sql;
}