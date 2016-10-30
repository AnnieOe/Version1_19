<?php

ob_start(); // Turn on output buffering:
/* File Name: create.php

  Version 1.0
  CSC 478 Group Project
  Group: FanSports
  Wesley Elliot, Jeremy Jones, Ann Oesterle
  Last Updated: 10/25/2016 by Annie Oesterle
 */
define('TITLE', 'Create');
define('CSS', 'formstyle');
include('templates/header.php'); // Include the header.
//
//-----Begin Changeable Content-----
$usrDBName = 'root'; //username for db on server
$usrDBPass = 'wERCwbuER8dz'; //pw for db on server
include 'userDBhandler.php';


//Check if form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $problem = FALSE; // No problems so far.
  if ((!empty($_POST['leagueID'])) && (!empty($_POST['leaguePass'])) && (!empty($_POST['leaguePass2']))) {

    if ($_POST['leaguePass'] != $_POST['leaguePass2']) {
      $problem = TRUE;
      print '
        <div class = "formCard">
        <form action="create.php" method="post" id="createForm">
        <h1 class = "legend">Create a League</h1>
          <ul>
            <li class = "formLabel"><label for = "leagueID">League ID: </label></li>
            <li><input type="text" name="leagueID" id = "leagueID"  required></li>
            <li class = "formLabel"><label for = "leaguePass">Password: </label></li>
            <li><input type="text" name="leaguePass" id = "leaguePass"  required></li>
            <li class = "formLabel"><label for = "leaguePass2">Confirm Password: </label></li>
            <li><input type="text" name="leaguePass2" id = "leaguePass2"  required></li>
            <li><p class = "errorMsg" id = "errorPass">Your password did not match your confirmed password!</p></li>
            
          </ul>
          <input type="submit" value="Submit" class = "formButton" id = "formButton">
            
        </form>
        </div>
        ';

    //-------TO DO -------
    } else if (!$problem) { // If there weren't any problems...
      // clean user inputs to prevent sql injections
      $leagueID = trim($_POST['leagueID']);
      $leagueID = strip_tags($leagueID);
      $leagueID = htmlspecialchars($leagueID);
      $_SESSION['leagueID'] = $leagueID;
      $leaguePass = trim($_POST['leaguePass']);
      $leaguePass = strip_tags($leaguePass);
      $leaguePass = htmlspecialchars($leaguePass);
      $leaguePass = password_hash($leaguePass, PASSWORD_DEFAULT); //hash the password
      $_SESSION['loggedin'] = time(); //set that the user has been logged in...time() is just a placeholder any value but NULL works
      // Create connection
      try {
        $pdo = new PDO("mysql:host=localhost; dbname=userdb; charset=utf8mb4_unicode_ci", $usrDBName, $usrDBPass); //connect to userdb
      } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
      }
      //add new values (created by registration) for leagueID and leaguePass to userinfo table
      $userDBhandler = new userDBhandler($pdo); //create an instance of the user DB handler class
      $userDBhandler->registerUser($leagueID, $leaguePass);
      if (ob_get_contents())
        ob_end_clean(); //clean buffer
    }
    
    
    
    
    
  } else { // Forgot a field.
    print '
        <div class = "formCard">
        <form action="register.php" method="post" id="createForm">
        <h1 class = "legend">Create a League</h1>
          <ul>
            <li class = "formLabel"><label for = "leagueID">User ID: </label></li>
            <li><input type="text" name="leagueID" id = "leagueID"  required></li>
            <li class = "formLabel"><label for = "leaguePass">Password: </label></li>
            <li><input type="text" name="leaguePass" id = "leaguePass"  required></li>
            <li class = "formLabel"><label for = "leaguePass2">Confirm Password: </label></li>
            <li><input type="text" name="leaguePass2" id = "leaguePass2"  required></li>
            <li><p class = "errorMsg" id = "errorPass">All fields are requried</p></li>
            
          </ul>
          <input type="submit" value="Submit" class = "formButton" id = "formButton">
            
        </form>
        </div>
        ';
  }
} else { //if form hasn't been printed yet
  print '
        <div class = "formCard">
        <form action="create.php" method="post" id="createForm">
        <h1 class = "legend">Create a League</h1>
          <ul>
            <li class = "formLabel"><label for = "leagueID">User ID: </label></li>
            <li><input type="text" name="leagueID" id = "leagueID"  required></li>
            <li class = "formLabel"><label for = "leaguePass">Password: </label></li>
            <li><input type="text" name="leaguePass" id = "leaguePass"  required></li>
            <li class = "formLabel"><label for = "leaguePass2">Confirm Password: </label></li>
            <li><input type="text" name="leaguePass2" id = "leaguePass2"  required></li>
            <li><p class = "errorMsg" id = "errorPass">&nbsp;</p></li>
            
          </ul>
          <input type="submit" value="Submit" class = "formButton" id = "formButton">
            
        </form>
        </div>
        ';
}
include('templates/footer.php');
?>