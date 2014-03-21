<?php
/**
 * Created by PhpStorm.
 * User: Howatt
 * Date: 20/03/14
 * Time: 10:17 PM
 * This file exists to load each of the code tables into session scope, so they can be used throughout the website.
 */
session_start();
include 'database.php';

function loadSubjects() {
    // check to see if they have been loaded.
    if (!isset($_SESSION['subjects'])) {
        $db = connectToDB();
        if ($db)
        {
            try{
                //try the update
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
                    return true;
                }

            }
            catch(Exception $e){
                // just incase, return false on any errors.
                return false;
            }
        }
    } else {
        // they are already loaded.
        return true;
    }
}
