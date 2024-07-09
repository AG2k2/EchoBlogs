<?php 

require_once "../../../session.config.php";
require_once "../../../db-connection.php";
require_once "../../../Models/User.php";
require_once "../../../Controllers/userController.php";

  if(!isset($_GET["username"]) || !isset($_SESSION["user"])){
    header("location: ../index.php");
    die();
  } else {
    if($_GET["username"] !== $_SESSION["user"]["username"]){
      header("location: ./settings.php?username=" . $_SESSION["user"]["username"]);
      die();
    } else {
      $user = $_SESSION["user"];
    };
  };

  if(isset($_SESSION["profile_update_errors"])){

    $errors = $_SESSION["profile_update_errors"];
    unset($_SESSION["profile_update_errors"]);
    
} else if(isset($_SESSION["change_password_errors"])){

    $pswrdErrors = $_SESSION["change_password_errors"];
    unset($_SESSION["change_password_errors"]);

} else if (isset($_SESSION["profile_delete_error"])){

    $delError = $_SESSION["profile_delete_error"];
    unset($_SESSION["profile_delete_error"]);
    
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

<body class="relative flex flex-col justify-between w-full min-h-full">

<?php require "../components/navbar.php"; ?>

<main class="flex flex-col items-center w-full min-h-screen py-1">
<div class="p-2 md:p-4 w-[90%] md:w-[60%]">
    <div class="w-full px-6 pb-8 mt-8 sm:max-w-xl sm:rounded-lg">
        <h2 class="pl-6 text-2xl font-bold sm:text-xl">Public Profile</h2>

            <form action="../../../routes/users.php" method="post" enctype="multipart/form-data">
                <div class="grid max-w-2xl mx-auto mt-8">
                    <div class="flex flex-col items-center space-y-5 sm:flex-row sm:space-y-0">
    
                        <img class="object-cover w-40 h-40 p-1 rounded-full ring-2 ring-purple-800"
                            src="../../images/<?= $user["pro_pic"] ?>"
                            alt="Bordered avatar" id="preview_pro_picture">
    
                        <div class="flex flex-col space-y-5 sm:ml-8">
                            <input type="file" type="image/*" name="pro_pic" id="pro_pic"
                                class="py-3.5 px-7 text-sm font-medium text-purple-100 w-full focus:outline-none bg-purple-700 rounded-lg border border-purple-200 hover:bg-purple-900 focus:z-10 focus:ring-4 focus:ring-purple-200" placeholder="Change Picture" value>
                        </div>
                    </div>
    
                    <div class="items-center mt-8 sm:mt-14 text-[#202142]">
    
                        <div
                        class="flex flex-col items-center w-full mb-2 space-x-0 space-y-2 sm:flex-row sm:space-x-4 sm:space-y-0 sm:mb-6">
                            <div class="w-full">
                                <label for="first_name"
                                class="block mb-2 text-sm font-medium text-purple-900 ">First name:</label>
                                <input type="text" id="first_name" name="first_name"
                                class="bg-purple-50 border border-purple-300 text-purple-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 "
                                value="<?= $user["first_name"] ?>" required>
                            </div>
    
                            <div class="w-full">
                                <label for="last_name"
                                class="block mb-2 text-sm font-medium text-purple-900 ">
                                    Last name:</label>
                                <input type="text" id="last_name" name="last_name"
                                class="bg-purple-50 border border-purple-300 text-purple-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 "
                                value="<?= $user["last_name"] ?>" required>
                            </div>
    
                      </div>
                        <input type="hidden" name="real_method" value="update">
                      <div class="mb-2 sm:mb-6">
                          <label for="email"
                              class="block mb-2 text-sm font-medium text-purple-900 ">Email:</label>
                          <input type="email" id="email" name="email"
                              class="bg-purple-50 border border-purple-300 text-purple-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 "
                              value="<?= $user["email"] ?>" required>
                      </div>
    
                      <div class="mb-2 sm:mb-6">
                          <label for="username"
                              class="block mb-2 text-sm font-medium text-purple-900 ">Username:</label>
                          <input type="text" id="username" name="username"
                              class="bg-purple-50 border border-purple-300 text-purple-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 "
                              value="<?= $user["username"] ?>" required>
                      </div>
    
                      <div class="mb-2 sm:mb-6">
                          <label for="birth_date"
                              class="block mb-2 text-sm font-medium text-purple-900 ">Birth date:</label>
                          <input type="date" id="birth_date" name="birth_date"
                              class="bg-purple-50 border border-purple-300 text-purple-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 "
                              value="<?= $user["birth_date"] ?>" required>
                      </div>
                      
                      <div class="mb-2 sm:mb-6">
                          <label for="gender"
                              class="block mb-2 text-sm font-medium text-purple-900 ">Gender:</label>
                              <select name="gender" id="gender" class="bg-purple-50 border border-purple-300 text-purple-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 ">
                            <option value="male">M</option>
                            <option value="female">F</option>
                        </select>
                    </div>
    
                    <hr class="my-2">
    
                    <div class="mb-2 sm:mb-6">
                        <label for="pswrd"
                            class="block mb-2 text-sm font-medium text-purple-900 ">Enter your password to confirm changes:</label>
                        <input type="password" id="pswrd" name="pswrd"
                            class="bg-purple-50 border border-purple-300 text-purple-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 "
                            required>
                    </div>

                    <ul>
                    <?php if (isset($errors)):
                        foreach ($errors as $error): ?>
                            <li class="my-2 text-lg text-red-600">
                            * <?= $error ?>
                            </li>
                        <?php endforeach;
                        endif;?>
                    </ul>
    
                      <div class="flex justify-end">
                        <button type="submit"
                            class="text-white bg-purple-700  hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Save changes
                        </button>
                      </div>
    
                  </div>
              </div>
          </form>
      </div>
  </div>

  <hr class="h-0.5 w-[90%] bg-purple-950">

  <div class="p-2 md:p-4 w-[90%] md:w-[60%]">
    <div class="w-full px-6 pb-8 mt-8 sm:max-w-xl sm:rounded-lg">
        <h2 class="pl-6 text-2xl font-bold sm:text-xl">Change password:</h2>

          <form action="../../../routes/users.php" method="post" enctype="multipart/form-data">
              <div class="grid max-w-2xl mx-auto mt-8">
    
                <div class="mb-2 sm:mb-6">
                    <label for="old_pswrd"
                        class="block mb-2 text-sm font-medium text-purple-900 ">Old password:</label>
                    <input type="password" id="old_pswrd" name="old_pswrd"
                        class="bg-purple-50 border border-purple-300 text-purple-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 " required/>
                </div>
                <div class="mb-2 sm:mb-6">
                    <label for="new_pswrd"
                        class="block mb-2 text-sm font-medium text-purple-900 ">New password:</label>
                    <input type="password" id="new_pswrd" name="new_pswrd"
                        class="bg-purple-50 border border-purple-300 text-purple-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 "/>
                </div>
                <div class="mb-2 sm:mb-6">
                    <label for="confirm_pswrd"
                        class="block mb-2 text-sm font-medium text-purple-900 ">Repeat new password:</label>
                    <input type="password" id="confirm_pswrd" name="confirm_pswrd"
                        class="bg-purple-50 border border-purple-300 text-purple-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 " required/>
                </div>
    
                      <input type="hidden" name="real_method" value="change_password">

                    <ul>
                    <?php if (isset($pswrdErrors)):
                        foreach ($pswrdErrors as $error): ?>
                            <li class="my-2 text-lg text-red-600">
                            * <?= $error ?>
                            </li>
                        <?php endforeach;
                        endif;?>
                    </ul>
    
                      <div class="flex justify-end">
                        <button type="submit"
                            class="text-white bg-purple-700  hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Save changes
                        </button>
                      </div>
    
                  </div>
              </div>
          </form>
      </div>
  </div>

  <hr class="h-0.5 w-[90%] bg-purple-950">

  <div class="p-2 md:p-4 w-[90%] md:w-[60%]">
    <div class="w-full px-6 pb-8 mt-8 sm:max-w-xl sm:rounded-lg">
        <h2 class="pl-6 text-2xl font-bold sm:text-xl">Delete account:</h2>

          <form action="../../../routes/users.php" method="post" enctype="multipart/form-data">
              <div class="grid max-w-2xl mx-auto mt-8">
    
                <div class="mb-2 sm:mb-6">
                    <label for="del_pswrd"
                        class="block mb-2 text-sm font-medium text-purple-900 ">Enter your password to confirm deletion:</label>
                    <input type="password" id="del_pswrd" name="del_pswrd"
                        class="bg-purple-50 border border-purple-300 text-purple-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 " required/>
                </div>
                <p class="text-red-700">Please note that this deletion is permanent.</p>
    
                      <input type="hidden" name="real_method" value="delete">

                    <?php if (isset($delErrors)): ?>
                        <p class="text-lg text-red-600">* <?= $delError ?></p>
                    <?php endif; ?>
    
                      <div class="flex justify-end">
                        <button type="submit"
                            class="text-white bg-red-600  hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Delete account
                        </button>
                      </div>
    
                  </div>
              </div>
          </form>
      </div>
  </div>
  
</main>

<?php require "../components/footer.php"; ?>

<?php require "../components/flash-messge.php"; ?>

</body>
</html>