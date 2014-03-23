<?php
/**
 * Created by PhpStorm.
 * User: justinmurphy
 * Date: 3/20/2014
 * Time: 8:27 PM
 */

include('functions/footer.php');
include('functions/header.php');
include('functions/navbar.php');
include('functions/userProfile.php');
include('functions/database.php');

displayHeader('TutleZone - Home');
displayUserArea(0);
displayNavigation(0);
?>

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <!-- FAQ starts -->

                <div class="faq">
                    <div class="row">
                        <div class="col-md-12">

                            <!-- FAQ hero -->
                            <div class="hero">
                                <!-- Title. Don't forget the <span> tag -->
                                <h3><span>Search Results</span></h3>
                            </div>
                            <!-- FAQ -->

                            <div class="accordion" id="accordion2">
                                <!-- Each item should be enclosed inside the class "accordion-group". Note down the below markup. -->
                                <?php
                                        $counter = 1;
                                        foreach($_SESSION['results'] as $results){

                                            echo "
                                                <div class='accordion-group'>
                                                    <div class='accordion-heading'>
                                                        <a href='viewProfile.php?userid=".$results['id']."&type=".$results['type']."'>
                                                            <h5>".$results['fname']." ". $results['lname']."</h5>
                                                        </a>
                                                    </div>
                                                    <div id='collapse".$counter."' class='accordion-body collapse in''>
                                                        <div class='accordion-inner'>
                                                            <p>".$results['about']."</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            ";
                                            $counter++;
                                        }

                                ?>

                            </div>

                        </div>
                    </div>
                </div>


                <!-- FAQ ends -->

                <!-- CTA starts -->

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

                <!-- CTA Ends -->

            </div>
        </div>
    </div>
</div>

<!-- Content ends -->
<?php
displayFooter(0);
?>

