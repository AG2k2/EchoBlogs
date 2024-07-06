<div class="absolute px-3 py-2 text-white bg-purple-950 right-3 bottom-3 rouded-md" id="flash-mesage z-50">
  <p class="text-lg"><?= $_SESSION["flash"] ?></p>
</div>

<script defer>
  const flashMsg = document.getElementById("flash-message");
  flashMsg.classList.add("hidden");
  setTimeout(() => {
  }, 5000);
</script>
