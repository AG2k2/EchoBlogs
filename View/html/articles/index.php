<?php 
  
  require_once "../../../session.config.php";
  require_once "../../../db-connection.php";
  require_once "../../../Models/Articles.php";
  require_once "../../../Controllers/articleController.php";

  if(isset($_SESSION["user"])){
    $user = $_SESSION["user"];
  };

  $currentArticle = show_current_article($connection);

  $articles = get_all_articles($connection);

?>

<!DOCTYPE html>
<html lang="en" class="relative w-full h-full">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EchoBlogs</title>
  <link rel="stylesheet" href="../../css/output.css">
  <script src="../../js/main.js" defer></script>
</head>

<body class="relative flex flex-col justify-between w-full h-full">
  
<?php require "../components/navbar.php"; ?>

<main class="w-full h-full ">

<section class="flex flex-col items-center justify-center w-full min-h-full p-5 bg-purple-100 lg:items-start lg:flex-row">

  <div class="w-[90%] lg:w-[65%] h-full bg-white flex flex-col p-5 gap-5 rounded-md">
    <div class="flex items-center justify-between w-full">
      <a href="/EchoBlogs/View/html" class="text-xl text-purple-500 hover:text-purple-600">« Back to articles</a>
      <?php if(isset($user) && $user["id"] === $currentArticle["author"]["id"]): ?>
        <div class="flex gap-3 text-sm font-semibold">
          <a href="./update.php?slug=<?= $currentArticle["slug"] ?>" class="hover:underline">Edit</a>
          <p>|</p>
          <button class="text-red-600" class="hover:underline" onclick="showDeletionForm()">Delete</button>
        </div>
      <?php endif ?>
    </div>
    <h1 class="text-4xl font-bold"><?= $currentArticle["title"] ?></h1>
    <div class="flex justify-between px-2 text-lg">
        <a href="/EchoBlogs/View/html/index.php?category=<?= $thumbnail["category"] ?>" class="block text-purple-900 duration-75 hover:underline"><?= $currentArticle["category"] ?></a>
        <time class="block text-gray-500"><?= $currentArticle["created_at"] ?></time>
      </div>
    <?php if($currentArticle["thumbnail"] !== null): ?>
      <img src="../../images/thumbnails/<?= $currentArticle["thumbnail"] ?>" alt="article thumbnails" class="rounded-md">
    <?php endif ?>
    <p class="text-xl indent-3">
      <?= $currentArticle["body"] ?>
    </p>
  </div>

  <div class="hidden lg:flex flex-col lg:w-[35%] p-4">
    <h1 class="text-xl font-semibold">Our Latest articles:</h1>
    <ul class="flex flex-col gap-3 px-6 py-3">
      <?php if($articles !== null): ?>
        <?php $limit = count($articles) > 14 ? 15 : count($articles); ?>
        <?php for($i = 0; $i < $limit; $i++): ?>
          <?php $article = $articles[$i]; ?>
          <li>
            <?php if($article["slug"] == $currentArticle["slug"]): ?>
              <p class="text-lg font-semibold text-gray-500">
                <?= $article["title"] ?>
              </p>
            <?php else: ?>
              <a href="./index.php?slug=<?= $article["slug"] ?>" 
              class="text-lg font-semibold ">
                <?= $article["title"] ?>
              </a>
            <?php endif ?>
          </li>
        <?php endfor; ?>
      <?php endif ?>
    </ul>
  </div>

  <?php if(isset($user) && $user["id"] === $currentArticle["author"]["id"]): ?>
    <div class="absolute items-center justify-center hidden w-full bg-gray-600 h-96 bg-opacity-90" id="deletion-form">
      <form action="../../../routes/articles.php" 
        method="post" 
        class="bg-white rounded-md p-4 w-[80%] lg:w-[40%] min-h-24 flex flex-col justify-center items-center gap-4">
        <input type="hidden" name="real_method" value="delete">  
        <input type="hidden" name="article_id" value="<?= $currentArticle["id"] ?>">
        <input type="hidden" name="slug" value="<?= $currentArticle["slug"] ?>">
        <label for="pswrd">Enter your password to confirm deletion:</label>
        <input type="password" name="pswrd" class="w-[80%] border border-purple-800 focus:outline-none px-2 py-1 rounded-md bg-gray-100">
        <div class="self-end">
          <button type="button" class="p-2 text-sm text-white bg-gray-900 rounded-lg hover:bg-gray-800" onclick="showDeletionForm()">Cancel</button>
          <button class="p-2 text-sm text-white bg-red-600 rounded-lg hover:bg-red-700 ">Delete</button>
        </div>
      </form>
    </div>
  <?php endif ?>

</section>

<section>
  
</section>

</main>

<?php require "../components/footer.php"; ?>

<?php if(isset($_SESSION["flash"])):
  require "../components/flash-messge.php";
endif ?>

</body>
</html>