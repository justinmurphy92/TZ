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
include('functions/database.php');

displayHeader('TutleZone - Lessons');
displayUserArea();
displayNavigation();
?>
<!-- Content strats -->
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
                    <h4>Your Match Legend</h4>
                    <p>Your schedule events (to the left) are colour coded based on your active matches </p>
                    <ul>
                        <?php
                        if (isset($_SESSION['USERID'])){
                            $db = connectToDB();
                            if ($db)
                            {
                                try{
                                    //perform query to get match list based on user access
                                    $matchSQL = "";
                                    if ($_SESSION['TYPECODE_ID'] == 1) {
                                        //student
                                        $matchSQL = "select match_id, match_colour, tutor_fname as 'fname', tutor_lname as 'lname' from matches JOIN tutor on tutor_userid = credentials_userid where student_userid =:userid";
                                    }
                                    elseif($_SESSION['TYPECODE_ID'] == 2) {
                                        // tutor
                                        $matchSQL = "select match_id, match_colour, student_fname as 'fname', student_lname as 'lname' from matches JOIN student on student_userid = credentials_userid where tutor_userid =:userid";
                                    }

                                    // if the sql isn't empty by now (not a tutor or student)
                                    if ($matchSQL != "")
                                    {
                                        $matchQuery = $db->prepare($matchSQL);
                                        $matchQuery->bindValue(':userid', $_SESSION['USERID']);

                                        // loop through result set, write an li for each found.
                                        if ($matchQuery->execute() && $matchQuery->rowCount() > 0){
                                            while ($row = $matchQuery->fetch(PDO::FETCH_ASSOC)) {
                                                // clear any saved matches
                                                unset($_SESSION['matches']);

                                                // store the matches in the session, as we'll need them again.
                                                $_SESSION['matches'][] = array('match_id' => $row['match_id'],
                                                                               'match_colour' => $row['match_colour'],
                                                                               'fname' => $row['fname'],
                                                                               'lname' => $row['lname']);
                                                echo "<li style='color:" . $row['match_colour'] . "'>" . $row['fname'] . " " . $row['lname'] . "</li>";
                                            }
                                        }
                                        else{
                                            echo "<li> No Matches :( </li>";
                                        }
                                    }

                                }
                                catch(Exception $e){
                                    echo "<li> Matches could not be loaded :( </li>";
                                }
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div style="margin-top:15px;" class="col-xs-6 col-md-3">
                <div class="main-box">
                    <h4>Lesson Options </h4>
                    <ul>
                        <li class="button"> Create/Schedule A New Lesson <br/> <a href="#" style="width:100%"> Create Lesson </a></li>
                        <li class="button"> Not Feeling Well? Take a Sick Day.  We'll cancel all your lessons for the day & notify the other party. <br/> <a href="#" style="width:100%"> I'm Sick! </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// we only want to allow tutors logged in & with available matches to create lessons.
if (isset($_SESSION['USERID']) && isset($_SESSION['matches']) && $_SESSION['TYPECODE_ID'] == 2) {
?>

<div id="dialog-form2" class="form" title="Update a Lesson">
        <p id="dialogPurpose"> Create a Lesson! </p>

        <form id="createForm" class="form-horizontal" method="POST" action="#">

            <!-- matches -->
            <div class="form-group">
                <label class="control-label col-md-3" for="matches">With whom?</label>
                <div class="col-md-9">
                    <select name="matchID" class="form-control" id="matchID">
                        <?php
                        foreach($_SESSION['matches'] as $thisMatch){
                            echo "<option value='" . $thisMatch['matchID'] . "'>" . $thisMatch['fname'] . " " . $thisMatch['lname'] . "</option>";
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

            <!-- length -->
            <div class="form-group">
                <label class="control-label col-md-4" for="length">Length: </label>
                <div class="col-md-8">
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
<!-- Content ends -->

<?php
displayFooter();
?>