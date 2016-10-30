<?php
ob_start(); // Turn on output buffering:

/* File Name: login.php

  Version 1_19
  CSC 478 Group Project
  Group: FanSports
  Wesley Elliot, Jeremy Jones, Ann Oesterle
  Last Updated: 10/17/2016 */

define('TITLE', 'Login');
define('CSS', 'formstyle');
include('templates/header.php'); // Include the header.
//
//-----Begin Changeable Content-----

/******************************************************************************/
/*************Change This to Fit MySql host************************************/
$servername = "localhost";
$username = "root";
$password = "wERCwbuER8dz";
$dbname = "fansportsdb";
/******************************************************************************/


//Check if form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ((!empty($_POST['userID'])) && (!empty($_POST['userPass']))) {//Check that both fields have been entered
        $userTestID = $_POST['userID'];
        $userTestPass = $_POST['userPass'];

        /**** BEGIN MYSQL ****/
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT userID, userPass FROM userinfo WHERE userID = '$userTestID'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) { //userID exists
            
            while ($row = $result->fetch_assoc()) {//put mysql data associated with the userTestID into a row
                
                
                    $_SESSION['userID'] = $_POST['userID']; //set the session variable userID to valid userID
                    $_SESSION['loggedin'] = time(); //basically sets loggedIn = TRUE, time() is a placeholder 
                    
                    if ($userTestPass == $row["userPass"]) { //test that the userPass matches the userID
                    
                    if (ob_get_contents()) ob_end_clean(); //clean buffer

                    header('Location: user_home.php'); //once logged in, redirect to user home
    
                    
                } else { //incorrect password
                    print '<p class = "error">That user Password is incorrect. Try again!</p>';
                }
            }
        } else { //no result found with that userID
            print '<p class = "error">That user ID has not been registered. Make sure you entered everything correctly</p>';
        }
        $conn->close();
        
        /****END MYSQL ****/
    } else { //if one of the fields is missing
        $_SESSION['loggedin'] = NULL; //set so that user is not logged in
        print '<p>Please make sure you enter both an userID address and a password!<br />Go back and try again.</p>';
    }
} else { //if form hasn't been printed yet
    print '
        <div class = "formCard">
        <form action="login.php" method="post" id="loginForm">
            <fieldset>
                <legend id = "loginLegend">Login</legend>
                <p>User ID: <input type="text" name="userID" id = "userID"></p>
                <p>User Password: <input type="text" name="userPass" id = "userPass"></p>
                <p><input type="submit" name="submit" value="Login!" id = "submitLogin"/></p>
            </fieldset>
        </form>
        </div>
        ';
}
include('templates/footer.php');
?>