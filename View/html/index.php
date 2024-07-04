<?php
  require_once "../../session.config.php";

  if(isset($_SESSION["user"])){
    $user = $_SESSION["user"];
  };
?>

<!DOCTYPE html>
<html lang="en" class="relative w-full h-full">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EchoBlogs</title>
  <link rel="stylesheet" href="../css/output.css">
  <script src="../js/main.js" defer></script>
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="relative flex flex-col justify-between w-full h-full">
  
<nav class="z-50 flex justify-between w-auto h-auto p-2 bg-white rounded-lg shadow-lg md:h-16">
  <div class="flex justify-between w-full ">
      <div class="flex items-center w-1/2 px-6 text-2xl font-semibold md:w-1/5 md:px-1 md:flex md:items-center md:justify-center"
      x-transition:enter="transition ease-out duration-300" id="nav-bar-logo">
          <a href="./">Echo<span class="text-purple-600">Blogs</span></a>
      </div>

      <div class="flex-col hidden w-full h-auto md:hidden animate-slideIn" id="nav-list-mobile">
        <div class="flex flex-col items-center justify-center gap-2">
          <a href="./" class="duration-75 hover:text-purple-600">Home</a>
          <a href="" class="duration-75 hover:text-purple-600">About Us</a>
          <a href="" class="duration-75 hover:text-purple-600">Contact</a>
          <?php if(!isset($user)): ?>
            <div class="flex w-full font-semibold justify-evenly">
              <button onclick="toggleLoginForm()" class="hover:text-purple-600">Login</button>
              <button class="p-3 text-white duration-75 bg-purple-600 rounded-xl hover:bg-purple-700" onclick="toggleSignupForm()">Sign Up</button>
            </div>
          <?php else: ?>
            <hr class="block w-full bg-black">
            <div class="relative flex justify-center w-full gap-2 text-lg">
              <p>Welcome,</p>
              <button class="font-semibold text-purple-600 duration-75 hover:underline" onclick="showNavProfileList()">
                <?= $user["full_name"]?>
              </button>
            </div>
            <div class="flex items-center w-full text-center">
              <a href="" class="block w-full px-2 py-1 duration-100">Settings</a>
              <hr>
              <form action="../../routes/logout.php" class="w-full" method="post">
                <button class="w-full px-2 py-1 text-center duration-100 hover:underline">Logout</button>
              </form>
            </div>
          <?php endif ?>
        </div>
      </div>
      <div class="items-center hidden w-3/5 font-semibold justify-evenly md:flex">
        <a href="./" class="duration-75 hover:text-purple-600 hover:border-b-2 hover:border-b-purple-600">Home</a>
        <a href="" class="duration-75 hover:text-purple-600 hover:border-b-2 hover:border-b-purple-600">About Us</a>
        <a href="" class="duration-75 hover:text-purple-600 hover:border-b-2 hover:border-b-purple-600">Contact</a>
      </div>
      <?php if(!isset($user)): ?>
        <div class="items-center hidden w-1/5 font-semibold justify-evenly md:flex">
          <button class="p-3 text-white duration-75 bg-purple-600 rounded-xl hover:bg-purple-700" onclick="toggleSignupForm()">Sign Up</button>
          <button onclick="toggleLoginForm()" class="hover:text-purple-600">Login</button>
        </div>
      <?php else: ?>
        <div class="items-center justify-center hidden w-1/5 gap-2 font-semibold md:flex">
          <p>Welcome,</p>
          <div class="relative w-full" id="navbar-profile-sec">
            <button class="w-full p-3 text-sm text-white duration-75 bg-purple-600 lg:text-base lg rounded-xl hover:bg-purple-700" onclick="showNavProfileList()" id="navbar-profile-sec">
              <?= $user["full_name"]?>
            </button>
            <ul class="absolute flex-col hidden w-full text-black bg-white border-2 rounded-md h-content" id="navbar-profile-list">
              <li>
                <a href="" class="block w-full px-2 py-1 duration-100 hover:bg-purple-400 rounded-t-md">Profile</a>
              </li>
              <li>
                <a href="" class="block w-full px-2 py-1 duration-100 hover:bg-purple-400">Settings</a>
              </li>
              <hr>
              <li>
                <form action="../../routes/logout.php" class="w-full" method="post">
                  <button class="w-full px-2 py-1 duration-100 text-start hover:underline">Logout</button>
                </form>
              </li>
            </ul>
          </div>
        </div>
      <?php endif ?>
      <button class="relative w-10 h-10 text-gray-500 bg-white focus:outline-none md:hidden " @click="open = !open" onclick="toggleNavList()">
          <span class="sr-only">Open div menu</span>
          <div class="absolute block w-5 transform -translate-x-1/2 -translate-y-1/2 left-1/2 top-1/2">
              <span aria-hidden="true" class="block absolute h-0.5 w-5 bg-current transform transition duration-500 ease-in-out button-line -translate-y-1.5"></span>
              <span aria-hidden="true" class="block absolute  h-0.5 w-5 bg-current   transform transition duration-500 ease-in-out button-line"></span>
              <span aria-hidden="true" class="block absolute  h-0.5 w-5 bg-current transform  transition duration-500 ease-in-out button-line translate-y-1.5"></span>
          </div>
      </button>
  </div>

