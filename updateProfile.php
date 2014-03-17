<?php
/**
 * Created by PhpStorm.
 * User: justinmurphy
 * Date: 3/16/2014
 * Time: 8:44 PM
 */
//start session and open DB connection
session_start();
include('functions/database.php');
$db = connectToDB();

//declare variables
//determine type code
$userType;
if ($_SESSION['TYPECODE_ID'] == '1' || $_SESSION['TYPECODE_ID'] == 1){
    $userType = 'student';
}
elseif($_SESSION['TYPECODE_ID'] == '2' || $_SESSION['TYPECODE_ID'] == 2){
    $userType = 'tutor';
}

$moreThanOne = null;
$comma = ",";
$sql = "UPDATE ".$userType. " SET ";


//Dynamically build query based on what information has changed
if(trim($_POST['fname']) != trim($_SESSION['row'][$userType."_fname"])){
    $sql = $sql.$userType."_fname = '".$_POST['fname']."'";
    $moreThanOne = true;
}
if(trim($_POST['lname']) != trim($_SESSION['row'][$userType."_lname"])){
    if($moreThanOne){
        $sql = $sql.$comma;
    }
    $sql = $sql.$userType."_lname = '".$_POST['lname']."'";
    $moreThanOne = true;
}

if(trim($_POST['address']) != trim($_SESSION['row'][$userType."_address"])){
    if($moreThanOne){
        $sql = $sql.$comma;
    }
    $sql = $sql.$userType."_address = '".$_POST['address']."'";
    $moreThanOne = true;
}

if(trim($_POST['city']) != trim($_SESSION['row'][$userType."_city"])){
    if($moreThanOne){
        $sql = $sql.$comma;
    }
    $sql = $sql.$userType."_city = '".$_POST['city']."'";
    $moreThanOne = true;
}

if(trim($_POST['postal']) != trim($_SESSION['row'][$userType."_postal"])){
    if($moreThanOne){
        $sql = $sql.$comma;
    }
    $sql = $sql.$userType."_postal = '".$_POST['postal']."'";
    $moreThanOne = true;
}

if(trim($_POST['email']) != trim($_SESSION['row'][$userType."_email"])){
    if($moreThanOne){
        $sql = $sql.$comma;
    }
    $sql = $sql.$userType."_email = '".$_POST['email']."'";
    $moreThanOne = true;
}


if($userType == 'student'){
    if(trim($_POST['about']) != trim($_SESSION['row'][$userType."_about"])){
        if($moreThanOne){
            $sql =$sql.$comma;
        }
        $sql = $sql.$userType."_about = '".$_POST['about']."'";
        $moreThanOne = true;
    }
}
elseif($userType == 'tutor'){
    if(trim($_POST['company']) != trim($_SESSION['row'][$userType."_company"])){
        if($moreThanOne){
            $sql = $sql.$comma;
        }
        $sql = $sql.$userType."_company = '".$_POST['company']."'";
        $moreThanOne = true;
    }
    if(trim($_POST['website']) != trim($_SESSION['row'][$userType."_website"])){
        if($moreThanOne){
            $sql = $sql.$comma;
        }
        $sql = $sql.$userType."_website = '".$_POST['company']."'";
        $moreThanOne = true;
    }
    if(trim($_POST['bio']) != trim($_SESSION['row'][$userType."_bio"])){
        if($moreThanOne){
            $sql = $sql.$comma;
        }
        $sql = $sql.$userType."_bio = '".$_POST['bio'];
        $moreThanOne = true;
    }

}

if($moreThanOne){
    try{
        $sql = $sql." WHERE credentials_userid = ".$_SESSION['USERID'];
        $rs = $db->query($sql);
    }
    catch (PDOException $e){
        writeLog('DB', $e);
    }
}

header('Location: profile.php');