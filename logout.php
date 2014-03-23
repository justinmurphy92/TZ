<?php
/**
 * Created by PhpStorm.
 * User: Howatt
 * Date: 17/03/14
 * Time: 5:43 PM
 * Destroy the session and redirect user to the main page.
 */
session_start();
session_destroy();
header('Location: index.php');
exit;