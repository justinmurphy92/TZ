<?php
/**
 * Created by PhpStorm.
 * User: justinmurphy
 * Date: 3/11/2014
 * Time: 8:44 PM
 * put fname lname, userid and type code
 */
session_start();
include('functions/database.php');
$db = connectToDB();

//transfer session and post variables to working storage
$fname= $_SESSION['fname'];
$lname = $_SESSION['lname'];
$email = $_SESSION['email'];
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$type = $_SESSION['type'];
$address = trim($_POST['address']);
$city = trim($_POST['city']);
$postalcode = trim($_POST['postalcode']);

if(isset($_POST['about'])){
    $about = trim($_POST['about']);
}
elseif(isset($_POST['bio'])){
    $company = trim($_POST['company']);
    $website = trim($_POST['website']);
    $bio = trim($_POST['bio']);
    $subject = trim($_POST['subject']);
}

if($type == "Student"){
    //input validation
    if(empty($address) || empty($city) || empty($postalcode) || empty($about)){
        header('Location: register_student.php');
    }
    else{
        //prepare query
        $sql = "INSERT INTO credentials (CREDENTIALS_USERNAME, CREDENTIALS_PASSWORD, TYPECODE_ID) VALUES (:username, :password, :type)";
        $query = $db->prepare($sql);
        $query->bindValue(':username', $username);
        $query->bindValue(':password', $password);
        $query->bindValue(':type', '1');
        try{
            //run query
            $query->execute();
        }
        catch (PDOException $e){
            writelog('DB',$e);
        }
        //get userid
        $sql = "SELECT * FROM credentials WHERE CREDENTIALS_USERNAME ='".$username."' AND CREDENTIALS_PASSWORD ='". $password."'";
        try{
            $rs = $db->query($sql);
            $row = $rs->fetch(PDO::FETCH_ASSOC);
            $userid = $row['CREDENTIALS_USERID'];

        }
        catch (PDOException $e){
            writelog('DB',$e);
        }

        //prepare image for upload
        if ( ($_FILES["pic"]["size"] < 20000)){
            try{
                $picture = (string)base64_encode($_FILES["pic"]["name"]);
                $picture;
            }
            catch(Exception $e){
                writeLog('IMG', $e);
            }
        }


        //prepare query
        $sql = "INSERT INTO student (credentials_userid, student_fname, student_lname, student_address, student_city, student_postal, student_email, student_picture, student_about) VALUES (:userid, :fname, :lname, :address, :city, :postal, :email, :picture, :about)";
        $query = $db->prepare($sql);
        $query->bindValue(':userid', $userid);
        $query->bindValue(':fname', $fname);
        $query->bindValue(':lname', $lname);
        $query->bindValue(':address', $address);
        $query->bindValue(':city', $city);
        $query->bindValue(':postal', $postalcode);
        $query->bindValue(':email', $email);
        $query->bindValue(':picture', $picture);
        $query->bindValue(':about', $about);
        //run query
        try{
            if($query->execute()){
                $_SESSION['USERID'] = $userid;
                $_SESSION['TYPECODE_ID'] = 1;
                $_SESSION['fname'] = $fname;
                $_SESSION['lname'] = $lname;
                header('Location: index.php');
            }
        }
        catch (PDOException $e){
            writelog('DB',$e);
        }

    }
}
elseif ($type == 'Tutor'){
    if(empty($address) || empty($city) || empty($postalcode) || empty($bio) || empty($subject)){
        //header('Location: register_tutor.php');
    }
    else{
        //prepare query
        $sql = "INSERT INTO credentials (CREDENTIALS_USERNAME, CREDENTIALS_PASSWORD, TYPECODE_ID) VALUES (:username, :password, :type)";
        $query = $db->prepare($sql);
        $query->bindValue(':username', $username);
        $query->bindValue(':password', $password);
        $query->bindValue(':type', '2');
        try{
            //run query
            $query->execute();
        }
        catch (PDOException $e){
            writelog('DB',$er);
        }
        //get userid
        $sql = "SELECT * FROM credentials WHERE CREDENTIALS_USERNAME ='".$username."' AND CREDENTIALS_PASSWORD ='". $password."'";
        try{
            $rs = $db->query($sql);
            $row = $rs->fetch(PDO::FETCH_ASSOC);
            $userid = $row['CREDENTIALS_USERID'];

        }
        catch (PDOException $e){
            writelog('DB',$e);
        }

        //prepare image for upload
        if ( ($_FILES["pic"]["size"] < 20000)){
            $picture = (string)base64_encode($_FILES["pic"]["name"]);
        }


        //prepare query
        $sql = "INSERT INTO tutor (credentials_userid, tutor_fname, tutor_lname, tutor_address, tutor_city, tutor_postal, tutor_email, tutor_picture, tutor_company, tutor_website, tutor_bio) VALUES (:userid, :fname, :lname, :address, :city, :postal, :email, :picture, :company, :website, :bio)";
        $query = $db->prepare($sql);
        $query->bindValue(':userid', $userid);
        $query->bindValue(':fname', $fname);
        $query->bindValue(':lname', $lname);
        $query->bindValue(':address', $address);
        $query->bindValue(':city', $city);
        $query->bindValue(':postal', $postalcode);
        $query->bindValue(':email', $email);
        $query->bindValue(':picture', $picture);
        $query->bindValue(':company', $company);
        $query->bindValue(':website', $website);
        $query->bindValue(':bio', $bio);
        //run query
        try{
            $query->execute();
        }
        catch (PDOException $e){
            writelog('DB',$e);
        }

        //prepare query
        $sql = "SELECT * FROM subject WHERE subject_name = '".$subject."'";
        //run query
        $rs = $db->query($sql);
        $row = $rs->fetch(PDO::FETCH_ASSOC);
        $subjectID = $row['subject_id'];


        $sql = "INSERT INTO expertise (tutor_id, subject_id) VALUE (:tutorID, :subjectID)";
        $query = $db->prepare($sql);
        $query->bindValue(':tutorID', $userid);
        $query->bindValue(':subjectID', $subjectID);
        //run query

        try{
             if($query->execute()){
                $_SESSION['USERID'] = $userid;
                $_SESSION['TYPECODE_ID'] = 2;
                $_SESSION['fname'] = $fname;
                $_SESSION['lname'] = $lname;

                header('Location: index.php');
             }
            else{
                echo "SOMETHING IS HORRIBLY WRONG! CALL FOR HELP";
            }

        }
        catch (PDOException $e){
            writelog('DB', $e);
        }

    }
}
