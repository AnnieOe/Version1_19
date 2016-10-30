<?php
ob_start(); // Turn on output buffering:

/* File Name: join.php

  Version 1_19
  CSC 478 Group Project
  Group: FanSports
  Wesley Elliot, Jeremy Jones, Ann Oesterle
  Last Updated: 10/17/2016 */

define('TITLE', 'Join');
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
    if ((!empty($_POST['leagueID'])) && (!empty($_POST['leaguePass']))) {//Check that both fields have been entered
        $leagueTestID = $_POST['leagueID'];
        $leagueTestPass = $_POST['leaguePass'];

        /**** BEGIN MYSQL ****/
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT leagueID, leaguePass FROM userinfo WHERE leagueID = '$leagueTestID'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) { //leagueID exists
            
            while ($row = $result->fetch_assoc()) {//put mysql data associated with the userTestID into a row
                
                
                    $_SESSION['leagueID'] = $_POST['leagueID']; //set the session variable leagueID to valid leagueID
                    $_SESSION['loggedin'] = time(); //basically sets loggedIn = TRUE, time() is a placeholder 
                    
                    if ($leagueTestPass == $row["leaguePass"]) { //test that the leaguePass matches the leagueID
                    
                    if (ob_get_contents()) ob_end_clean(); //clean buffer

                    header('Location: user_home.php'); //once logged in, redirect to user home
    
                    
                } else { //incorrect password
                    print '<p class = "error">That user Password is incorrect. Try again!</p>';
                }
            }
        } else { //no result found with that leagueID
            print '<p class = "error">That user ID has not been registered. Make sure you entered everything correctly</p>';
        }
        $conn->close();
        
        /****END MYSQL ****/
    } else { //if one of the fields is missing
        $_SESSION['loggedin'] = NULL; //set so that user is not logged in
        print '<p>Please make sure you enter both an leagueID address and a password!<br />Go back and try again.</p>';
    }
} else { //if form hasn't been printed yet
    print '
        <div class = "formCard">
        <form action="join.php" method="post" id="joinForm">
            <fieldset>
                <legend id = "joinLegend">Join</legend>
                <p>League ID: <input type="text" name="leagueID" id = "leagueID"></p>
                <p>League Password: <input type="text" name="leaguePass" id = "leaguePass"></p>
                <p><input type="submit" name="submit" value="Join!" id = "submitJoin"/></p>
            </fieldset>
        </form>
        </div>
        ';
}
include('templates/footer.php');
?>