<?php
  require_once "../../session.config.php";
  require_once "../../db-connection.php";
  require_once "../../Models/Articles.php";
  require_once "../../Controllers/articleController.php";


  if(isset($_SESSION["user"])){
    $user = $_SESSION["user"];
  };

  if(isset($_GET["search_query"]) || isset($_GET["category"])){
    $articles = show_articles($connection);
  } else {
    $articles = get_all_articles($connection);
  };

?>

<!DOCTYPE html>
<html lang="en" class="relative w-full h-full">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EchoArticle</title>
  <link rel="stylesheet" href="../css/output.css">
  <script src="../js/main.js" defer></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="relative flex flex-col justify-between w-full h-full">
  
<?php require "./components/navbar.php"; ?>

<?php if(!isset($user)): ?>
  <?php require_once "./components/registering-forms.php" ?>
<?php endif ?>


<header class="flex flex-col gap-5">
  
  <div class="flex flex-col-reverse md:flex-row md:items-center shadow-shadowAround"  style="background-image: url('../images/Purple Background HD.jpg');">
    <?php if($articles && !isset($_GET["search_query"]) && !isset($_GET["category"])): ?>
      <div class="relative flex flex-col items-start justify-center h-full gap-5 px-10 py-6 bg-purple-950 bg-opacity-60 <?= $articles[0]['thumbnail'] !== null ? 'w-full' : 'w-full lg:w-[70%] mx-auto' ; ?>">
        <h1 class="text-2xl font-semibold text-white">Latest article:</h1>
        <div class="flex flex-col w-full gap-2 md:order-2">
          <h2 class="text-3xl font-medium tracking-wide text-gray-100 md:text-4xl">
            <a href="./articles/index.php?slug=<?= $articles[0]["slug"] ?>"><?= $articles[0]["title"]; ?></a>
          </h2>
          <article class="flex flex-col items-start gap-2 mt-4 overflow-hidden text-justify text-gray-300 max-h-36 indent-3">
            <p class="">
              <?= str_replace( "\n", "</p><p>", $articles[0]["body"]); ?>
            </p>
          </article>
          <div class="flex justify-end mt-6">
              <a href="./articles/index.php?slug=<?= $articles[0]["slug"] ?>" class="inline-block text-lg font-semibold text-right text-white transition-colors duration-200 transform rounded-md hover:text-gray-300">
                Read more »
              </a>
          </div>
          <hr class="bg-gray-100 hight-2">
          <div class="text-white">
            <h2 class="mb-2 text-lg">By:</h2>
            <div class="flex items-center justify-start gap-2 font-semibold">
              <img src="../images/<?= $articles[0]["author"]["pro_pic"] ?>" alt="profile picture" class="w-10 h-10 rounded-full">
              <h3><?= $articles[0]["author"]["first_name"] . " " . $articles[0]["author"]["last_name"] ?></h3>
            </div>
          </div>
        </div>
      </div>
      <?php if($articles[0]["thumbnail"] !== null): ?>
        <div class="flex items-center justify-center w-full h-full">
          <img class="object-cover w-full h-full" src="../images/thumbnails/<?= $articles[0]["thumbnail"] ?>" alt="article thumbnail">
        </div>
      <?php endif; ?>
    <?php endif ?>
  </div>
  
  <div class="flex justify-center w-full p-6 pt-0">
    <form action="" method="get" class="flex w-full md:max-w-[35rem]">
      <input type="text" name="search_query" placeholder="Looking for something?" class="w-full px-3 py-2 text-lg border border-gray-600 rounded-l-md focus:outline-none focus:border-gray-900 ">
      <button type="submit" class="px-8 py-2 text-lg text-gray-100 duration-150 bg-purple-800 border border-purple-900 rounded-r-md hover:bg-purple-700"><i class="fa fa-search"></i></button>
    </form>
  </div>
  
</header>

<main class="mb-4">
  <section class="flex flex-col gap-5 p-6 bg-purple-100">

    <?php if(isset($user)): ?>
      <div class="flex justify-end">
        <a href="./articles/create.php" class="px-3 py-1 text-lg duration-150 bg-purple-200 rounded-md hover:bg-purple-300">Add a new article</a>
      </div>
    <?php endif; ?>

    <div class="relative items-center w-full px-5 mx-auto md:px-12 lg:px-24 max-w-7xl">
      <div class="grid w-full grid-cols-1 gap-6 mx-auto lg:grid-cols-2">
        
        <?php if($articles && count($articles) > 1 && !(isset($_GET["search_query"]) || isset($_GET["category"]))): ?>
          <?php $article = $articles[1]; ?>
          <?php require "./components/article-card.php"; ?>
          <?php if(count($articles) > 2): ?>
            <?php $article = $articles[2]; ?>
            <?php require "./components/article-card.php"; ?>
          <?php endif ?>
        <?php elseif(!($articles && (isset($_GET["search_query"]) || isset($_GET["category"])))): ?>
            <p class="w-full col-span-2 text-xl text-center">No articles yet</p>
        <?php endif; ?>

      </div>
    </div>

    <?php if($articles && count($articles) > 3 && !(isset($_GET["search_query"]) || isset($_GET["category"]))): ?>
      <div class="relative items-center w-full px-5 mx-auto md:px-12 lg:px-24 max-w-7xl">
        <div class="grid w-full grid-cols-1 gap-6 mx-auto lg:grid-cols-3">
          <?php for($i = 3; $i < count($articles); $i ++): ?>
            <?php $article = $articles[$i]; ?>
            <?php require "./components/article-card.php"; ?>
          <?php endfor; ?>
        </div>
      </div>
    <?php endif ?>

    <?php if( $articles && (isset($_GET["search_query"]) || isset($_GET["category"])) ): ?>
      <div class="relative items-center w-full px-5 mx-auto md:px-12 lg:px-24 max-w-7xl">
        <div class="grid w-full grid-cols-1 gap-6 mx-auto lg:grid-cols-3">
          <?php foreach($articles as $article): ?>
            <?php require "./components/article-card.php"; ?>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>
    
  </section>
</main>

<?php require "./components/footer.php"; ?>

</body>
</html>