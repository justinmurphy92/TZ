<?php
/**
 * Programmer:  Justin Murphy
 * Analyst:     Adam Howatt
 *      DATE        INITIALS        CHANGES
 *      03/06/2014  JM              INITIAL CREATION
 *
 * DESCRIPTION:
 * TUTOR SPECIFIC REGISTRATION
 */

//start session and include required classes
include('functions/header.php');
include('functions/footer.php');
include('functions/navbar.php');
include('functions/userProfile.php');
include('functions/database.php');
include('functions/codeTables.php');


displayHeader('TutleZone - Tutor Registration');
displayUserArea(0);
displayNavigation(0);
?>

<!-- Content strats -->

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <!-- Register starts -->

                <div class="logreg">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="logreg-page">
                                <h3>Get Started With <span class="color">TutleZone!</span></h3>
                                <hr />
                                <div class="form">
                                    <!-- Register form (not working)-->
                                    <form class="form-horizontal" method="POST" action="process_registration.php" enctype="multipart/form-data">
                                        <!-- Address -->
                                        <div class="form-group">
                                            <label class="control-label col-md-3" for="name">Address</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="name" name="address">
                                            </div>
                                        </div>
                                        <!-- City -->
                                        <div class="form-group">
                                            <label class="control-label col-md-3" for="name">City</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="name" name="city">
                                            </div>
                                        </div>

                                        <!-- Postal Code -->
                                        <div class="form-group">
                                            <label class="control-label col-md-3" for="email">Postal Code</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="email" name="postalcode">
                                            </div>
                                        </div>

                                        <!-- Company (optional) -->
                                        <div class="form-group">
                                            <label class="control-label col-md-3" for="username">Company</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="username" name="company">
                                            </div>
                                        </div>
                                        <!-- Personal Website -->
                                        <div class="form-group">
                                            <label class="control-label col-md-3" for="email">Website</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="password" name="website">
                                            </div>
                                        </div>
                                        <!-- Picture -->
                                        <div class="form-group">
                                            <label class="control-label col-md-3" for="email">Picture</label>
                                            <div class="col-md-9">
                                                <input type="file" name="pic" class="form-control" id="picture" accept="image/*">
                                            </div>
                                        </div>
                                        <!-- bio -->
                                        <div class="form-group">
                                            <label class="control-label col-md-3">About</label>
                                            <div class="col-md-9">
                                                <textarea class="col-md-12" name="bio"></textarea>
                                            </div>
                                        </div>
                                        <!-- User Type -->
                                        <div class="form-group">
                                            <label class="control-label col-md-3" for="select">Subject</label>
                                            <div class="col-md-9" >
                                                <select class="form-control" id="select" name="subject">
                                                    <?php
                                                    if (loadSubjects()){
                                                        foreach($_SESSION['subjects'] as $thisSubject){
                                                            echo "<option value='" . $thisSubject['id'] . "'>" . $thisSubject['name'] . "</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <p align="center" style="padding-left:100px">Choose one for now. You can add more later!</p>
                                        </div>

                                        <!-- Buttons -->
                                        <div class="form-group">
                                            <!-- Buttons -->
                                            <div class="col-md-8 col-md-offset-5">
                                                <a href="register.html"class="btn btn-default">Back</a>
                                                <button type="submit" class="btn btn-default">Register!</button>
                                            </div>
                                        </div>
                                    </form>
                                    <hr />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Login ends -->
            </div>
        </div>
    </div>
</div>
<?php displayFooter(0);?>

<!-- Content ends -->