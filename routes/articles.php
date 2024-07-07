<?php

require_once "../Controllers/articleController.php";
require_once "../Models/Articles.php";
require_once "../db-connection.php";
require_once "../session.config.php";
require_once "../Models/User.php";

if($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_SESSION["user"])){
  header("location: ../View/html/index.php");
  die();
};

if(isset($_POST["real_method"])){
  switch ($_POST["real_method"]) {
    case "delete":
      if(!deletion($connection, $_SESSION["user"]["id"], $_POST["pswrd"], $_POST["article_id"])){
        $_SESSION["flash"] = "Couldn't delete the post; wrong password.";
        header("location: ../View/html/articles/index.php?slug=" . $_POST["slug"]);
        die();
      };
      header("location: ../View/html/index.php");
      break;

    case "update":
      $title = $_POST["title"];
      $category = $_POST["category"];
      $body = $_POST["body"];
      $newSlug = false;

      if($title !== $_POST["prev_title"]){
        $newSlug = true;
      };

      $thumbnail = prepare_inputs($connection, $title, $category, $body, $newSlug);
      $params = [
        "title" => $title, 
        "category" => $category, 
        "body" => $body,
      ];

      if($thumbnail){
        $params["thumbnail"] = $thumbnail;
      };

      updating($connection, $newSlug, $params, $_POST["article_id"]);
      header("location: ../View/html/index.php");
      break;
  };
  header("location: ../View/html/index.php");
  die();

} else {

  $title = $_POST["title"];
  $category = $_POST["category"];
  $body = $_POST["body"];

  $thumbnail = prepare_inputs($connection, $title, $category, $body, true);
  $id = $_SESSION["user"]["id"];
  insert_post($connection, $title, $thumbnail, $category, $body, $id);
  header("location: ../View/html/index.php");
  die();
}

function prepare_inputs($connection, $title, $category, $body, $newSlug, $errors = [] )
{
  if($check = empty_inputs($title, $category, $body)){
    if(in_array("title", $check)){
      $errors["empty_title"] = "You can't submit a post without title!";
    };
    if(in_array("category", $check)){
      $errors["empty_category"] = "You can't submit a post without category!";
    };
    if(in_array("body", $check)){
      $errors["empty_body"] = "You need to write something in your post!";
    };
  };
  
  if($newSlug){
    if(existed_slug($connection, $title)){
      $errors["existed_slug"] = "Please change the title for the slug.";
    };
  }
  
  if($errors){
    $_SESSION["article_errors"] = $errors;
    $_SESSION["pre_article_values"] = [
      "title" => $title,
      "category" => $category,
      "body" => $body,
    ];
    header("location: ../View/html/articles/create.php");
    die();
  };

  $thumbnail = "";
  
  if($_FILES["thumbnail"]["name"]){
    $thumbnail = store_thumbnail($_FILES["thumbnail"]);
  };

  return $thumbnail ? $thumbnail : null;

}