<?php
/**
 * Created by PhpStorm.
 * User: justinmurphy
 * Date: 3/23/2014
 * Time: 11:14 PM
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

                <!-- Features starts -->

                <div class="feature-alt">
                    <div class="row">
                        <div class="col-md-12">

                            <?php

                            ?>
                            <!-- Features list. Note down the class name before editing. -->
                            <div class="row">
                                <div class="col-md-3 col-sm-6">
                                    <div class="afeature">
                                        <div class="afmatter">
                                            <i class="icon-cloud"></i>
                                            <h4>Nulla ullamcorper</h4>
                                            <p>Praesent at tellus porttitor  sagittis. Mauris tempor nulla. Ut tempus interdum mauris vel vehicula. </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
displayFooter(0);
?>