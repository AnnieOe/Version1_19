<?php
ob_start(); // Turn on output buffering:

/* File Name: user_home.php

  Version 1_19
  CSC 478 Group Project
  Group: FanSports
  Wesley Elliot, Jeremy Jones, Ann Oesterle
  Last Updated: 10/17/2016 */

define('TITLE', 'User Home');
define('CSS', 'uhomestyle');
include('templates/header.php'); // Include the header.
?>
<!-- BEGIN CHANGEABLE CONTENT. -->
<!--One Card on this page with all user info-->
<div class ="userCard">

    <!--Top of the card, contains the user profile-->
    <div class ="userProfile">

        <?php
        if (!isset($_SESSION['loggedin'])) {
            print '<h1 class ="userWelcome">Welcome</h1>';
        } else {
            $name = $_SESSION['userID'];
            print "<h1 class ='userWelcome'>Hello, $name</h1>";
        }
        ?>

    </div><!--End userProfile div-->
    <!--Middle of the card, contains the info about any leagues the user is in-->
    <div class ="currentLeagues">
        <table class ="myLeagues">
            <tr class = "Leaguetitle">
                <td align = "center" colspan = "4" >Current Leagues</td>
            </tr>
            <!--<tr class ="spacer"></tr>-->
            <tr class = "categories">
                <td >League Name</td>
                <td >Team Name</td>
                <td >Status</td>
            </tr>
            <tr class = "leagueData" id = "leagueData">
                <?php
                // Create connection
                
/******************************************************************************/
/*************Change This to Fit MySql host************************************/
                $conn = new mysqli('localhost', 'root', 'wERCwbuER8dz', 'fansportsdb');
/******************************************************************************/
                
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT leagueName, teamName, teamStatus FROM teaminfo";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        print '<td>' . $row['leagueName'] . '</td><td>' . $row['teamName'] . '</td><td>' . $row['teamStatus'] . '</td></tr>';
                    }
                } else {
                    print '<td class = "leagueEmpty" id = "leagueEmpty">Join a League!</td>';
                }
                $conn->close();
                ?>
        </table>
    </div><!-- End currentLeague div  -->
    <!--Bottom of card, contains buttons for joining or creating a league-->
    <table class = "addLeague">
        <tr class ="addLeague" id = "addLeague">
            <td class = "createLeague" id = "createLeague">Create a League</td>
            <td class = "joinLeague" id = "joinLeague">Join a League</td>
        </tr>
    </table

</div><!-- End userCard div  -->

<!-- END CHANGEABLE CONTENT. -->

<?php
include('templates/footer.php'); // Include the footer.
?>
