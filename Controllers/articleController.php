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
  
  if(isset($_GET["slug"])){
    $cond = "slug = '" . $_GET["slug"] . "'";
  };
  
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

  return get_single_article($conn, "slug = '$slug'");
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
  var_dump(check_passowrd($conn, $authorId, $pswrd));
  if(!check_passowrd($conn, $authorId, $pswrd)){
    return false;
  };
  return delete_article($conn, $postId);
};

//=================== OTHER =====================

function check_passowrd(object $conn, int $id, string $pswrd)
{
  $result = get_single_user($conn, null, "id = '$id'");
  return password_verify($pswrd, $result["pswrd"]);
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

function title_to_slug($title)
{
  $slug = implode("-", explode(" ", $title));
  return $slug;
};