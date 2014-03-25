<?php
/**
 * Programmer:  Justin Murphy
 * Analyst:     Adam Howatt
 *      DATE        INITIALS        CHANGES
 *      03/10/2014  JM              INITIAL CREATION
 *
 * DESCRIPTION:
 * THIS IS THE FIRST REGISTER PAGE, FROM HERE, THE USER IS REDIRECTED TO APPROPRIATE SECOND PAGE BASED ON
 * WHETHER THEY CHOSE STUDENT OR TUTOR
 */

//include required classes
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
                                    <form class="form-horizontal" method="POST" action="register_redirect.php">
                                        <!-- First Name -->
                                        <div class="form-group">
                                            <label class="control-label col-md-3" for="name">First Name</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="name" name="fname">
                                            </div>
                                        </div>
                                        <!-- Last Name -->
                                        <div class="form-group">
                                            <label class="control-label col-md-3" for="name">Last Name</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="name" name="lname">
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div class="form-group">
                                            <label class="control-label col-md-3" for="email" >Email</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="email" name="email">
                                            </div>
                                        </div>

                                        <!-- Username -->
                                        <div class="form-group">
                                            <label class="control-label col-md-3" for="username">Username</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="username" name="username">
                                            </div>
                                        </div>
                                        <!-- Password -->
                                        <div class="form-group">
                                            <label class="control-label col-md-3" for="email">Pass</label>
                                            <div class="col-md-9">
                                                <input type="password" class="form-control" id="password" name="password">
                                            </div>
                                        </div>
                                        <!-- Verify Password -->
                                        <!-- Password -->
                                        <div class="form-group">
                                            <label class="control-label col-md-3" for="email">Verify Pass</label>
                                            <div class="col-md-9">
                                                <input type="password" class="form-control" id="password" name="Vpassword">
                                            </div>
                                        </div>
                                        <!-- User Type -->
                                        <div class="form-group">
                                            <label class="control-label col-md-3" for="select">User Type</label>
                                            <div class="col-md-9" >
                                                <select class="form-control" id="select" name="type">
                                                    <option>&nbsp;</option>
                                                    <option>Student</option>
                                                    <option>Tutor</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Checkbox -->
                                        <div class="form-group">
                                            <div class="col-md-8 col-md-offset-3">
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox1" value="agree" name="terms"/> <a href="term.php" target="_blank">Agree with Terms and Conditions</a>
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Buttons -->
                                        <div class="form-group">
                                            <!-- Buttons -->
                                            <div class="col-md-8 col-md-offset-5">
                                                <button type="submit" class="btn btn-default">Next</button>
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

<!-- Content ends -->
<?php displayFooter(0);?>