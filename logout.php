<?php
ob_start(); // Turn on output buffering:

/* File Name: logout.php

  Version 1_18
  CSC 478 Group Project
  Group: FanSports
  Wesley Elliot, Jeremy Jones, Ann Oesterle
  Last Updated: 10/15/2016 */

define('TITLE', 'Logout');
define('CSS', 'formstyle');
include('templates/header.php'); // Include the header.
//
//-----Begin Changeable Content-----
//
// Reset the session array:
$_SESSION = array();

// Destroy the session data on the server:
session_destroy();

$_SESSION['loggedin'] = NULL;//make sure the user is logged out
$session = $_SESSION['loggedin'];

//if (ob_get_contents()) ob_end_clean(); //clean buffer

//header('Location: user_home.php'); //once logged in, redirect to user home

//
//FIX THIS LATER: logging out works, but need to reprint header template in order to get logo to take you to correct place
//FIX THIS LATER: logging out clears session but clicking on logo still takes you to user_home, although at user_home $_SESSION['loggedin'] = NULL;/ 
//
//print the html code
print "Session: $session";
print '
    <div class ="formCard">
        <p>You are now logged out.</p>
        <p>Thank you for using this site. We hope that you liked it.</p>
        <a href = "index.php">Return</a>
    </div>
   ';

include('templates/footer.php'); //include footer
?>


