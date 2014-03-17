<?php
/**
 * Created by PhpStorm.
 * User: justinmurphy
 * Date: 3/16/2014
 * Time: 2:18 PM
 */
session_start();
include('functions/footer.php');
include('functions/header.php');
include('functions/navbar.php');
include('functions/userProfile.php');
include('functions/database.php');


displayHeader('TutleZone - Home');
displayUserArea(0);
displayNavigation(0);
$db = connectToDB();
$userType;

if ($_SESSION['TYPECODE_ID'] == '1' || $_SESSION['TYPECODE_ID'] == 1){
    $userType = 'student';
}
elseif($_SESSION['TYPECODE_ID'] == '2' || $_SESSION['TYPECODE_ID'] == 2){
    $userType = 'tutor';
}

$sql = "SELECT * FROM ".$userType." WHERE credentials_userid = ".$_SESSION['USERID'];
//$sql = "SELECT * FROM tutor WHERE credentials_userid = 18";

try{
    $rs = $db->query($sql);
    $row = $rs->fetch(PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
    writeLog('DB', $e);
}
?>
<!-- Content strats -->

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <!-- Support starts -->

                <div class="support col-md-6">
                    <div class="scontact">
                        <img scr="data:image/png; base64,<?php echo base64_decode($row[$userType.'_picture']); ?>"/>
                    </div>
                </div>

                        <div class="support-page col-md-6">
                            <h4>Profile Information<a href="editProfile.php" class="icon-edit-sign"></a></h4>
                            <hr />
                            <p>
                                <strong>First Name: </strong><?php echo $row[$userType.'_fname'];?><br/>
                                <strong>Last Name: </strong><?php echo $row[$userType.'_lname'];?><br/>
                                <strong>Address: </strong><?php echo $row[$userType.'_address'];?><br/>
                                <strong>City: </strong><?php echo $row[$userType.'_city'];?><br/>
                                <strong>Postal Code: </strong><?php echo $row[$userType.'_postal'];?><br/>
                                <strong>Email: </strong><?php echo $row[$userType.'_email'];?><br/>
                                <?php
                                    if($userType == 'student'){
                                        echo "<strong>About: </strong>".$row[$userType.'_about']."<br/>";
                                    }
                                    elseif ($userType == 'tutor'){
                                        $trimCompany = trim($row['tutor_company']);
                                        $trimWebsite = trim($row['tutor_website']);
                                        if(!empty($trimCompany)){
                                            echo "<strong>Company: </strong>".$row[$userType.'_company']."<br/>";
                                        }
                                        if(!empty($trimWebsite)){
                                            echo "<strong>Website: </strong>".$row[$userType.'_website']."<br/>";
                                        }
                                        echo "<strong>Biography: </strong>".$row[$userType.'_bio'];
                                    }
                                ?>
                            </p>

                        </div>



                <!-- FAQ ends -->

                <!-- CTA starts -->

                <div class="cta">
                    <div class="row">
                        <div class="col-md-9">
                            <!-- First line -->
                            <p class="cbig">Lorem ipsum consectetur dolor sit amet, consectetur adipiscing.</p>
                            <!-- Second line -->
                            <p class="csmall">Duis vulputate consectetur malesuada eros nec odio consect eturegestas et netus et in dictum nisi vehicula.</p>
                        </div>
                        <div class="col-md-2">
                            <!-- Button -->
                            <div class="button"><a href="#">Get A Free Trail</a></div>
                        </div>
                    </div>
                </div>

                <!-- CTA Ends -->

            </div>
        </div>
    </div>
</div>

<!-- Content ends -->

<?php displayFooter(0);?>