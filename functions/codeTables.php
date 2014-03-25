<?php
/**
 * Programmer:  Adam Howatt
 * Analyst:     Justin Murphy
 *      DATE        INITIALS        CHANGES
 *      03/20/2014  AH              INITIAL CREATION
 *      03/21/2014  AH              ADDED LOAD MATCHES
 *
 * This file exists to load each of the code tables into session scope, so they can be used throughout the website.
 */

function loadMatches() {
    if (isset($_SESSION['USERID'])){
        if (!isset($_SESSION['matches']) || (time() - $_SESSION['matchesSet']) / 60 > 60) {
            $db = connectToDB();
            if ($db)
            {
                try{
                    //perform query to get match list based on user access
                    $matchSQL = "";
                    if ($_SESSION['TYPECODE_ID'] == 1) {
                        //student
                        $matchSQL = "select match_id, match_colour, tutor_fname as 'fname', tutor_lname as 'lname', credentials_userid from matches JOIN tutor on tutor_userid = credentials_userid where student_userid =:userid";
                    }
                    elseif($_SESSION['TYPECODE_ID'] == 2) {
                        // tutor
                        $matchSQL = "select match_id, match_colour, student_fname as 'fname', student_lname as 'lname', credentials_userid from matches JOIN student on student_userid = credentials_userid where tutor_userid =:userid";
                    }

                    // if the sql isn't empty by now (not a tutor or student)
                    if ($matchSQL != "")
                    {
                        $matchQuery = $db->prepare($matchSQL);
                        $matchQuery->bindValue(':userid', $_SESSION['USERID']);
                        // clear any saved matches
                        $_SESSION['matches'] = null;

                        // loop through result set, write an li for each found.
                        if ($matchQuery->execute() && $matchQuery->rowCount() > 0){
                            while ($row = $matchQuery->fetch(PDO::FETCH_ASSOC)) {

                                // store the matches in the session, as we'll need them again.
                                $_SESSION['matches'][] = array('match_id' => $row['match_id'],
                                    'match_colour' => $row['match_colour'],
                                    'fname' => $row['fname'],
                                    'lname' => $row['lname'],
                                    'match_userid' => $row['credentials_userid']);

                            }
                            // if it got here, everything worked well.  set the time.
                            $_SESSION['matchesSet'] = time();
                            return true;
                        }
                        else{
                            // no matches
                            return false;
                        }
                    }

                }
                catch(Exception $e){
                    // matches not loaded successfully (Db issue)
                    return false;
                }
            }
        }
        else {
            // sessions were already within the session & have a valid time.
            return true;
        }


    }
    // return false if the user isn't logged in.
    return false;
}

// loads all subjects into session scope, for use in forms throughout the site.
function loadSubjects() {
    // check to see if they have been loaded.
    if (!isset($_SESSION['subjects']) || (time() - $_SESSION['subjectsSet']) / 60 > 120) {
        $db = connectToDB();
        if ($db)
        {
            try{
                //try the update
                $_SESSION['subjects'] = null;

                $sql = "SELECT * FROM subject order by subject_name";
                $query = $db->query($sql);
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    // load the subjects into session scope.
                    $_SESSION['subjects'][] = array('id'=> $row['subject_id'],
                                                    'name'=>$row['subject_name'],
                                                    'desc'=>$row['subject_desc']);
                }

                if (count($_SESSION['subjects']) > 0)
                {
                    // if at least one subject has been loaded, return true, making them available to all.
                    // set a timestamp so they can be reloaded appropriately.
                    $_SESSION['subjectsSet'] = time();
                    return true;
                }

            }
            catch(Exception $e){
                // just in case, return false on any errors.
                return false;
            }
        }
    } else {
        // they are already loaded.
        return true;
    }
}

// loads all lesson statuses into session scope, for use in forms throughout the site.
function loadLessonStatus() {
    // check to see if they have been loaded.
    if (!isset($_SESSION['lesson_status']) || (time() - $_SESSION['lesson_status_set']) / 60 > 120) {
        $db = connectToDB();
        if ($db)
        {
            try{
                //default to null (avoids duplication on reload)
                $_SESSION['lesson_status'] = null;

                // load only the active statuses (incase they change)
                $sql = "SELECT * FROM statuscode where statuscode_active = true order by statuscode_abbr";
                $query = $db->query($sql);
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    // load the lesson statuses into session scope.
                    $_SESSION['lesson_status'][] = array('id'=> $row['statuscode_id'],
                        'name'=>$row['statuscode_abbr'],
                        'desc'=>$row['statuscode_desc']);
                }

                if (count($_SESSION['lesson_status']) > 0)
                {
                    // if at least one status has been loaded, return true, making them available to all.
                    // set a timestamp so they can be reloaded appropriately.
                    $_SESSION['lesson_status_set'] = time();
                    return true;
                }

            }
            catch(Exception $e){
                // just in case, return false on any errors.
                return false;
            }
        }
    } else {
        // they are already loaded.
        return true;
    }
}
