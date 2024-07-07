<?php

function get_article_comments(object $conn, int $articleId, string $order = "`created_at` DESC")
{

  $comment_query = "SELECT * FROM comments WHERE `article_id` = $articleId  AND comment_id IS NULL";

  $comment_query .= " ORDER BY $order";

  $author_query = "SELECT u.*
  FROM ($comment_query) c
  INNER JOIN users u
  ON c.author_id = u.id
  ORDER BY c.$order;";

  $result = mysqli_fetch_all(mysqli_query($conn, $comment_query), MYSQLI_ASSOC);
  $result2 = mysqli_fetch_all(mysqli_query($conn, $author_query), MYSQLI_ASSOC);

  if($result){
    for ($i = 0; $i < count($result); $i++) {
      $result[$i]["author"] = $result2[$i];
    };
  };

  $replies_query = get_comment_replies($conn, $articleId);
  $replies = $replies_query ? $replies_query : null;

  for($i = 0; $i < count($result); $i++){
    foreach($replies as $reply){
      if($reply["comment_id"] == $result[$i]["id"]){
        $result[$i]["replies"][] = $reply;
      };
    };
    if(!isset($result[$i]["replies"])){
      $result[$i]["replies"] = null;
    };
  };

  return $result ? $result : false; 

};

function get_comment_replies(object $conn, int $articleId, string $order = "`created_at` DESC")
{
  $replies_query = "SELECT * FROM comments WHERE `article_id` = $articleId  AND comment_id IS NOT NULL";

  $replies_query .= " ORDER BY $order";

  $author_query = "SELECT u.*
  FROM ($replies_query) c
  LEFT JOIN users u
  ON c.author_id = u.id
  ORDER BY c.$order;";

  $result = mysqli_fetch_all(mysqli_query($conn, $replies_query), MYSQLI_ASSOC);
  $result2 = mysqli_fetch_all(mysqli_query($conn, $author_query), MYSQLI_ASSOC);

  if($result){
    for ($i = 0; $i < count($result); $i++) {
      $result[$i]["author"] = $result2[$i];
    };
  };

  return $result ? $result : false; 
}

function update_comment(object $conn, array $params, string $cond)
{

  $query = "UPDATE comments SET ";

  foreach($params as $key => $param){
    $toUpdate[] = "`$key` = ? ";
    $values[] = $param;
  };

  $query = $query . implode(",", $toUpdate);
  if($cond){
    $query .= comment_conditions($cond);
  };

  return mysqli_stmt_execute(mysqli_prepare($conn, $query), $values);
};

function post_comment(object $conn, int $authorId, int $articleId, string $body)
{

  $query = "INSERT INTO comments (`author_id`, `article_id`, `body`) 
  VALUES (?, ?, ?);";

  $parameters = [
    $authorId,
    $articleId,
    $body,
  ];

  return mysqli_stmt_execute(mysqli_prepare($conn, $query), $parameters);

};

function post_reply(object $conn, int $authorId, int $articleId, int $commentId, string $body)
{

  $query = "INSERT INTO comments (`author_id`, `article_id`, `comment_id`, `body`) 
  VALUES (?, ?, ?, ?);";

  $parameters = [
    $authorId,
    $articleId,
    $commentId,
    $body,
  ];

  return mysqli_stmt_execute(mysqli_prepare($conn, $query), $parameters);

};

function delete_comment(object $conn, int $id)
{

  $query = "DELETE FROM comments WHERE id = ?";

  return mysqli_stmt_execute(mysqli_prepare($conn, $query), [$id]);

};

function comment_conditions (string $cond) {
  return " WHERE " . $cond;
};