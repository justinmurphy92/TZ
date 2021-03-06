<?php
/**
 * Programmer:  Justin Murphy
 * Analyst:     Adam Howatt
 *      DATE        INITIALS        CHANGES
 *      03/06/2014  JM              INITIAL CREATION
 *
 * DESCRIPTION:
 * THIS IS THE LOGIN PAGE FOR BOTH TUTORS AND STUDENTS.
 */

//include needed classes
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

                <!-- Login starts -->

                <div class="logreg">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="logreg-page">
                                <h3>Sign In to <span class="color">TutleZone</span></h3>
                                <hr />
                                <div class="form">
                                    <!-- Login form (not working)-->
                                    <form class="form-horizontal" method="POST" action="processLogin.php">
                                        <!-- Username -->
                                        <div class="form-group">
                                            <label class="control-label col-md-3" for="username">Username</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="username" name="username">
                                            </div>
                                        </div>
                                        <!-- Password -->
                                        <div class="form-group">
                                            <label class="control-label col-md-3" for="email">Password</label>
                                            <div class="col-md-9">
                                                <input type="password" class="form-control" id="password" name="password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-9 col-md-offset-3">
                                                <label class="checkbox-inline">
                                                    <input type="checkbox"> Remember me
                                                </label>
                                            </div>
                                        </div>
                                        <!-- Buttons -->
                                        <div class="form-group">
                                            <!-- Buttons -->
                                            <div class="col-md-9 col-md-offset-3">
                                                <button type="submit" class="btn btn-default">Login</button>
                                                <button type="reset" class="btn btn-default">Reset</button>
                                            </div>
                                        </div>
                                    </form>

                                    <hr />
                                    <div class="lregister">
                                        Don't have Account? <a href="register.html">Register</a><br/>
                                        <a href="forgotpass.html">Forgot your password?</a>
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
<?php
displayFooter(0);
?>