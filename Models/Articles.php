<?php

function get_articles(object $conn, string $cond = null, string $order = "`created_at` DESC")
{

  $query = "SELECT * FROM articles";

  if($cond){
    $query .= article_conditions($cond);
  };

  $query .= " ORDER BY $order";

  $query2 = "SELECT u.*
  FROM ($query) a
  INNER JOIN users u
  ON a.author_id = u.id
  ORDER BY $order;";

  $query .= ";";

  $result = mysqli_fetch_all(mysqli_query($conn, $query), MYSQLI_ASSOC);
  $result2 = mysqli_fetch_all(mysqli_query($conn, $query2), MYSQLI_ASSOC);

  if($result){
    for ($i = 0; $i < count($result); $i++) {
      $result[$i]["author"] = $result2[$i];
    };
  };
  return $result ? $result : false; 

};

function get_single_article(object $conn, string $cond = null){
  $query = "SELECT * FROM articles ";

  if($cond){
    $query .= article_conditions($cond);
  };

  $query .= "LIMIT 1";

  $query2 = "SELECT u.*
  FROM ($query) a
  INNER JOIN users u
  ON a.author_id = u.id;";

  $query .= ";";

  $result = mysqli_fetch_assoc(mysqli_query($conn, $query));
  $result2 = mysqli_fetch_assoc(mysqli_query($conn, $query2));

  if($result){
    $result["author"] = $result2;
  };

  return $result ? $result : false; 
};

function update_article(object $conn, array $params, string $cond)
{

  $query = "UPDATE articles SET ";

  foreach($params as $key => $param){
    $toUpdate[] = "`$key` = ? ";
    $values[] = $param;
  };

  $query = $query . implode(",", $toUpdate);
  if($cond){
    $query .= article_conditions($cond);
  };

  return mysqli_stmt_execute(mysqli_prepare($conn, $query), $values);
};

function post_article(object $conn, string $title, string $slug, string $category, string $thumbnail = null, string $body, int $author_id)
{

  $query = "INSERT INTO articles (`title`, `slug`, `category`, `thumbnail`, `body`, `author_id`) 
  VALUES (?, ?, ?, ?, ?, ?);";

  $parameters = [
    $title,
    $slug,
    $category,
    $thumbnail,
    $body,
    $author_id,
  ];

  return mysqli_stmt_execute(mysqli_prepare($conn, $query), $parameters);

};

function delete_article(object $conn, int $id)
{

  $query = "DELETE FROM articles WHERE id = ?";

  return mysqli_stmt_execute(mysqli_prepare($conn, $query), [$id]);

};

function article_conditions (string $cond) {
  return " WHERE " . $cond;
};