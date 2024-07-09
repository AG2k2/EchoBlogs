
<?php 

if(isset($_SESSION["flash"])){
  $flash = $_SESSION["flash"];
  unset($_SESSION["flash"]);
} else {
  die();
};

?>

<div class="fixed z-50 px-3 py-2 text-white bg-purple-950 right-3 bottom-3 rouded-md" id="flash-mesage">
  <p class="text-lg"><?= $flash ?></p>
</div>
