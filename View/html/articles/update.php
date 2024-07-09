<?php 

require_once "../../../session.config.php";
require_once "../../../db-connection.php";
require_once "../../../Models/Articles.php";
require_once "../../../Controllers/articleController.php";

if(!isset($_SESSION['user']) || !isset($_GET["slug"])){
  header("location: ../index.php"); 
  die();
} else {
  $currentArticle = show_current_article($connection);
  if($currentArticle["author"]["id"] !== $_SESSION["user"]["id"] || !$currentArticle ){
    header("location: ../index.php"); 
    die();
  } else {
    $user = $_SESSION["user"];
  }; 
};

if(isset($_SESSION["article_errors"])){
  $errors = $_SESSION["article_errors"];
  unset($_SESSION["article_errors"]);
};

if(isset($_SESSION["pre_article_values"])){
  $pres = $_SESSION["pre_article_values"];
  unset($_SESSION["pre_article_values"]);
};
?>

<!DOCTYPE html>
<html lang="en" class="relative w-full h-full">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EchoArticle</title>
  <link rel="stylesheet" href="../../css/output.css">
  <script src="../../js/main.js" defer></script>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="relative flex flex-col justify-between w-full h-full">
  
<?php require "../components/navbar.php"; ?>

<main class="flex justify-center">

  <form action="../../../routes/articles.php" method="post" class="w-10/12 bg-purple-100 lg:w-3/5" enctype="multipart/form-data">
  
    <div class="p-4 py-8 bg-white shadow">
      <div class="m-5 text-2xl font-bold text-center text-gray-800 bg-white heading"><span class="font-normal">Update</span> <?= $currentArticle["title"] ?></div>
        <div class="flex flex-col w-10/12 max-w-2xl gap-4 p-4 mx-auto text-gray-800 border border-gray-300 shadow-lg">

          <input type="hidden" value="update" name="real_method">
          <input type="hidden" value="<?= $currentArticle["title"] ?>" name="prev_title">
          <input type="hidden" value="<?= $currentArticle["id"] ?>" name="article_id">

          <input name="title" class="p-2 bg-gray-100 border border-gray-300 outline-none title" placeholder="Title:" type="text"
          value="<?= $currentArticle["title"] ?>" />
          
          <input name="category" class="p-2 bg-gray-100 border border-gray-300 outline-none title" placeholder="Category:" type="text"
          value="<?= $currentArticle["category"] ?>" />

          <textarea name="body" class="p-3 bg-gray-100 border border-gray-300 outline-none description sec h-60" placeholder="Article content:"><?= $currentArticle["body"] ?></textarea>
          
          <input type="file" name="thumbnail" accept="image/*" id="thumbnail-input"/>

          <ul>
            <?php if (isset($errors)):
                foreach ($errors as $error): ?>
                  <li class="my-2 text-lg text-red-600">
                    * <?= $error ?>
                  </li>
                <?php endforeach;
              endif;?>
          </ul>

          <div class="hidden w-full" id="thumbnail-preview">
            <img src="">
          </div>
          
          <div class="flex justify-end buttons">
            <button type="submit" class="p-1 px-4 ml-2 font-semibold text-white bg-purple-500 border border-purple-600 cursor-pointer btn">Update</button>
          </div>
          
        </div>
      </div>
    </div>

  </form>

</main>

<?php require "../components/footer.php"; ?>

</body>
</html>