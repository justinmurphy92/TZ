<?php
/**
 * Created by PhpStorm.
 * User: Howatt
 * Date: 06/03/14
 * Time: 6:07 PM
 * Purpose:
 * Prints out the header of the page, replacing the title with the passed value.
 * Includes various CSS & JS files
 * Ensures consistency throughout the site.
 */
session_start();
function displayHeader($title = "TutleZone") {
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <!-- Title -->
        <title> <?php echo $title; ?> </title>
        <!-- Description, Keywords -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">

        <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Oswald:400,700' rel='stylesheet' type='text/css'>

        <!-- Stylesheets -->
        <link href="style/smoothness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">
        <link href="style/bootstrap.css" rel="stylesheet">
        <link href="style/slider.css" rel="stylesheet">
        <link href="style/prettyPhoto.css" rel="stylesheet">
        <link rel="stylesheet" href="style/font-awesome.css">
        <link rel="stylesheet" href="style/fullcalendar.css">
        <link rel="stylesheet" media="print" href="style/fullcalendar.print.css">
        <!--[if IE 7]>
        <link rel="stylesheet" href="style/font-awesome-ie7.css">
        <![endif]-->
        <link href="style/style.css" rel="stylesheet">
        <!-- Color Stylesheet - orange, blue, pink, brown, red or green-->
        <link href="style/orange.css" rel="stylesheet">


        <!-- HTML5 Support for IE -->
        <!--[if lt IE 9]>
        <script src="js/html5shim.js"></script>
        <![endif]-->

        <!-- Favicon -->
        <link rel="shortcut icon" href="img/favicon/favicon.ico">
    </head>
<body>

<?php
} // end header function
if(isset($_GET['error'])){
    switch($_GET['error']){
        case 1:
            echo "<script>alert('Invalid Username or Password')</script>";
            break;
        case 2:
            "<script>alert('Make sure to fill out all required fields!')</script>";
            break;
        case 3:
            "<script>alert('Things to check: \n 1) All fields are full \n 2)Passwords match \n 3)email is valid')</script>";
            break;

    }
}
?>