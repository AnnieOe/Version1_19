<?php
session_start(); //start session on each page
//error reporting, turn off for final implementation
ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);
if (!isset($_SESSION['loggedin'])) {
  /* Not logged in */
  /* Clicking on the logo sends user to index.php */
  $session = FALSE;
} else {
  $session = TRUE;
  /* Logged in */
  /* Clicking on the logo sends user to userhome.php */
}
?>
<!--File Name: header.php

Version 1.0
CSC 478 Group Project
Group: FanSports
Wesley Elliot, Jeremy Jones, Ann Oesterle
Last Updated: 10/25/2016 by Annie Oesterle

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

    <!--Include whichever stylesheet is relevant-->
    <?php
    $css = "css/" . CSS . ".css";
    print ' <link rel="stylesheet" href=" ' . $css . ' "> ';
    ?>
</head>
<body>

  <header role = "header" class = "verticalHeader">
    <div class ="verticalHeader_top">
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
      <a href = "user_home.php"><p class ="homeLink">home</p></a>
      <a href = "logout.php"><p class ="logoutLink">logout</p></a>
    </div>
    
    <!--<div class ="verticalHeader_spacer">-->
    <div class ="verticalHeader_info"><!--Contains informatino about app-->
      <p>Created By: Wesley Elliot, Jeremy Jones, Ann Oesterle</p>
                <a href = "logout.php" class ="aboutLink"><p >about</p></a>
                <small><a rel="license" class = "license" href="http://creativecommons.org/licenses/by/4.0/">This work is licensed under a Creative Commons Attribution 4.0 International License</a></small>
                <a rel="license"href="http://creativecommons.org/licenses/by/4.0/"><img alt="Creative Commons License" class = "ccimage" src="pictures/ccimage2.jpg" /></a>
    </div><!--END appinfo div-->
                </header>
  <!--<div class ="verticalHeader_block"></div>-->
                <main>
                  <!--<div class = "container">-->
                    <!-- BEGIN CHANGEABLE CONTENT. -->