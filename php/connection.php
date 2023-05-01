<?php 
$hostname = "localhost";
$username = "daria";
$password = "123";
$dbName = "mmv"; 
$link = mysqli_connect($hostname, $username, $password, $dbName);
mysqli_query($link, "SET CHARACTER SET 'utf8'");
