<?php

ob_start(); // Turn on output buffering:
/* File Name: register.php

  Version 1.0
  CSC 478 Group Project
  Group: FanSports
  Wesley Elliot, Jeremy Jones, Ann Oesterle
  Last Updated: 10/25/2016 by Annie Oesterle
 */
define('TITLE', 'Login');
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
  if ((!empty($_POST['userID'])) && (!empty($_POST['userPass'])) && (!empty($_POST['userPass2']))) {

    if ($_POST['userPass'] != $_POST['userPass2']) {
      $problem = TRUE;
      print '
        <div class = "formCard">
        <form action="register.php" method="post" id="registerForm">
        <h1 class = "legend">Register</h1>
          <ul>
            <li class = "formLabel"><label for = "userID">User ID: </label></li>
            <li><input type="text" name="userID" id = "userID"  required></li>
            <li class = "formLabel"><label for = "userPass">Password: </label></li>
            <li><input type="text" name="userPass" id = "userPass"  required></li>
            <li class = "formLabel"><label for = "userPass2">ConfirmPassword: </label></li>
            <li><input type="text" name="userPass2" id = "userPass2"  required></li>
            <li><p class = "errorMsg" id = "errorPass">Your password did not match your confirmed password!</p></li>
            
          </ul>
          <input type="submit" value="Submit" class = "formButton" id = "formButton">
            
        </form>
        </div>
        ';

    //-------TO DO -------
    } else if (!$problem) { // If there weren't any problems...
      // clean user inputs to prevent sql injections
      $userID = trim($_POST['userID']);
      $userID = strip_tags($userID);
      $userID = htmlspecialchars($userID);
      $_SESSION['userID'] = $userID;
      $userPass = trim($_POST['userPass']);
      $userPass = strip_tags($userPass);
      $userPass = htmlspecialchars($userPass);
      $userPass = password_hash($userPass, PASSWORD_DEFAULT); //hash the password
      $_SESSION['loggedin'] = time(); //set that the user has been logged in...time() is just a placeholder any value but NULL works
      // Create connection
      try {
        $pdo = new PDO("mysql:host=localhost; dbname=userdb; charset=utf8mb4_unicode_ci", $usrDBName, $usrDBPass); //connect to userdb
      } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
      }
      //add new values (created by registration) for userID and userPass to userinfo table
      $userDBhandler = new userDBhandler($pdo); //create an instance of the user DB handler class
      $userDBhandler->registerUser($userID, $userPass);
      if (ob_get_contents())
        ob_end_clean(); //clean buffer
    }
    
    
    
    
    
  } else { // Forgot a field.
    print '
        <div class = "formCard">
        <form action="register.php" method="post" id="registerForm">
        <h1 class = "legend">Register</h1>
          <ul>
            <li class = "formLabel"><label for = "userID">User ID: </label></li>
            <li><input type="text" name="userID" id = "userID"  required></li>
            <li class = "formLabel"><label for = "userPass">Password: </label></li>
            <li><input type="text" name="userPass" id = "userPass"  required></li>
            <li class = "formLabel"><label for = "userPass2">Confirm Password: </label></li>
            <li><input type="text" name="userPass2" id = "userPass2"  required></li>
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
        <form action="register.php" method="post" id="registerForm">
        <h1 class = "legend">Register</h1>
          <ul>
            <li class = "formLabel"><label for = "userID">User ID: </label></li>
            <li><input type="text" name="userID" id = "userID"  required></li>
            <li class = "formLabel"><label for = "userPass">Password: </label></li>
            <li><input type="text" name="userPass" id = "userPass"  required></li>
            <li class = "formLabel"><label for = "userPass2">Confirm Password: </label></li>
            <li><input type="text" name="userPass2" id = "userPass2"  required></li>
            <li><p class = "errorMsg" id = "errorPass">&nbsp;</p></li>
            
          </ul>
          <input type="submit" value="Submit" class = "formButton" id = "formButton">
            
        </form>
        </div>
        ';
}
include('templates/footer.php');
?>