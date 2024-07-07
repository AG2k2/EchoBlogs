<?php

function empty_inputs(string $fName, string $lName, string $username ,string $email, string $bDate, string $pswrd)
{
  $inputs = [];
  if ($fName == ""){
    $inputs[] = "First name";
  };
  if ($lName == ""){
    $inputs[] = "Last name";
  };
  if ($username == ""){
    $inputs[] = "Username";
  };
  if ($email == ""){
    $inputs[] = "Email";
  };
  if ($bDate == ""){
    $inputs[] = "Birth date";
  };
  if ($pswrd == ""){
    $inputs[] = "Password";
  };
  return $inputs;
};

function invalid_inputs(string $fName, string $lName, string $username ,string $email, string $bDate) 
{
  if(preg_match( "/[^a-zA-z]/", trim($fName))){
    return "Your First name is invalid. Only letters are valid";
  } else if(preg_match( "/[^a-zA-z]/", trim($lName))){
    return "Your Last name is invalid. Only letters are valid";
  } else if (preg_match( "/[^a-zA-z0-9.-_]/", trim($username))){
    return "Your Username is invalid. Only letters, numbers, and '.' '-' '_' are valid";
  } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    return "Your email is invalid.";
  } else if(!strtotime($bDate) || strtotime($bDate) > time() || strtotime($bDate) < time()-31536000*150){
    return "Your Birth date is invalid.";
  } else {
    return false;
  };
};

function username_exits(object $conn, string $username)
{
  return get_users($conn, ["username"], "username = '$username'") ? true : false;
};

function email_exits(object $conn, string $email)
{
  return get_users($conn, ["email"], "email = '$email'") ? true : false;
};

function not_confirmed_password(string $pass, string $conf)
{
  return $pass !== $conf ? true : false;
};

function register_user(object $conn, string $fName, string $lName, string $gender, string $username ,string $email, string $bDate, string $pswrd)
{
  
  post_user($conn, $fName, $lName, $gender, strtotime($bDate), $username, $email, $pswrd);
  return;

};

function set_user_session($conn, $username)
{
  $result = get_single_user($conn, null, "username = '$username'");
  $_SESSION["user"] = [
    "id" => $result["id"],
    "first_name" => $result["first_name"],
    "last_name" => $result["last_name"],
    "full_name" => $result["first_name"] . " " . $result["last_name"],
    "username" => $result["username"],
    "email" => $result["email"],
    "birth_date" => $result["birth_date"],
    "gender" => $result["gender"],
  ];
  return;
};
