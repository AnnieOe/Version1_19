<?php
ob_start(); // Turn on output buffering:
/*File Name: logout.php

Version 1.0
CSC 478 Group Project
Group: FanSports
Wesley Elliot, Jeremy Jones, Ann Oesterle
Last Updated: 10/25/2016 by Annie Oesterle
*/
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

//Possibly change this later
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


