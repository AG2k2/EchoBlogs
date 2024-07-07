<?php

$host = "localhost";
$db_name = "echoarticle";
$db_username = "root";
$db_password = "";

$connection = mysqli_connect($host, $db_username, $db_password, $db_name);

if (!$connection) {
  die("Connection failed: " . mysqli_connect_error());
};

function close_connection($connection){
  mysqli_close($connection);
};