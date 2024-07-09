<?php

function check_password(object $conn, int $id, string $pswrd)
{
  $result = get_single_user($conn, null, "id = '$id'");
  return password_verify($pswrd, $result["pswrd"]);
};

function apply_chnages(object $conn, array $params, int $id)
{
  return update_user($conn, $params, "`id` = '$id'");
};

function store_profile_picture(array $pro_pic)
{
  $file = "../View/images/profiles/" . $pro_pic["name"];
  $fileName = random_str() . "." . pathinfo($file, PATHINFO_EXTENSION);
  $newFile = "../View/images/profiles/" . $fileName;
  move_uploaded_file($pro_pic["tmp_name"], $file);
  rename($file, $newFile);
  return $fileName;
};

function apply_deletion(object $conn, int $id, string $pswrd)
{
  if(!check_password($conn, $id, $pswrd)){
    return false;
  };
  return delete_user($conn, $id);
};


function random_str(int $len = 10)
{
  $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $string = "";
  for ($i=0; $i < $len; $i++) { 
    $string .= $chars[random_int(0, strlen($chars) - 1)];
  };
  return $string;
};