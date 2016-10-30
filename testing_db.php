<?php
ob_start();// Turn on output buffering:

/*File Name: testing_db.php

Version 1_18
CSC 478 Group Project
Group: FanSports
Wesley Elliot, Jeremy Jones, Ann Oesterle
Last Updated: 10/15/2016*/

define('TITLE', 'Testing the Database');
define('CSS', 'formstyle');
include('templates/header.php'); // Include the header.
//
//-----Begin Changeable Content-----

$servername = "localhost";
$username = "root";
$password = "wERCwbuER8dz";
$dbname = "fansportsdb";

// Create connection
//$conn = new mysqli('localhost', 'root', 'wERCwbuER8dz', 'fansportsdb');
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

 /*       
$sql = "SELECT userID, userPass FROM userinfo";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Name</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["userID"]."</td><td>".$row["userPass"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$sql = "SELECT leagueID, leagePass FROM leageinfo";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Name</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["leagueID"]."</td><td>".$row["leagePass"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}*/
$sql = "SELECT teamName, teamOwner, teamStatus, QB, RB1, RB2, WR1, WR2 FROM teaminfo";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Name</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["teamName"]."</td><td>".$row["teamOwner"]."</td><td>".$row["teamStatus"]."</td><td>".$row["QB"]."</td><td>".$row["RB1"]."</td><td>".$row["RB2"]."</td><td>".$row["WR2"]."</td><td>".$row["WR2"]."</td></tr>";
                /*.$row["teamStatus"]."</td><td>".$row["QB"]."</td><td>".$row["WR1"]."</td><td>".$row["WR2"]."</td><td>".$row["RB1"]."</td><td>".$row["RB2"]."</td></tr>";*/
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();

//-----END Changeable Content-----

include('templates/footer.php');
?>