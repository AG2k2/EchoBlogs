<div class="flex flex-col bg-purple-200 rounded-md shadow-md">
  <?php if ($article["thumbnail"] !== null): ?>
    <img class="object-cover object-center w-full shadow-md rounded-t-md" src="../images/thumbnails/<?= $article["thumbnail"]?>" alt="post thumbnail">
  <?php endif; ?>
  <section class="p-6">
    <div class="flex justify-between px-2 pb-4 text-sm">
      <a href="?category=<?= $article["category"] ?>" class="block text-sm text-purple-900 duration-75 hover:underline"><?= $article["category"] ?></a>
      <time class="block text-gray-500"><?= $article["created_at"] ?></time>
    </div>
    <h1 class="mx-auto mb-8 text-2xl font-semibold leading-none tracking-tighter text-gray-900 lg:text-3xl"><a href="./articles/index.php?slug=<?= $article["slug"] ?>"><?= $article["title"] ?></a></h1>
    <article class="flex flex-col items-start justify-start gap-2 overflow-hidden max-h-36 indent-3">
      <p class="text-base leading-relaxed text-justify text-gray-800">
        <?= str_replace( "\n", "</p><p class='text-base leading-relaxed text-justify text-gray-800'>", $article["body"]) ?>
      </p>
    </article>
    <div class="mt-4">
      <a href="./articles/index.php?slug=<?= $article["slug"] ?>" 
      class="inline-flex items-center font-semibold text-purple-800 lg:mb-0 hover:text-purple-900" 
      title="read more"> Read More » </a>
    </div>
    <hr class="h-[2px] bg-gray-400 my-3">
    <div class="flex justify-between w-full gap-4">
      <img src="../images/<?= $article["author"]["pro_pic"] ?>" alt="profiles picture" class="text-sm rounded-full h-14 md:h-12 w-14 md:w-12">
      <h1 class="flex items-center w-full font-semibold"><?= $article["author"]["first_name"] . " " . $article["author"]["last_name"] ?></h1>
    </div>
  </seciton>
</div>