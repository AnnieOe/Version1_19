<?php
ob_start(); // Turn on output buffering:

/* File Name: league_info.php

  Version 1_19
  CSC 478 Group Project
  Group: FanSports
  Wesley Elliot, Jeremy Jones, Ann Oesterle
  Last Updated: 10/17/2016 */

define('TITLE', 'LeagueInfo');
define('CSS', 'linfostyle');
include('templates/header.php'); // Include the header.
?>
<!-- BEGIN CHANGEABLE CONTENT. -->
<div class ="spacerLvTL"></div>
  <div class = "leagueList">
    <table class = "theLeagueList">
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

  <div class ="spacerTLvTR"></div>
  <!--Upper Right Card, contains info about a specific team-->
  <div class = "theTeam">
    <table class ="theTeam">
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
  
<div class ="spacerTRvR"></div><!--Spacer between top right card and right margin-->


  <!--Bottom Right Card, contains info about the roster of the team-->
  <div class = "theRoster" id = "theRoster">
    <table class ="theRoster">
      <tr class = "theRosterTitle"><td colspan = "8">Roster</td></tr>
      <tr class = "theRosterTitleA"><td colspan = "8">Active Players</td></tr>
                                       
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
