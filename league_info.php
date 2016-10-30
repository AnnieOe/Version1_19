<?php
ob_start(); // Turn on output buffering:

/* File Name: league_info.php

  Version 1.0
  CSC 478 Group Project
  Group: FanSports
  Wesley Elliot, Jeremy Jones, Ann Oesterle
  Last Updated: 10/25/2016 by Annie Oesterle
 */

define('TITLE', 'League Information');
define('CSS', 'linfostyle');
include('templates/header_1.php'); // Include the header.
?>
<!-- BEGIN CHANGEABLE CONTENT. -->

<!--this table contains a list of all the teams in a certain league (the league is the one selected form user_home page------->-->
<!--TO DO: populate this table with the correct team names-->
<div class = "leagueList">
  <table class = "theLeagueList">
    <?php
    // Create connection

    /*     * *************************************************************************** */
    /*     * ***********Change This to Fit MySql host*********************************** */
    $conn = new mysqli('localhost', 'root', 'wERCwbuER8dz', 'fansportsdb');
    /*     * *************************************************************************** */

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT leagueID, team1, team2 FROM leagueinfo";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      while ($row = $result->fetch_assoc()) {
        print '<tr class = "theLeagueName" id = "theLeagueName"><td>' . $row['leagueID'] . '</td></tr><tr class = "theLeagueTeams" id = "theLeagueTeams"><td>' . $row['team1'] . '</td></tr><tr class = "theLeagueTeams" id = "theLeagueTeams"><td>' . $row['team2'] . '</td></tr>';
      }
    } else {
      print 'Uh OH, no info';
    }
    $conn->close();
    ?>
  </table>

</div>

<div class ="spacerTLvTM"></div>
<!--Upper Middle card, contains info about a specific team-->

<!--TO DO: Make sure that the team info shown here is for the team selected from the theLeagueList Table (upper left card)-->
<!--Version 2.0 TO DO: selecting a player from this table brings up detailed player info-->
<div class = "theTeam">
  <table class ="theTeam">
    <?php
    // Create connection

    /*     * *************************************************************************** */
    /*     * ***********Change This to Fit MySql host*********************************** */
    $conn = new mysqli('localhost', 'root', 'wERCwbuER8dz', 'fansportsdb');
    /*     * *************************************************************************** */
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT teamName, teamOwner, teamStatus FROM teaminfo";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      while ($row = $result->fetch_assoc()) {
        print '<tr class = "theteamTitle"><td>' . $row['teamName'] . '</td></tr>';
        print '<tr class = "theTeamInfo"><td>Owner:    ' . $row['teamOwner'] . '</td></tr>';
        print '<tr class = "theTeamInfo"><td>Status:   ' . $row['teamStatus'] . '</td></tr>';
        print '<tr class = "theTeamSpacer"></tr>';
        print '<tr class = "theTeamStatus"><td>' . $row['teamStatus'] . '</td></tr>';
      }
    } else {
      print '<td class = "leagueEmpty" id = "leagueEmpty">Join a League!</td>';
    }
    $conn->close();
    ?>
  </table>

</div><!--End div theTeam-->

<div class ="spacerTMvTR"></div><!--Spacer between top right card and right margin-->

<!--Top Right Card, contains info on league rules-->
<!--TO DO: decide on the default rules for the league version 1.0-->
<!--Version 2.0 when there are custom rules, populate table with correct rules-->
<div class ="leagueRules">
  <table>
    <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
    <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
    <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
  </table>

</div>


<!--Bottom Right Card, contains info about the roster of the team-->
<!--TO DO: Populate the Roster with the players associated with the selected team from the league-->
<div class = "theRoster" id = "theRoster">
  <table class ="theRoster">
    <tr class = "theRosterTitle"><td colspan = "8">Roster</td></tr>
    <tr class = "theRosterTitleA"><td colspan = "8">Active Players</td></tr>

    <?php
    // Create connection

    /*     * *************************************************************************** */
    /*     * ***********Change This to Fit MySql host*********************************** */
    $conn = new mysqli('localhost', 'root', 'wERCwbuER8dz', 'fansportsdb');
    /*     * *************************************************************************** */

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT QB, RB1, RB2, WR1, WR2, K, TE, DEF, bench1, bench2, bench3, bench4, bench5, bench6 FROM teaminfo";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      while ($row = $result->fetch_assoc()) {
        print '<tr class = "activePlayers"><td>' . $row['QB'] . '</td><td>' . $row['WR1'] . '</td><td>' . $row['WR2'] . '</td><td>' . $row['RB1'] . '</td><td>' . $row['RB2'] . '</td><td>' . $row['K'] . '</td><td>' . $row['TE'] . '</td><td>' . $row['DEF'] . '</td></tr>';
        print '<tr class = "theRosterTitleB"><td colspan = "8">Bench</td></tr>';
        print '<tr class = "benchPlayers"><td>' . $row['bench1'] . '</td><td>' . $row['bench2'] . '</td><td>' . $row['bench3'] . '</td><td>' . $row['bench4'] . '</td><td>' . $row['bench5'] . '</td><td>' . $row['bench6'] . '</td><td></td><td></td></tr>';
      }
    } else {
      print '<tr class = "theRosterTitle"><td colspan = "8">Roster is Empty</td></tr>';
    }
    $conn->close();
    ?>
  </table>

</div><!--End div theRoster-->


<?php
// Return to PHP.
include('templates/footer.php'); // Include the footer.
?>