</nav>

<?php if(!isset($user)): ?>
  <?php require_once "./components/registering-forms.php" ?>
<?php endif ?>


<header class="flex flex-col gap-5">
  
  <div class="flex flex-col-reverse md:flex-row md:items-center shadow-shadowAround"  style="background-image: url('../images/Purple Background HD.jpg');">
    <div class="relative flex flex-col items-start justify-center w-full h-full gap-5 px-10 py-6 bg-purple-950 bg-opacity-60 md:w-1/2">
      <h1 class="text-2xl font-semibold text-white">Latest:</h1>
      <div class="md:order-2">
        <h2 class="text-3xl font-medium tracking-wide text-gray-100 md:text-4xl">The best Apple Watch apps</h2>
        <p class="mt-4 text-justify text-gray-300">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aut quia asperiores alias vero magnam recusandae adipisci ad vitae laudantium quod rem voluptatem eos accusantium cumque.</p>
        <div class="flex justify-end mt-6">
            <a href="#" class="inline-block text-lg font-semibold text-right text-white transition-colors duration-200 transform rounded-md hover:text-gray-300">Read more »</a>
        </div>
      </div>
    </div>

    <div class="flex items-center justify-center w-full h-full md:w-1/2">
        <img class="object-cover w-full h-full" src="../images/planeplane.jpg" alt="article thumbnail">
    </div>
  </div>
  
  <div class="flex justify-center w-full p-6 pt-0">
    <form action="#" method="get" class="flex w-full md:max-w-[35rem]">
      <input type="text" name="search" placeholder="Looking for something?" class="w-full px-3 py-2 text-lg border border-gray-600 rounded-l-md focus:outline-none focus:border-gray-900 ">
      <button type="submit" class="px-8 py-2 text-lg text-gray-100 duration-150 bg-purple-800 border border-purple-900 rounded-r-md hover:bg-purple-700"><i class="fa fa-search"></i></button>
    </form>
  </div>
  
</header>

