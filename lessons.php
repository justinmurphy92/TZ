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
<div id="dialog-form" class="form" title="Create new user">
    <p id="dialogPurpose"> Update a Lesson! </p>

    <form id="updateForm" class="form-horizontal" method="POST" action="AHahahahaha">

        <input type="hidden" name="lessonID" id="lessonID" value="">

        <input type="hidden" name="matchID" id="matchID" value="">

        <!-- title -->
        <div class="form-group">
            <label class="control-label col-md-3" for="title">Title</label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="title" name="title">
            </div>
        </div>

        <!-- date -->
        <div class="form-group">
            <label class="control-label col-md-3" for="date">Date</label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="date" name="date">
            </div>
        </div>

        <!-- length -->
        <div class="form-group">
            <label class="control-label col-md-4" for="length">Length: </label>
            <div class="col-md-8">
                <input type="number" class="form-control" id="length" name="length">
            </div>
        </div>

        <!-- location -->
        <div class="form-group">
            <label class="control-label col-md-3" for="location">Location</label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="location" name="location">
            </div>
        </div>

        <!-- comments -->
        <div class="form-group">
            <label class="control-label col-md-3" for="comments">Comments</label>
            <div class="col-md-9">
                <textarea class="form-control" name="comments" id="comments"></textarea>
            </div>
        </div>

        <!-- desc -->
        <div class="form-group">
            <label class="control-label col-md-3" for="desc">Description</label>
            <div class="col-md-9">
                <textarea class="form-control" name="desc" id="desc"></textarea>
            </div>
        </div>
    </form>
</div>

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