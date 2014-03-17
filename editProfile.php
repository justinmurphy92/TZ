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

echo $sql;
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

                        <div>

                            <!-- Support -->

                            <div class="row">

                                <div class="col-md-2 col-sm-2">
                                    <!-- Contact box -->
                                    <div class="scontact">
                                        <img scr="data:image/png; base64,<?php echo base64_decode($row[$userType.'_picture']); ?>"/>

                                    </div>
                                </div>
                            </div>
                        </div>

                </div>

                <div class="support-page col-md-6">
                    <h4>Profile Information</h4>
                    <form class="form-horizontal" method="POST" action="updateProfile.php">
                        <hr/>
                        <?php echo "
                        <table>
                            <tr>
                                <td>First Name:</td>
                                <td><input type='text' value='".$row[$userType.'_fname']."' name='fname'/></td>
                            </tr>
                            <tr>
                                <td>Last Name:</td>
                                <td><input type='text' value='".$row[$userType.'_lname']."' name='lname'/></td>
                            </tr>
                            <tr>
                                <td>Address:</td>
                                <td><input type='text' value='".$row[$userType.'_address']."' name='address'/></td>
                            </tr>
                            <tr>
                                <td>City:</td>
                                <td><input type='text' value='".$row[$userType.'_city']."' name='city'/></td>
                            </tr>
                            <tr>
                                <td>Postal Code:</td>
                                <td><input type='text' value='". $row[$userType.'_postal']."' name='postal'/></td>
                            </tr>
                            <tr>
                                 <td>Email:</td>
                                 <td><input type='text' value='".$row[$userType.'_email']."' name='email'/></td>
                            </tr>";

                                    if($userType == 'student'){
                                        echo "<tr><td>About:</td><td><input type='text' value='".$row[$userType.'_about']."' name='about'/></td></tr>";
                                    }
                                    elseif ($userType == 'tutor'){
                                        $trimCompany = trim($row['tutor_company']);
                                        $trimWebsite = trim($row['tutor_website']);
                                        if(!empty($trimCompany)){
                                            echo "<tr><td>Company:</td><td><input type='text' value='".$row[$userType.'_company']."' name='company'/></td></tr>";
                                        }
                                        if(!empty($trimWebsite)){
                                            echo "<tr><td>Website:</td><td><input type='text' value='".$row[$userType.'_website']."' name='website'/></td></tr>";
                                        }
                                        echo "<tr><td>Biography:</td><td><textarea name='bio'>".$row[$userType.'_bio']."</textarea>";
                                    }

                        echo "</table>";
                        $_SESSION['row'] = $row;
                        ?>
                        <input type="submit" class="btn btn-default">Save</button>
                    </form>
                </div>
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
            </div>
        </div>
    </div>
</div>

<?php displayFooter(0);?>