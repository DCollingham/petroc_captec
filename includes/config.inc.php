<?php

$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "captec";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if(!$conn) {
    die("Connection Failed: " . mysql_connect_error());
}