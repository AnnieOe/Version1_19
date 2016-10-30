<?php
ob_start(); // Turn on output buffering:

/*File Name: user_home.php

Version 1.0
CSC 478 Group Project
Group: FanSports
Wesley Elliot, Jeremy Jones, Ann Oesterle
Last Updated: 10/25/2016 by Annie Oesterle
*/

define('TITLE', 'User Home');
define('CSS', 'dashboardstyle');
include('templates/header.php'); // Include the header.
?>
<!-- BEGIN CHANGEABLE CONTENT. -->
<!--One Card on this page with all user info-->
<div class ="userCard">

    <!--Top of the card, contains the user profile-->
    <div class ="userProfile">
<!--Greet User with custom greeting-->
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
      <h1 class = "myLeagues_title">Current Leagues</h1>
        <table class ="myLeagues">
            <tr class = "myLeagues_categories">
                <th  class = "myLeagues_categories">League Name</td>
                <th  class = "myLeagues_categories">Team Name</td>
                <th  class = "myLeagues_categories">Status</td>
            </tr>
<!----------TO DO: CLick on the row will take user to league info page for that league------------------>
<!----------TO DO V 2.0: Have a Row for every league the user is a part of------------------>
            <tr class = "myLeagues_data" id = "leagueData">
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
                        print '<td id = "leagueData">' . $row['leagueName'] . '</td><td id = "leagueData">' . $row['teamName'] . '</td><td id = "leagueData">' . $row['teamStatus'] . '</td></tr>';
                    }
                } else {
                    print '<td class = "leagueEmpty" id = "leagueEmpty">Join a League!</td>';
                }
                $conn->close();
                ?>
        </table>
    <div class = "createLeague" id = "createLeague">Create a League</div>
    <div class = "joinLeague" id = "joinLeague">Join a League</div>
    
    </div><!-- End currentLeague div  -->

</div><!-- End userCard div  -->

<!-- END CHANGEABLE CONTENT. -->

<?php
include('templates/footer.php'); // Include the footer.
?>
