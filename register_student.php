<?php
/**
 * Programmer:  Justin Murphy
 * Analyst:     Adam Howatt
 *      DATE        INITIALS        CHANGES
 *      03/06/2014  JM              INITIAL CREATION
 *
 * DESCRIPTION:
 * STUDENT SPECIFIC REGISTRATION
 */

//start session and include required classes
session_start();
include('functions/footer.php');
include('functions/header.php');
include('functions/navbar.php');
include('functions/userProfile.php');
include('functions/database.php');


displayHeader('TutleZone - Home');
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
                                        <!-- Address-->
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

                                        <!-- About -->
                                        <div class="form-group">
                                            <label class="control-label col-md-3">About</label>
                                            <div class="col-md-9">
                                                <textarea class="col-md-12" name="about"></textarea>
                                            </div>
                                        </div>

                                        <!-- Picture -->
                                        <div class="form-group">
                                            <label class="control-label col-md-3" for="file">Picutre</label>
                                            <div class="col-md-9">
                                                <input type="file" name="pic" class="form-control" id="pic">
                                            </div>
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
                                    <div class="lregister">
                                        Already have account with us? <a href="login.html">Login</a>
                                    </div>
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