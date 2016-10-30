<?php
ob_start(); // Turn on output buffering:

/* File Name: draft.php

  Version 1.0
  CSC 478 Group Project
  Group: FanSports
  Wesley Elliot, Jeremy Jones, Ann Oesterle
  Last Updated: 10/25/2016 by Annie Oesterle
 */

define('TITLE', 'Draft');
define('CSS', 'draftstyle');
include('templates/header.php'); // Include the header.
?>
<!-- BEGIN CHANGEABLE CONTENT. -->

<!--Top Card, main information about draft-->
<div class ="topDraft">
  <h1 class = "draftHeading">Draft</h1>
  <!--Version 2.0 this information will change depending on user settings-->
  <table class ="draftRules">
    <tr class = "dRulesTitle"><td class = "dRulesTitle">Draft Rules</td></tr>
    <tr class = "draftRules"><td class = "draftRules">Type: <br>&nbsp;&nbsp;&nbsp;Snake</td></tr>
    <tr class = "draftRules"><td class = "draftRules">Required players:<br>&nbsp;&nbsp;&nbsp;1 QG, 2 RB, 2 WR, 1 TE, 1 DEF, 1  K</td></tr>
    <tr class = "draftRules"><td class = "draftRules">Number of bench players allowed:<br>&nbsp;&nbsp;&nbsp;6</td></tr>
    <tr class = "dMoreInfo"><td class = "dMoreInfo">more info</td></tr>
  </table>
  <!--This information changes based on the player selected in the bottom-left card, the availablePlayers div-->
  <table class =" selectedPlayer">
    <tr class ="draftTeamHeader"><td colspan = "4">Select a Player</td></tr>
    <!--<tr class = "selectedPlayerTitle"><td>Position</td><td>Player Name</td><td>&nbsp;</td><td>&nbsp;</td></tr>-->
    <tr class = "selectedPlayer"><td class = "selectedPlayerPos">QB</td ><td class = "selectedPlayer">Cam Newton</td><td class = "dPlayerMore">more info</td><td class ="draftButton">Draft Player</td></tr>
  </table>
</div><!--END top Card, div topDraft-->

<!--Bottom-left Card,information about available players to draft-->
<div class ="availablePlayers">
  <h1 class = "avPlayerTitle">Available Players</h1>
  <!--Top of Card search by player position-->
  <table class = "selectPos">
    <tr>
      <td >QB</td>
      <td>RB</td>
      <td>WR</td>
      <td>TE</td>
      <td>K</td>
      <td>DEF</td>
      <td class = "endBlank">&nbsp;</td>
    </tr>
  </table>
  <!--Main part of card, list of players-->
  <table class = "avPlayerList">
    <tr class = "draftCategories">
      <td>Select</td>
      <td>Ranking</td>
      <td>Player Name</td>
      <td>Stats</td>
    </tr>
    <tr class = "draftPlayers">
      <td><input type="checkbox" name="playerSelect" value="playerSelect1" class = "playerCheckbox"></td>
      <td>1</td>
      <td>Player</td>
      <td>Stats</td>
    </tr>
    <tr class = "draftPlayers">
      <td><input type="checkbox" name="playerSelect" value="playerSelect2" class = "playerCheckbox"></td>
      <td>1</td>
      <td>Player</td>
      <td>Stats</td>
    </tr>
    
  </table>
  
</div><!-- End bottom-left card availablePlayers div  -->

<!--Bottom-right card with taken/chosen players list-->
<div class ="myPlayers">
  <table class ="myPlayers">
    <tr class = "myRosterTitle"><td colspan = "2">Current Roster</td></tr>
    <tr class = "myRosterCategories">
      <td>Position</td>
      <td>Player Name</td>
    </tr>
    <tr class = "myRosterPlayers">
      <td>QB</td>
      <td>Player</td>
    </tr>
    <tr class = "myRosterPlayers">
      <td>WR</td>
      <td>Player</td>
    </tr>
    <tr class = "myRosterPlayers">
      <td>RB</td>
      <td>Player</td>
    </tr>
  </table>
</div><!-- End bottom-left card myPlayers div  -->

<!-- END CHANGEABLE CONTENT. -->

<?php
include('templates/footer.php'); // Include the footer.
?>
