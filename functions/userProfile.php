<?php
/**
 * Created by PhpStorm.
 * User: Howatt
 * Date: 06/03/14
 * Time: 6:07 PM
 * Purpose:
 * The user profile section contains a sneak peek at new notifications, schedule events, and provides search functionality.
 */

function displayUserArea($userID) {
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
                            <i class="icon-user color"></i> User Name & Logout Link
                        </div>
                        <hr />
                        <!-- User Notifications -->
                        <div class="notification">
                            <i class="icon-envelope-alt color"></i> X New Notifications
                        </div>
                        <hr />
                        <!-- User Schedule -->
                        <div class="schedule">
                            <i class="icon-calendar color"></i> 5 Lessons < 24 hours
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