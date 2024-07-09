<?php


if($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST["real_method"])){
  header("location: ../View/html/index.php");
  die();
};

require_once "../session.config.php";
require_once "../db-connection.php";
require_once "../Models/User.php";
require_once "../Controllers/signupController.php";
require_once "../Controllers/userController.php";

if($_POST["real_method"] === "change_password"){

  $oldPswrd = $_POST["old_pswrd"];
  $newPswrd = $_POST["new_pswrd"];
  $confPswrd = $_POST["confirm_pswrd"];

  if($oldPswrd === "" or $newPswrd === "" or $confPswrd === ""){
    $errors["empty"] = "You fill all fields!";
  } else if ($newPswrd !== $confPswrd) {
    $errors["not_confirmed"] = "Password confirmation doesn't match!";
  } else if (!check_password($connection, $_SESSION["user"]["id"], $oldPswrd)){
    $errors["worng_password"] = "Your password is incorrect!";
  };

  if($errors){
    $_SESSION["change_password_errors"] = $errors;
    header("location: ../View/html/profiles/settings.php?username=" . $_SESSION["username"]);
    die();
  }

  apply_chnages($connection, ["pswrd" => password_hash($newPswrd, PASSWORD_BCRYPT, ['cost' => 12])], $_SESSION["user"]["id"]);

  $_SESSION["flash"] = "Password changed successfully!";
  
  header("location: ../View/html/profiles/settings.php?username=" . $_SESSION["username"]);
  die();
  
} else if ($_POST["real_method"] === "delete") {
  
  if(!apply_deletion($connection, $_SESSION["user"]["id"], $_POST["del_pswrd"] )){
    $_SESSION["profile_delete_error"] = "Your password is inncorrect!";
    header("location: ../View/html/profiles/settings.php?username=" . $_SESSION["username"]);
    die();
  };
  
  session_destroy();
  header("location: ../View/html/index.php");
  die();
};

$errors = [];
$first_name = trim($_POST["first_name"]);
$last_name = trim($_POST["last_name"]);
$birth_date = $_POST["birth_date"];
$gender = $_POST["gender"];
$username = $_POST["username"];
$email = $_POST["email"];
$pswrd = $_POST["pswrd"];

if(empty_inputs($first_name, $last_name, $username, $email, $birth_date, $pswrd)){
  $errors["empty_inputs"] = "These inputs are required (" . implode(", ", empty_inputs($first_name, $last_name, $username, $email, $birth_date, $pswrd)) . ") please fill them up.";
};
if(invalid_inputs($first_name, $last_name, $username, $email, $birth_date)){
  $errors["invalid_input"] = invalid_inputs($first_name, $last_name, $username, $email, $birth_date);
};
if(username_exits($connection, $username) && $username !== $_SESSION["user"]["username"]){
  $errors["taken_username"] = "This username is taken.";
};
if(email_exits($connection, $email) && $email !== $_SESSION["user"]["email"]){
  $errors["taken_email"] = "This Email is already exists.";
};
if(!check_password($connection, $_SESSION["user"]["id"], $pswrd)){
  $errors["wrong_password"] = "Your password is incorrect!";
};

if ($errors) {
  $_SESSION["profile_update_errors"] = $errors;

  header("location: ../View/html/profiles/settings.php?username=" . $_SESSION["user"]["username"]);
  die();
};

$params = [
  "first_name" => $first_name,
  "last_name" => $last_name,
  "birth_date" => $birth_date, 
  "gender" => $gender, 
  "username" => $username, 
  "email" => $email,
];

if($_FILES["pro_pic"]["name"]){
  $pro_pic = store_profile_picture($_FILES["pro_pic"]);
  $params["pro_pic"] = "profiles/" . $pro_pic;
};

apply_chnages($connection, $params, $_SESSION["user"]["id"]);

set_user_session($connection, $username);

close_connection($connection);

$_SESSION["flash"] = "Changes applied successfully!";

header("location: ../View/html/profiles/settings.php?username=" . $username);
die();