<?php
ob_start(); // Turn on output buffering:

/* File Name: league_info.php

  Version 1.0
  CSC 478 Group Project
  Group: FanSports
  Wesley Elliot, Jeremy Jones, Ann Oesterle
  Last Updated: 10/25/2016 by Annie Oesterle
 */

define('TITLE', 'Roster Information');
define('CSS', 'rosterstyle');
include('templates/header.php'); // Include the header.
?>
<!-- BEGIN CHANGEABLE CONTENT. -->

<!-- END CHANGEABLE CONTENT. -->
<?php
// Return to PHP.
include('templates/footer.php'); // Include the footer.
?>
