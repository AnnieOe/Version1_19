<?php

ob_start(); // Turn on output buffering:

/* File Name: register.php

  Version 1_19
  CSC 478 Group Project
  Group: FanSports
  Wesley Elliot, Jeremy Jones, Ann Oesterle
  Last Updated: 10/17/2016 */

define('TITLE', 'Register');
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
    $problem = FALSE; // No problems so far.
    // Check for each value...
    if (empty($_POST['userID'])) {
        $problem = TRUE;
        print '<p class="error">Please enter a username!</p>';
    }

    if (empty($_POST['userPass'])) {
        $problem = TRUE;
        print '<p class="error">Please enter a password!</p>';
    }

    if ($_POST['userPass'] != $_POST['userPass2']) {
        $problem = TRUE;
        print '<p class="error">Your password did not match your confirmed password!</p>';
    }

    if (!$problem) { // If there weren't any problems...
        // clean user inputs to prevent sql injections
        $userID = trim($_POST['userID']);
        $userID = strip_tags($userID);
        $userID = htmlspecialchars($userID);
        $_SESSION['userID'] = $userID;

        $userPass = trim($_POST['userPass']);
        $userPass = strip_tags($userPass);
        $userPass = htmlspecialchars($userPass);
        $_SESSION['userPass'] = $userPass;

        $_SESSION['loggedin'] = time(); //set that the user has been logged in...time() is just a placeholder any value but NULL works
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        //add new values (created by registration) for userID and userPass to userinfo table
        $sql = "INSERT INTO userinfo (userID, userPass)
            VALUES ('$userID', '$userPass')";
        $conn->query($sql);
//      if ($conn->query($sql) === TRUE) {
//            echo "New record created successfully";
//        } else {
//          echo "Error: " . $sql . "<br>" . $conn->error;
//       }

        $conn->close();

        //Possibly add encryption??
        // password encrypt using SHA256();
        //$password = hash('sha256', $pass);

        if (ob_get_contents())
            ob_end_clean(); //clean buffer


            
//-----FOR TESTING PURPOSES-----
//        Eventually redirect to user_home.php
        header('Location: testing_db.php'); //once registered, redirect to testing_db page in order to check that registration was successful
    } else { // Forgot a field.
        print '<p class="error">Please go back and try again!</p>';
    }
} else { //if form hasn't been printed yet
    print '
        <div class = "formCard">
        <form action="register.php" method="post" id="registerForm">
            <fieldset>
                <legend id = "registerLegend">Register</legend>
                <p>User ID: <input type="text" name="userID" id = "userID"></p>
                <p>User Password: <input type="text" name="userPass" id = "userPass"></p>
                <p>User Password: <input type="text" name="userPass2" id = "userPass2"></p>
                <p><input type="submit" name="submit" value="Register!" id = "submitRegister"/></p>
            </fieldset>
        </form>
        </div>
        ';
}

include('templates/footer.php');
?>