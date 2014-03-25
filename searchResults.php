<?php
/**
 * Programmer:  Justin Murphy
 * Analyst:     Adam Howatt
 *      DATE        INITIALS        CHANGES
 *      03/20/2014  JM              INITIAL CREATION
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

            </div>
        </div>
    </div>
</div>

<!-- Content ends -->
<?php
displayFooter(0);
?>

