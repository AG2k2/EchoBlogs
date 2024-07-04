<?php

function get_users(object $conn, array $columns = null, string $cond = null)
{

  $cols = $columns ? implode(",", $columns) : "*";
  $query = "SELECT " . $cols . " FROM users ";

  if($cond){
    $query .= conditions($cond);
  };

  $result = mysqli_fetch_all(mysqli_query($conn, $query), MYSQLI_ASSOC);
  return isset($result) ? $result : false; 

};

function get_single_user(object $conn, array $columns = null, string $cond = null){
  $cols = $columns ? implode(",", $columns) : "*";
  $query = "SELECT " . $cols . " FROM users ";

  if($cond){
    $query .= conditions($cond);
  };

  $query .= "LIMIT 1;";

  $result = mysqli_fetch_assoc(mysqli_query($conn, $query));
  return isset($result) ? $result : false; 
};

function update_user(object $conn, array $params, string $cond)
{

  $query = "UPDATE users SET ";

  foreach($params as $key => $param){
    $toUpdate[] = "`$key` = ? ";
    $values[] = $param;
  };

  $query = $query . implode(",", $toUpdate);
  if($cond){
    $query .= conditions($cond);
  };

  return mysqli_stmt_execute(mysqli_prepare($conn, $query), $values);
};

function post_user(object $conn, string $first_name, string $last_name, string $gender, int $birth_date, string $username, string $email, string $pswrd)
{

  $query = "INSERT INTO users (`first_name`, `last_name`, `gender`, `birth_date`, `username`, `email`, `pswrd`) 
  VALUES (?, ?, ?, ?, ?, ?, ?);";

  $hashedPswrd = password_hash($pswrd, PASSWORD_BCRYPT, ['cost' => 12]);

  $parameters = [
    $first_name,
    $last_name,
    $gender,
    date("Y-m-d", $birth_date),
    $username,
    $email,
    $hashedPswrd,
  ];

  return mysqli_stmt_execute(mysqli_prepare($conn, $query), $parameters);

};

function delete_user(object $conn, int $id)
{

  $query = "DELETE FROM users WHERE id = ?";

  return mysqli_stmt_execute(mysqli_prepare($conn, $query), [$id]);

};

function conditions (string $cond) {
  return "WHERE " . $cond;
}