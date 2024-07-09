<?php

//=================== VALIDATION =====================

function empty_inputs(string $title, string $category, string $body)
{
  $inputs = [];
  if($title === ""){
    $inputs[] = "title";
  };
  if($category === ""){
    $inputs[] = "category";
  };
  if($body === ""){
    $inputs[] = "body";
  };
  return $inputs;
};

function existed_slug(object $conn, string $title) 
{
  $slug = title_to_slug($title);
  return get_single_article($conn, "slug = '$slug'") ? true : false;
}


//=================== GET =====================

function show_articles(object $conn)
{
  
  $cond = null;
  
  if(isset($_GET["category"]) && $_GET["category"] !== ""){
    $cond = "`category` LIKE '%" . $_GET["category"] . "%'";
  }

  if(isset($_GET["search_query"]) && $_GET["search_query"] !== ""){
    $cond = "body LIKE '%" . $_GET["search_query"] . "%' or title LIKE '%" . $_GET["search_query"] . "%'";
  }
  
  $articles = get_articles($conn, $cond) ? get_articles($conn, $cond) : null;
  
  return $articles;
};

function get_all_articles(object $conn)
{

  return get_articles($conn);
};

function show_current_article(object $conn)
{
  
  if(isset($_GET["slug"])){
    $slug = $_GET["slug"];
  };

  $result = get_single_article($conn, "slug = '$slug'");

  if($result){
    $result["body"] = prepare_body($result["body"]);
  };

  return $result;
};


//=================== CREATE =====================

function insert_post(object $conn, string $title, string $thumbnail = null, string $category, string $body, int $id)
{
  
  $slug = title_to_slug($title);
  
  return post_article($conn, $title, $slug, $category, $thumbnail, $body, $id);
};

function store_thumbnail(array $thumbnail)
{
  $file = "../View/images/thumbnails/" . $thumbnail["name"];
  $fileName = random_str() . "." . pathinfo($file, PATHINFO_EXTENSION);
  $newFile = "../View/images/thumbnails/" . $fileName;
  move_uploaded_file($thumbnail["tmp_name"], $file);
  rename($file, $newFile);
  return $fileName;
};

//=================== UPDATE =====================

function updating(object $conn, bool $newSlug, array $params, int $id)
{

  if($newSlug){
    $params["slug"] = title_to_slug($params["title"]);
  }

  return update_article($conn, $params, "id = $id");
};

//=================== DELETE =====================

function deletion(object $conn, int $authorId, string $pswrd, int $postId)
{
  if(!check_password($conn, $authorId, $pswrd)){
    return false;
  };
  return delete_article($conn, $postId);
};

function title_to_slug($title)
{
  $slug = implode("-", explode(" ", $title));
  return $slug;
};

function prepare_body(string $body)
{
  $body = str_replace("\n", "</p><p>", $body);
  return $body;
}