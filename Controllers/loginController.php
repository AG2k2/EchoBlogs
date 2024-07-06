<?php

function empty_inputs(string $fName, string $pswrd)
{
  $inputs = [];
  if ($fName == ""){
    $inputs[] = "First name";
  };
  if ($pswrd == ""){
    $inputs[] = "Password";
  };
  return $inputs;
};

function invalid_username(string $username) 
{
  if (preg_match( "/[^a-zA-z0-9.-_]/", trim($username))){
    return "Your Username is invalid. Only letters, numbers, and '.' '-' '_' are valid";
  } else {
    return false;
  };
};

function invalid_email(string $input)
{
  return !filter_var($input, FILTER_VALIDATE_EMAIL);
};

function login_user(object $conn, string $input,  string $pswrd)
{
  $cond = invalid_email($input) ? "username = '$input'" : "email = '$input'";
  $result = get_single_user($conn, null, $cond);
  if (!$result) {
    return false;
  } else {
    return password_verify($pswrd, $result["pswrd"]) ? $result : false;
  };
};