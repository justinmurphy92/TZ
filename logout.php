<?php
/**
 * Created by PhpStorm.
 * Programmer:  Adam Howatt
 * Analyst:     Justin Murphy
 *      DATE        INITIALS        CHANGES
 *      03/06/2014  AH              INITIAL CREATION
 *
 * DESCRIPTION:
 * DESTROY THE SESSION AND REDIRECT USER TO THE MAIN PAGE (INDEX.PHP)
 */
session_start();
session_destroy();
header('Location: index.php');
exit;