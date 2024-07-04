<?php 

require_once "../session.config.php";

if(!isset($_SESSION["user"]) || $_SERVER["REQUEST_METHOD"] !== "POST"){
  header("location: ../View/html/index.php");
  die();
};

$_SESSION = array();

session_destroy();

echo "<pre>";
print_r($_SESSION);
echo "</pre>";

header("location: ../View/html/index.php");
die();