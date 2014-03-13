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
                    <!-- Navigation with sub menu. Please note down the syntax before you need. Each and every link is important. -->


                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pages #1 <b class="caret"></b></a>
                        <!-- Submenus -->
                        <ul class="dropdown-menu">
                            <li><a href="UNUSED/support.html">Support</a></li>
                            <li><a href="UNUSED/products.html">Products</a></li>
                            <li><a href="register.html">Register</a></li>
                            <li><a href="login.html">Login</a></li>
                            <li><a href="about.html">About</a></li>
                            <li><a href="UNUSED/service.html">Service #1</a></li>
                            <li><a href="UNUSED/service1.html">Service #2</a></li>
                            <li><a href="UNUSED/pricing.html">Pricing Table</a></li>
                            <li><a href="UNUSED/careers.html">Careers</a></li>
                            <li><a href="UNUSED/faq.html">FAQ</a></li>
                            <li><a href="UNUSED/team.html">Team</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pages #2 <b class="caret"></b></a>
                        <!-- Submenus -->
                        <ul class="dropdown-menu">
                            <li><a href="UNUSED/404.html">404</a></li>
                            <li><a href="UNUSED/comingsoon.html">Coming Soon</a></li>
                            <li><a href="UNUSED/resume.html">Resume</a></li>
                            <li><a href="UNUSED/sitemap.html">Sitemap</a></li>
                            <li><a href="UNUSED/process.html">Process</a></li>
                            <li><a href="UNUSED/testimonials.html">Testimonials</a></li>
                            <li><a href="UNUSED/review.html">Review</a></li>
                            <li><a href="UNUSED/project.html">Project</a></li>
                            <li><a href="UNUSED/timeline.html">Timeline</a></li>
                            <li><a href="UNUSED/full-width.html">Full Width</a></li>
                            <li><a href="UNUSED/events.html">Events</a></li>
                        </ul>
                    </li>


                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Blog <b class="caret"></b></a>
                        <!-- Submenus -->
                        <ul class="dropdown-menu">
                            <li><a href="UNUSED/blog.html">Blog Main #1</a></li>
                            <li><a href="UNUSED/blog1.html">Blog Main #2</a></li>
                            <li><a href="UNUSED/blog2.html">Blog Main #3</a></li>
                            <li><a href="UNUSED/blog-ls.html">Blog Left Sidebar</a></li>
                            <li><a href="UNUSED/blog-ns.html">Blog No Sidebar</a></li>
                            <li><a href="UNUSED/blog-single.html">Blog Single</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Features <b class="caret"></b></a>
                        <!-- Submenus -->
                        <ul class="dropdown-menu">
                            <li><a href="UNUSED/features.html">Features #1</a></li>
                            <li><a href="UNUSED/features1.html">Features #2</a></li>
                            <li><a href="UNUSED/features2.html">Features #3</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Portfolio <b class="caret"></b></a>
                        <!-- Submenus -->
                        <ul class="dropdown-menu">
                            <li><a href="UNUSED/gallery.html">Gallery</a></li>
                            <li><a href="UNUSED/portfolio1.html">Portfolio #1</a></li>
                            <li><a href="UNUSED/portfolio2.html">Portfolio #2</a></li>
                            <li><a href="UNUSED/portfolio.html">Portfolio #3</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Contact <b class="caret"></b></a>
                        <!-- Submenus -->
                        <ul class="dropdown-menu">
                            <li><a href="UNUSED/contact.html">Contact #1</a></li>
                            <li><a href="UNUSED/contact1.html">Contact #2</a></li>
                            <li><a href="UNUSED/clients.html">Clients</a></li>
                        </ul>
                    </li>

                </ul>
            </nav>
        </div>
    </div>

<?php
} // end navigation
?>