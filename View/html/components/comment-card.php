<div class="flex">
  <div class="flex mr-3">
    <img class="w-10 h-10 mt-2 rounded-full sm:w-12 sm:h-12" src="../../images/<?= $comment["author"]["pro_pic"] ?>" alt="author picture">
  </div>
  <div class="flex flex-col flex-1 px-4 py-2 leading-relaxed border rounded-lg bg-gray-50 sm:px-6 sm:py-4">
    <strong><?= $comment["author"]["first_name"] . " " . $comment["author"]["last_name"] ?></strong> <span class="text-xs text-gray-400"><?= $comment["created_at"] ?></span>
    <p class="p-3 text-sm">
      <?= $comment["body"] ?>
    </p>
    <button class="self-end px-2 text-sm font-semibold text-gray-500 hover:underline" onclick="showReplyForm<?= $comment["id"] ?>()">
      Reply
    </button>

    <form action="../../../routes/comments.php" method="post" class="hidden w-full my-6" id="reply-form-<?= $comment["id"] ?>">
        <div class="px-4 py-2 mb-4 bg-white border border-gray-200 rounded-lg rounded-t-lg">
          <textarea id="comment" name="body" rows="6"
          class="w-full px-0 text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none " style="resize: none;"
          placeholder="Reply to <?= $comment["author"]["first_name"] ?> comment..." required></textarea>
        </div>
        <button type="submit"
          class="inline-flex float-end items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-purple-600 bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-primary-800">
          Reply
        </button>
        <input type="hidden" name="slug" value="<?= $currentArticle["slug"] ?>">
        <input type="hidden" name="post_id" value="<?= $currentArticle["id"] ?>">
        <input type="hidden" name="comment_id" value="<?= $comment["id"] ?>">
    </form>
    
    <?php if($comment["replies"] !== null): ?>
      <hr class="w-full my-2">
      <h4 class="my-4 text-xs font-bold tracking-wide text-gray-400 uppercase">Replies</h4>
      <div class="space-y-4">
        <?php foreach($comment["replies"] as $reply): ?>
          <div class="flex">
            <div class="flex mr-3">
              <img class="w-8 h-8 mt-3 rounded-full sm:w-10 sm:h-10" src="../../images/<?= $reply["author"]["pro_pic"] ?>" alt="profile picture" />
            </div>
            <div class="flex-1 px-4 py-2 leading-relaxed bg-gray-200 rounded-lg sm:px-6 sm:py-4">
              <strong><?= $reply["author"]["first_name"] . " " . $reply["author"]["last_name"] ?></strong>
              <span class="text-xs text-gray-400"><?= $reply["created_at"] ?></span>
              <p class="p-2 text-xs sm:text-sm">
                <?= $reply["body"] ?>
              </p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif ?>

    <?php if(isset($user) && $user["id"] === $currentArticle["author"]["id"]): ?>
      
    <?php endif ?>
  </div>
</div>

<script>
  const replyForm<?= $comment["id"] ?> = document.getElementById("reply-form-<?= $comment["id"] ?>");
  const showReplyForm<?= $comment["id"] ?> = () => {replyForm<?= $comment["id"] ?>.classList.toggle("hidden");}
</script>