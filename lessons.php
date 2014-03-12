<?php
/**
 * Created by PhpStorm.
 * User: justinmurphy
 * Date: 3/6/2014
 * Time: 6:13 PM
 */
include('functions/header.php');
include('functions/footer.php');
include('functions/navbar.php');
include('functions/userProfile.php');

displayHeader('TutleZone - Lessons');
displayUserArea();
displayNavigation();
?>
<!-- Content strats -->

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-9">
                <div id='calendar'></div>
            </div>
            <div style=" margin-top:15px;" class="col-xs-6 col-md-3">
                <div class="main-box">
                    <h4>What a lovely legend box! </h4>
                    <p>Let's look at one of the features of TutleZone: </p>
                    <ul>
                        <li>feature #1</li>
                        <li>feature #2</li>
                        <li>feature #3</li>
                    </ul>
                </div>
            </div>
            <div style="margin-top:15px;" class="col-xs-6 col-md-3">
                <div class="main-box">
                    <h4>Maybe we can put some other swag here! </h4>
                    <p>Like Dragable Events?! </p>
                    <ul>
                        <li>feature #1</li>
                        <li>feature #2</li>
                        <li>feature #3</li>
                        <li>feature #1</li>
                        <li>feature #2</li>
                        <li>feature #3</li>
                        <li>feature #1</li>
                        <li>feature #2</li>
                        <li>feature #3</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content ends -->

<?php
displayFooter();
?>