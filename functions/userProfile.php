<?php
/**
 * Created by PhpStorm.
 * User: Howatt
 * Date: 06/03/14
 * Time: 6:07 PM
 * Purpose:
 * The user profile section contains a sneak peek at new notifications, schedule events, and provides search functionality.
 */

function displayUserArea() {
    $LOGGED_IN = isset($_SESSION['USERID']);
?>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <!-- Logo and site link -->
                    <div class="logo">
                        <a href="index.html"><img  src="img/logo.png" alt="TutleZone Logo"/></a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-sm-offset-4 col-md-offset-4">
                    <div class="list">
                        <!-- User Name/Profile -->
                        <div class="user">
                            <i class="icon-user color"></i>
                            <?php
                            if ($LOGGED_IN){
                                echo $_SESSION['USERID'];
                            }
                            ?>
                            <div class="user-box dropdown-box">
                                <ul>
                                    <?php
                                    if ($LOGGED_IN){
                                    ?>
                                    <li><a href="myProfile.php"><i class="icon-gear"></i> PROFILE</a></li>
                                    <li><a href="logout.php"><i class="icon-ban-circle"></i> LOGOUT</a></li>
                                    <?php
                                    } // END LOGGED IN OPTIONS
                                    else {
                                    ?>
                                    <li><a href="register.php"><i class="icon-barcode"></i> REGISTER</a></li>
                                    <li><a href="login.php"><i class="icon-signin"></i> LOGIN</a></li>
                                    <?php
                                    } // END GUEST OPTIONS
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <hr />
                        <!-- User Notifications -->
                        <div class="notification">
                            <i class="icon-envelope-alt color"></i>
                            <span class="label label-danger" id="notificationCount"></span>
                            New Notifications
                            <div class="notification-box dropdown-box">
                                <ul id="notificationList">
                                    <li><a href="#">GOTO: Notifications Page</a></li>
                                </ul>
                            </div>
                        </div>
                        <hr />
                        <!-- User Schedule -->
                        <div class="schedule">
                            <i class="icon-calendar color"></i>
                            <span class="label label-danger">X</span>
                            Lessons < 24 hours
                            <div class="schedule-box dropdown-box">
                                <ul>
                                    <li><a href="#">GOTO: Scheduling Page </a></li>
                                </ul>
                            </div>
                        </div>
                        <hr />
                        <!-- User Schedule -->
                        <div class="search">
                            <form role="search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search" name="srch-term" id="search">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit" style="background-color: lavender;"><i style="margin:auto;" class="icon-search color"></i></button>
                            </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

<?php
} // end userProfile area
?>