<main>
  <section class="flex flex-col gap-5 p-6 bg-purple-100">
    
    <div class="relative items-center w-full px-5 mx-auto md:px-12 lg:px-24 max-w-7xl">
      <div class="grid w-full grid-cols-1 gap-6 mx-auto lg:grid-cols-2">
        
      <div class="rounded-md">
        <img class="object-cover object-center w-full shadow-md rounded-t-md" src="../images/Purple Background HD.jpg" alt="post thumbnail">
        <section class="p-6">
          <div class="flex justify-between px-2 pb-4 text-sm">
            <a href="?category=Category" class="block text-sm text-purple-900 duration-75 hover:underline">Category</a>
            <time class="block text-gray-500">5 days ago</time>
          </div>
          <h1 class="mx-auto mb-8 text-2xl font-semibold leading-none tracking-tighter text-gray-900 lg:text-3xl"><a href="#">Short headline.</a></h1>
          <p class="mx-auto text-base leading-relaxed text-justify text-gray-800">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
          </p>
          <div class="mt-4">
            <a href="#" class="inline-flex items-center font-semibold text-purple-800 lg:mb-0 hover:text-purple-900" title="read more"> Read More » </a>
          </div>
        </seciton>
      </div>
        
      <div class="duration-200 border border-purple-900 rounded-xl">
        <img class="object-cover object-center w-full lg:h-48 md:h-36 rounded-t-xl" src="https://via.placeholder.com/150" alt="post thumbnail">
        <section class="p-6">
          <time class="block px-2 pb-2 text-sm text-gray-500">5 days ago</time>
          <h1 class="mx-auto mb-8 text-2xl font-semibold leading-none tracking-tighter text-gray-900 lg:text-3xl"><a href="#">Short headline.</a></h1>
          <p class="mx-auto text-base leading-relaxed text-justify text-gray-800">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
          </p>
          <div class="mt-4">
            <a href="#" class="inline-flex items-center mt-4 font-semibold text-purple-800 lg:mb-0 hover:text-purple-900" title="read more"> Read More » </a>
          </div>
        </seciton>
      </div>

      </div>
    </div>
    
    <div class="relative items-center w-full px-5 mx-auto md:px-12 lg:px-24 max-w-7xl">
      <div class="grid w-full grid-cols-1 gap-6 mx-auto lg:grid-cols-3">
        
      <div class="duration-200 border border-purple-900 rounded-xl">
        <img class="object-cover object-center w-full lg:h-48 md:h-36 rounded-t-xl" src="https://via.placeholder.com/150" alt="post thumbnail">
        <section class="p-6">
          <time class="block px-2 pb-2 text-sm text-gray-500">5 days ago</time>
          <h1 class="mx-auto mb-8 text-2xl font-semibold leading-none tracking-tighter text-gray-900 lg:text-3xl"><a href="#">Short headline.</a></h1>
          <p class="mx-auto text-base leading-relaxed text-justify text-gray-800">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
          </p>
          <div class="mt-4">
            <a href="#" class="inline-flex items-center mt-4 font-semibold text-purple-800 lg:mb-0 hover:text-purple-900" title="read more"> Read More » </a>
          </div>
        </seciton>
      </div>
        
      <div class="duration-200 border border-purple-900 rounded-xl">
        <img class="object-cover object-center w-full lg:h-48 md:h-36 rounded-t-xl" src="https://via.placeholder.com/150" alt="post thumbnail">
        <section class="p-6">
          <time class="block px-2 pb-2 text-sm text-gray-500">5 days ago</time>
          <h1 class="mx-auto mb-8 text-2xl font-semibold leading-none tracking-tighter text-gray-900 lg:text-3xl"><a href="#">Short headline.</a></h1>
          <p class="mx-auto text-base leading-relaxed text-justify text-gray-800">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
          </p>
          <div class="mt-4">
            <a href="#" class="inline-flex items-center mt-4 font-semibold text-purple-800 lg:mb-0 hover:text-purple-900" title="read more"> Read More » </a>
          </div>
        </seciton>
      </div>

      <div class="duration-200 border border-purple-900 rounded-xl">
        <img class="object-cover object-center w-full lg:h-48 md:h-36 rounded-t-xl" src="https://via.placeholder.com/150" alt="post thumbnail">
        <section class="p-6">
          <time class="block px-2 pb-2 text-sm text-gray-500">5 days ago</time>
          <h1 class="mx-auto mb-8 text-2xl font-semibold leading-none tracking-tighter text-gray-900 lg:text-3xl"><a href="#">Short headline.</a></h1>
          <p class="mx-auto text-base leading-relaxed text-justify text-gray-800">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
          </p>
          <div class="mt-4">
            <a href="#" class="inline-flex items-center mt-4 font-semibold text-purple-800 lg:mb-0 hover:text-purple-900" title="read more"> Read More » </a>
          </div>
        </seciton>
      </div>

      </div>
    </div>
    
  </section>
</main>

<footer class="w-full p-4 mt-6 mb-0 text-lg text-gray-200 bg-purple-800">
  <div class="text-center">
    <p>
      Copyright © 2022 - <a class="font-semibold" href="https://Ammargoher369@gmail.com">Ammar Goher</a>
    </p>
  </div>
</footer>

</body>
</html>