<?php
/**
 * Created by PhpStorm.
 * User: Howatt
 * Date: 06/03/14
 * Time: 6:07 PM
 * Purpose:
 * Prints out the navigation bar based on the user's profile type.
 * Different levels currently (or will someday) have access to different functionality, this controls that.
 */

function displayNavigation() {
?>

    <div class="navbar bs-docs-nav" role="banner">

        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
                <!-- Navigation links starts here -->
                <ul class="nav navbar-nav">
                    <!-- Main menu -->
                    <li><a href="index.php"> Home </a></li>
                    <li><a href="lessons.php"> Lessons </a></li>
                    <li><a href="notifications.php"> Notifications </a></li>
                    <?php if(isset($_SESSION['USERID'])){
                        echo "<li><a href='invoice.php'>Invoices</a></li>";
                    }

                    if (isset($_SESSION['TYPECODE_ID']) && ($_SESSION['TYPECODE_ID'] == '2' || $_SESSION['TYPECODE_ID'] == 2)){
                        echo "<li><a href='payments.php'>Payments</a></li>";
                    }

                    if (!isset($_SESSION['USERID'])) {
                        echo "<li><a href='login.php'>Login</a></li>";
                        echo "<li><a href='register.php'>Register</a></li>";
                    }
                    ?>

                </ul>
            </nav>
        </div>
    </div>

<?php
} // end navigation
?>