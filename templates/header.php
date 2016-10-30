<?php
session_start(); //start session on each page
//error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);
if (!isset($_SESSION['loggedin'])) {
    /* Not logged in */
    /* Clicking on the logo sends user to index.php */
    $session = FALSE;
    print '<p>not logged in</p>';
} else {
    $session = TRUE;
    /* Logged in */
    /* Clicking on the logo sends user to userhome.php */
    print '<p>logged in</p>';
}
?>
<!--File Name: header.php

Version 1_18
CSC 478 Group Project
Group: FanSports
Wesley Elliot, Jeremy Jones, Ann Oesterle
Last Updated: 10/15/2016

-->
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"/>

<head>
    <meta charset="utf-8">
        <title>
            <?php
            // Print the page title.
            if (defined('TITLE')) { // Is the title defined?
                print TITLE;
            } else { // The title is not defined.
                print 'FanSports Website';
            }
            ?>
        </title>

        <!--Backwards compatible with browsers-->
        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->


        <?php
        $css = "css/" . CSS . ".css";
        print ' <link rel="stylesheet" href=" ' . $css . ' "> ';
        ?>
</head>
<body>

    <header role = "header" class = "verticalHeader">

        <?php
        /* Here you check if the session variable has been set. If
         * it has not been set, then we know the user is not logged on */
        if ($session === FALSE) {
            /* Not logged in */
            /* Clicking on the logo sends user to index.php */
            print '<a href = "index.php"><img class = "logo" src = "pictures/logo3.jpg"> </a>';
        } else {
            /* Logged in */
            /* Clicking on the logo sends user to userhome.php */
            print '<a href = "user_home.php"><img class = "logo" src = "pictures/logo3.jpg"> </a>';
        }
        ?>

        <a href = "logout.php"><p class ="logout">Logout</p></a>
    </header>
    <main>
        <div class = "container">
            <!-- BEGIN CHANGEABLE CONTENT. -->