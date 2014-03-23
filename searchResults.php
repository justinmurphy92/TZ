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

                                ?>

                                <!-- First Accordion -->
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                            <!-- Title. Don't forget the <i> tag. -->
                                            <h5><i class="icon-plus"></i> Proin porttitor eros a ante molestie gravida ?</h5>
                                        </a>
                                    </div>
                                    <div id="collapseOne" class="accordion-body collapse in">
                                        <div class="accordion-inner">
                                            <!-- Para -->
                                            <p>Proin porttitor eros a ante molestie gravida commodo dui adipiscing. <a href="#">Morbi dictum nibh gravida</a> mi pretium dapibus. Nullam in est urna. In vitae adipiscing enim. Curabitur rhoncus condimentum lorem, non convallis dolor faucibus eget. In ut nulla est. Sed a interdum mauris. </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Second Accordion -->
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                            <h5><i class="icon-plus"></i> Proin porttitor eorbi dictum nibh gravida ?</h5>
                                        </a>
                                    </div>
                                    <div id="collapseTwo" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            <p>Proin porttitor eros a ante molestie gravida commodo dui adipiscing. <a href="#">Morbi dictum nibh gravida</a> mi pretium dapibus. Nullam in est urna. In vitae adipiscing enim. Curabitur rhoncus condimentum lorem, non convallis dolor faucibus eget. In ut nulla est. Sed a interdum mauris. </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Thrid accordion -->
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                            <h5><i class="icon-plus"></i> In vitae adipiscing adipiscing enim gravida ?</h5>
                                        </a>
                                    </div>
                                    <div id="collapseThree" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            <p>Proin porttitor eros a ante molestie gravida commodo dui adipiscing. <a href="#">Morbi dictum nibh gravida</a> mi pretium dapibus. Nullam in est urna. In vitae adipiscing enim. Curabitur rhoncus condimentum lorem, non convallis dolor faucibus eget. In ut nulla est. Sed a interdum mauris. </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Fourth accordion -->
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                            <h5><i class="icon-plus"></i> Sed a interdum mauris molestie gravida ?</h5>
                                        </a>
                                    </div>
                                    <div id="collapseFour" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            <p>Proin porttitor eros a ante molestie gravida commodo dui adipiscing. <a href="#">Morbi dictum nibh gravida</a> mi pretium dapibus. Nullam in est urna. In vitae adipiscing enim. Curabitur rhoncus condimentum lorem, non convallis dolor faucibus eget. In ut nulla est. Sed a interdum mauris. </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Fifth accordion -->
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                                            <h5><i class="icon-plus"></i> Nullam in urna est urna molestie gravida ?</h5>
                                        </a>
                                    </div>
                                    <div id="collapseFive" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            <p>Proin porttitor eros a ante molestie gravida commodo dui adipiscing. <a href="#">Morbi dictum nibh gravida</a> mi pretium dapibus. Nullam in est urna. In vitae adipiscing enim. Curabitur rhoncus condimentum lorem, non convallis dolor faucibus eget. In ut nulla est. Sed a interdum mauris. </p>
                                        </div>
                                    </div>
                                </div>

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

