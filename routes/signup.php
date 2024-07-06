<?php

if($_SERVER["REQUEST_METHOD"] !== "POST"){
  header("location: ../View/html/index.php");
  die();
};

require_once "../db-connection.php";
require_once "../Models/User.php";
require_once "../Controllers/signupController.php";

$errors = [];
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$birth_date = $_POST["birth_date"];
$gender = $_POST["gender"];
$username = $_POST["username"];
$email = $_POST["email"];
$pswrd = $_POST["pswrd"];
$confirmation = $_POST["confirm_pswrd"];

if(empty_inputs($first_name, $last_name, $username, $email, $birth_date, $pswrd)){
  $errors["empty_inputs"] = "These inputs are required (" . implode(", ", empty_inputs($first_name, $last_name, $username, $email, $birth_date, $pswrd)) . ") please fill them up.";
};
if(invalid_inputs($first_name, $last_name, $username, $email, $birth_date)){
  $errors["invalid_input"] = invalid_inputs($first_name, $last_name, $username, $email, $birth_date);
};
if(username_exits($connection, $username)){
  $errors["taken_username"] = "This username is taken.";
};
if(email_exits($connection, $email)){
  $errors["taken_email"] = "This Email is already exists.";
};
if(not_confirmed_password($pswrd, $confirmation)){
  $errors["password_confirmation"] = "Password confirmation doesn't match.";
};

require_once "../session.config.php";

if ($errors) {
  $_SESSION["signup_errors"] = $errors;

  $_SESSION["pre_values"] = [
    "first_name" => $first_name,
    "last_name" => $last_name,
    "username" => $username,
    "email" => $email,
    "birth_date" => $birth_date,
    "gender" => $gender,
  ];

  header("location: ../View/html/signup.php");
  die();
};

register_user($connection, $first_name, $last_name, $gender, $username, $email, $birth_date, $pswrd);

set_user_session($connection, $username);

close_connection($connection);

header("location:../View/html/index.php");
die();