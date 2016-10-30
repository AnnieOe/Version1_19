<?php

ob_start(); // Turn on output buffering:

/* File Name: create.php

  Version 1_19
  CSC 478 Group Project
  Group: FanSports
  Wesley Elliot, Jeremy Jones, Ann Oesterle
  Last Updated: 10/17/2016 */

define('TITLE', 'Create');
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
    if (empty($_POST['leagueID'])) {
        $problem = TRUE;
        print '<p class="error">Please enter a League Name!</p>';
    }

    if (empty($_POST['leaguePass'])) {
        $problem = TRUE;
        print '<p class="error">Please enter a password!</p>';
    }

    if ($_POST['leaguePass'] != $_POST['leaguePass2']) {
        $problem = TRUE;
        print '<p class="error">Your password did not match your confirmed password!</p>';
    }

    if (!$problem) { // If there weren't any problems...
        // clean user inputs to prevent sql injections
        $leagueID = trim($_POST['leagueID']);
        $leagueID = strip_tags($leagueID);
        $leagueID = htmlspecialchars($leagueID);
        $_SESSION['leagueID'] = $leagueID;

        $leaguePass = trim($_POST['leaguePass']);
        $leaguePass = strip_tags($leaguePass);
        $leaguePass = htmlspecialchars($leaguePass);
        $_SESSION['leaguePass'] = $leaguePass;

        $_SESSION['loggedin'] = time(); //set that the user has been logged in...time() is just a placeholder any value but NULL works
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        //add new values (created by registration) for leagueID and leaguePass to userinfo table
        $sql = "INSERT INTO leagueinfo (leagueID, leaguePass)
            VALUES ('$leagueID', '$leaguePass')";
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
        header('Location: testing_db_1.php'); //once createed, redirect to testing_db page in order to check that registration was successful
    } else { // Forgot a field.
        print '<p class="error">Please go back and try again!</p>';
    }
} else { //if form hasn't been printed yet
    print '
        <div class = "formCard">
        <form action="create.php" method="post" id="createForm">
            <fieldset>
                <legend id = "createLegend">Create</legend>
                <p>League ID: <input type="text" name="leagueID" id = "leagueID"></p>
                <p>League Password: <input type="text" name="leaguePass" id = "leaguePass"></p>
                <p>League Password: <input type="text" name="leaguePass2" id = "leaguePass2"></p>
                <p><input type="submit" name="submit" value="Create!" id = "submitCreate"/></p>
            </fieldset>
        </form>
        </div>
        ';
}

include('templates/footer.php');
?>