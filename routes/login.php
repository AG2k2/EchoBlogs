<?php

if($_SERVER["REQUEST_METHOD"] !== "POST"){
  header("location: ../View/html/index.php");
  die();
};

require_once "../db-connection.php";
require_once "../Models/User.php";
require_once "../Controllers/loginController.php";

$input = $_POST["input"];
$pswrd = $_POST["pswrd"];

if(empty_inputs($input, $pswrd)){
  $errors["empty_inputs"] = "Please fill up all fields.";
};
if (invalid_email($input) && invalid_username($input)) {
  $errors["invalid_input"] = "Your email or username is invalid. Only letters, numbers, and . - _ are valid for username";
} else {
  if(login_user($connection, $input, $pswrd)){
    $user = login_user($connection, $input, $pswrd);
  } else {
    $errors["wrong_credentials"] = "One credential or both is wrong.";
  };
};

require_once "../session.config.php";

if($errors) {
  $_SESSION["login_errors"] = $errors;
  header("location: ../View/html/login.php");
  die();
} else {
  $_SESSION["user"] = [
    "id" => $user["id"],
    "first_name" => $user["first_name"],
    "last_name" => $user["last_name"],
    "full_name" => $user["first_name"] . " " . $user["last_name"],
    "username" => $user["username"],
    "email" => $user["email"],
    "birth_date" => $user["birth_date"],
    "gender" => $user["gender"],
  ];
  header("location: ../View/html/index.php");
};

close_connection($connection);
die();