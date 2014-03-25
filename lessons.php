<?php
/**
 * Programmer:  Adam Howatt
 * Analyst:     Justin Murphy
 *      DATE        INITIALS        CHANGES
 *      03/06/2014  AH              INITIAL CREATION
 *      03/12/2014  ah              ADDED JQUERY EVENTS
 *
 * DESCRIPTION:
 * THIS PAGE HANDLES THE LESSON SECTION.
 */
include('functions/header.php');
include('functions/footer.php');
include('functions/navbar.php');
include('functions/userProfile.php');
include('functions/database.php');
include('functions/codeTables.php');

displayHeader('TutleZone - Lessons');
displayUserArea();
displayNavigation();
?>
<!-- Content starts -->

<!-- This is the dialog box for updating lessons (when the user clicks on an event in the calendar).
It is hidden by  default -->

<div id="dialog-form" class="form" title="Update a Lesson">
    <p id="dialogPurpose"> Update a Lesson! </p>

    <form id="updateForm" class="form-horizontal" method="POST" action="#">

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

        <!-- subjets -->
        <div class="form-group">
            <label class="control-label col-md-3" for="subjects">Subject</label>
            <div class="col-md-9">
                <select name="subjectID" class="form-control" id="subjectID">
                    <?php
                    if (loadSubjects()){
                        foreach($_SESSION['subjects'] as $thisSubject){
                            echo "<option value='" . $thisSubject['id'] . "'>" . $thisSubject['name'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
        </div>

        <!-- length -->
        <div class="form-group">
            <label class="control-label col-md-3" for="length">Length: </label>
            <div class="col-md-9">
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

        <!-- Lesson Status -->
        <div class="form-group">
            <label class="control-label col-md-3" for="status">Lesson Status</label>
            <div class="col-md-9">
                <select name="status" class="form-control" id="status">
                    <?php
                    if (loadLessonStatus()){
                        foreach($_SESSION['lesson_status'] as $thisStatus){
                            echo "<option value='" . $thisStatus['id'] . "'>" . $thisStatus['name'] . "</option>";
                        }
                    }
                    ?>
                </select>
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

<!-- This is the dialog box for CREATING lessons (when the user clicks on the create lesson link along the right).
It is hidden by  default.  Only tutors can create new lessons. -->
<?php
// we only want to allow tutors logged in & with available matches to create lessons.
if (isset($_SESSION['USERID']) && isset($_SESSION['matches']) && $_SESSION['TYPECODE_ID'] == 2 && loadSubjects()) {
    ?>

    <div id="dialog-form2" class="form" title="Create a Lesson">
        <p id="dialogPurpose"> Create a Lesson! </p>

        <form id="createForm" class="form-horizontal" method="POST" action="#">

            <!-- matches -->
            <div class="form-group">
                <label class="control-label col-md-3" for="matches">With?</label>
                <div class="col-md-9">
                    <select name="lessonMatchID" class="form-control" id="lessonMatchID">
                        <?php
                        foreach($_SESSION['matches'] as $thisMatch){
                            echo "<option value='" . $thisMatch['match_id'] . "'>" . $thisMatch['fname'] . " " . $thisMatch['lname'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <!-- title -->
            <div class="form-group">
                <label class="control-label col-md-3" for="title">Title</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="lessonTitle" name="lessonTitle">
                </div>
            </div>

            <!-- date -->
            <div class="form-group">
                <label class="control-label col-md-3" for="date">Date</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="lessonDate" name="lessonDate">
                </div>
            </div>

            <!-- subjects -->
            <div class="form-group">
                <label class="control-label col-md-3" for="subjects">Subject</label>
                <div class="col-md-9">
                    <select name="lessonSubjectID" class="form-control" id="lessonSubjectID">
                        <?php
                        if (loadSubjects()){
                            foreach($_SESSION['subjects'] as $thisSubject){
                                echo "<option value='" . $thisSubject['id'] . "'>" . $thisSubject['name'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <!-- length -->
            <div class="form-group">
                <label class="control-label col-md-3" for="length">Length: </label>
                <div class="col-md-9">
                    <input type="number" class="form-control" id="lessonLength" name="lessonLength">
                </div>
            </div>

            <!-- location -->
            <div class="form-group">
                <label class="control-label col-md-3" for="location">Location</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="lessonLocation" name="lessonLocation">
                </div>
            </div>

            <!-- Lesson Status -->
            <div class="form-group">
                <label class="control-label col-md-3" for="status">Lesson Status</label>
                <div class="col-md-9">
                    <select name="lessonStatus" class="form-control" id="lessonStatus">
                        <?php
                        if (loadLessonStatus()){
                            foreach($_SESSION['lesson_status'] as $thisStatus){
                                echo "<option value='" . $thisStatus['id'] . "'>" . $thisStatus['name'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <!-- comments -->
            <div class="form-group">
                <label class="control-label col-md-3" for="comments">Comments</label>
                <div class="col-md-9">
                    <textarea class="form-control" name="lessonComments" id="lessonComments"></textarea>
                </div>
            </div>

            <!-- desc -->
            <div class="form-group">
                <label class="control-label col-md-3" for="desc">Description</label>
                <div class="col-md-9">
                    <textarea class="form-control" name="lessonDesc" id="lessonDesc"></textarea>
                </div>
            </div>
        </form>
    </div>

<?php
} // end lesson create
?>

    <!-- This is the dialog box for taking sick days.  Only those logged in can take sick days. -->
<?php
// we only want to allow students/tutors who are logged in the acccess to do this.
if (isset($_SESSION['USERID'])) {
    ?>

    <div id="sickday" class="form" title="Take a Sick Day">
        <p id="dialogPurpose"> Taking a sick day cancels all of your lessons for the day & notifies the other parties involved in each lesson.
        <strong>This cannot be undone.</strong>  </p>
        <p>  By entering a message using the box provided below, you are able to customize your message.  This might be a good place to alert your student/tutor when a good time to reschedule might be.</p>


        <form id="sickForm" class="form-horizontal" method="POST" action="#">

            <!-- message -->
            <div class="form-group">
                <label class="control-label col-md-3" for="sickMessage">Customized Sick Message</label>
                <div class="col-md-9">
                    <textarea class="form-control" name="sickMessage" id="sickMessage"></textarea>
                </div>
            </div>

            <!-- confirmation checkbox -->
            <div class="form-group">
                <div class="col-md-7  col-md-offset-3">
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox1" value="Yes" name="sickConfirm"/> Are you <strong> ABSOLUTELY </strong> sure?
                    </label>
                </div>
            </div>

        </form>
    </div>

<?php
} // end sick day
?>

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-9">
                <div id='calendar'></div>
            </div>
            <div style=" margin-top:15px;" class="col-xs-6 col-md-3">
                <div class="main-box">
                    <h4>Your Match Legend</h4>
                    <p>Your schedule events (to the left) are colour coded based on your active matches </p>
                    <ul>
                        <?php
                         if (loadMatches()){
                                 foreach($_SESSION['matches'] as $thisMatch){
                                     echo "<li style='color:" . $thisMatch['match_colour'] . "'>" . $thisMatch['fname'] . " " . $thisMatch['lname'] . "</li>";
                                 }
                             } else {
                             echo "<li> No Matches :( </li>";
                         }
                        ?>
                    </ul>
                </div>
            </div>
            <div style="margin-top:15px;" class="col-xs-6 col-md-3">
                <div class="main-box">
                    <h4>Lesson Options </h4>
                    <ul>
                        <?php // only tutors can create lessons
                        if (isset($_SESSION['TYPECODE_ID']) && $_SESSION['TYPECODE_ID'] == 2) { ?>
                        <li class="button"> Create/Schedule A New Lesson <br/> <a id="newLessonLink" style="width:100%"> Create Lesson </a></li>
                        <?php }
                        // only those logged in can take sick days.
                        if (isset($_SESSION['USERID'])) {
                        ?>
                        <li class="button"> Not Feeling Well? Take a Sick Day.  We'll cancel all your lessons for the day & notify the other parties. Lessons with a red border are "cancelled"<br/> <a id="sickDayLink" style="width:100%"> I'm Sick! </a></li>
                        <?php
                        }
                        ?>
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