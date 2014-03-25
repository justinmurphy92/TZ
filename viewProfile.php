<?php
/**
 * Programmer:  Justin Murphy
 * Analyst:     Adam Howatt
 *      DATE        INITIALS        CHANGES
 *      03/22/2014  JM              INITIAL CREATION
 *
 * DESCRIPTION:
 * THIS PAGE IS WHERE USERS WILL VIEW OTHER PEOPLES PROFILES
 */

//inlude required functions
include('functions/header.php');
include('functions/footer.php');
include('functions/navbar.php');
include('functions/userProfile.php');
include('functions/database.php');


displayHeader('TutleZone - View Profile');
displayUserArea();
displayNavigation();

//connect to database
$db = connectToDB();

if ($_GET['type'] == '1' || $_GET['type'] == 1){
    $userType = 'student';
}
elseif($_GET['type'] == '2' || $_GET['type'] == 2){
    $userType = 'tutor';
}

$sql = "SELECT * FROM ".$userType." WHERE credentials_userid = ".str_replace('"', "",$_GET['userid']);


try{
    //get information to build the page
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
                    <?php
                    //request match button
                    if (isset($_SESSION['USERID']) && ($_SESSION['TYPECODE_ID'] == '1' || $_SESSION['TYPECODE_ID'] == 1)){
                        echo "<div class='button'><a href='requestMatch.php?user=".$_GET['userid']."'>ASK TO BE YOUR TUTOR </a></div>";
                    }
                    elseif(isset($_SESSION['USERID']) && ($_SESSION['TYPECODE_ID'] == '2' || $_SESSION['TYPECODE_ID'] == 2)){
                        echo "<div class='button'><a href='requestMatch.php?user=".$_GET['userid']."'>ASK TO BE YOUR TUTOR </a></div>";
                    }
                    ?>
            <div class="row">
                <div class="col-md-12">

                    <!-- Support starts -->

                    <div class="support col-md-6">
                        <div class="scontact">
                            <img src="img/profile.png" alt="Picture Placeholder"/>
                        </div>
                    </div>

                    <div class="support-page col-md-6">
                        <hr />
                        <p>
                            <!--dynamically build profile page -->
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
                </div>
            </div>
        </div>
    </div>

    <!-- Content ends -->

<?php displayFooter();?>