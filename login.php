<?php
ob_start(); // Turn on output buffering:
/* File Name: login.php

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
//
//Check if form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if ((!empty($_POST['userID'])) && (!empty($_POST['userPass']))) { //Check that both fields have been entered
    $userTestID = $_POST['userID'];
    $userTestPass = $_POST['userPass'];
    /*     * ** BEGIN MYSQL *** */
    // Create connection
    try {
      $conn = new PDO("mysql:host=localhost;dbname=userdb", $usrDBName, $usrDBPass);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected successfully";
    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
    include 'userDBhandler.php';
    
    
    /* ---------------TO DO--------------- */
    $userDBhandler = new loginHandler($pdo); //create an instance of the user DB handler class
    $numResults = count($userDBhandler->checkLogin($userTestID)); //check if username is found by number of results.
    $userResults = $userDBhandler->checkLogin($userTestID); //store result in an array
    if ($numResults > 0) { //userID exists
      $passResult = $userDBhandler->checkPass($userTestID);
      if ($userTestPass == $passResult["userPass"]) { //test that the userPass matches the userID
        $_SESSION['userID'] = $_POST['userID']; //set the session variable userID to valid userID
        $_SESSION['loggedin'] = time(); //basically sets loggedIn = TRUE, time() is a placeholder 

        if (ob_get_contents())
          ob_end_clean(); //clean buffer
        header('Location: user_home.php'); //once logged in, redirect to user home
      }
      
      
      
      
      
      else { //incorrect password
        //Note: I decided to print the form again with an error message rather than using javascript
        print '
        <div class = "formCard">
        <form action="login.php" method="post" id="loginForm">
        <h1 class = "legend">Login</h1>
          <ul>
            <li class = "formLabel"><label for = "userID">User ID: </label></li>
            <li><input type="text" name="userID" id = "userID"  required></li>
            <li class = "formLabel"><label for = "userPass">Password: </label></li>
            <li><input type="text" name="userPass" id = "userPass"  required></li>
            <li><p class = "errorMsg" id = "errorPass">Credentials submitted are not valid. Try again!</p></li>
            
          </ul>
          <input type="submit" value="Submit" class = "formButton" id = "formButton">
            
        </form>
        </div>
        ';
      }
    } else { //no result found with that userID
      print '
        <div class = "formCard">
        <form action="login.php" method="post" id="loginForm">
        <h1 class = "legend">Login</h1>
          <ul>
            <li class = "formLabel"><label for = "userID">User ID: </label></li>
            <li><input type="text" name="userID" id = "userID"  required></li>
            <li class = "formLabel"><label for = "userPass">Password: </label></li>
            <li><input type="text" name="userPass" id = "userPass"  required></li>
            <li><p class = "errorMsg" id = "errorPass">Credentials submitted are not valid. Try again!</p></li>
            
          </ul>
          <input type="submit" value="Submit" class = "formButton" id = "formButton">
            
        </form>
        </div>
        ';
    }

    /*     * **END MYSQL *** */
  } else { //if one of the fields is missing
    $_SESSION['loggedin'] = NULL; //set so that user is not logged in
    print '
        <div class = "formCard">
        <form action="login.php" method="post" id="loginForm">
        <h1 class = "legend">Login</h1>
          <ul>
            <li class = "formLabel"><label for = "userID">User ID: </label></li>
            <li><input type="text" name="userID" id = "userID"  required></li>
            <li class = "formLabel"><label for = "userPass">Password: </label></li>
            <li><input type="text" name="userPass" id = "userPass"  required></li>
            <li><p class = "errorMsg" id = "errorPass">Both fields are required</p></li>
            
          </ul>
          <input type="submit" value="Submit" class = "formButton" id = "formButton">
            
        </form>
        </div>
        ';
  }
} else { //if form hasn't been printed yet
  print '
        <div class = "formCard">
        <form action="login.php" method="post" id="loginForm">
        <h1 class = "legend">Login</h1>
          <ul>
            <li class = "formLabel"><label for = "userID">User ID: </label></li>
            <li><input type="text" name="userID" id = "userID"  required></li>
            <li class = "formLabel"><label for = "userPass">Password: </label></li>
            <li><input type="text" name="userPass" id = "userPass"  required></li>
            <li><p class = "errorMsg" id = "errorPass">&nbsp;</p></li>
            
          </ul>
          <input type="submit" value="Submit" class = "formButton" id = "formButton">
            
        </form>
        </div>
        ';
}
include('templates/footer.php');
?>
