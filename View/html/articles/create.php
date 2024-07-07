<?php 

require_once "../../../session.config.php";

if(!isset($_SESSION['user'])){
  header("location: ../index.php"); 
  die();
} else {
  if(isset($_SESSION["user"])){
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
</head>

<body class="relative flex flex-col justify-between w-full h-full">
  
<?php require "../components/navbar.php"; ?>

<main class="flex justify-center">

  <form action="../../../routes/articles.php" method="post" class="w-10/12 bg-purple-100 lg:w-3/5" enctype="multipart/form-data">
  
    <div class="p-4 py-8 bg-white shadow">
      <div class="m-5 text-2xl font-bold text-center text-gray-800 bg-white heading">New Article</div>
        <div class="flex flex-col w-10/12 max-w-2xl gap-4 p-4 mx-auto text-gray-800 border border-gray-300 shadow-lg">

          <input name="title" class="p-2 bg-gray-100 border border-gray-300 outline-none title" placeholder="Title:" type="text"
          value="<?= isset($pres) ? $pres["title"] : ""; ?>" />
          
          <input name="category" class="p-2 bg-gray-100 border border-gray-300 outline-none title" placeholder="Category:" type="text"
          value="<?= isset($pres) ? $pres["category"] : ""; ?>" />

          <textarea name="body" class="p-3 bg-gray-100 border border-gray-300 outline-none description sec h-60" placeholder="Article content:"><?= isset($pres) ? $pres["body"] : ""; ?></textarea>
          
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
            <button type="submit" class="p-1 px-4 ml-2 font-semibold text-white bg-purple-500 border border-purple-600 cursor-pointer btn">Post</button>
          </div>
          
        </div>
      </div>
    </div>

  </form>

</main>

<?php require "../components/footer.php"; ?>

</body>
</html>