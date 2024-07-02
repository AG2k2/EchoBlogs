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
  <!-- nav bar -->
<nav x-data="{ open: false }"  class="flex justify-between w-auto h-auto bg-white rounded-lg shadow-lg md:h-16">
  <div class="flex justify-between w-full ">
      <div class="flex items-center w-1/2 px-6 text-2xl font-semibold md:w-1/5 md:px-1 md:flex md:items-center md:justify-center"
      x-transition:enter="transition ease-out duration-300" id="nav-bar-logo">
          <a href="./">Echo<span class="text-purple-600">Blogs</span></a>
      </div>

      <div  
      x-transition:enter="transition ease-in-out duration-300"
      class="flex-col hidden w-full h-auto md:hidden" id="nav-list-mobile">
          <div class="flex flex-col items-center justify-center gap-2">
              <a href="./" class="duration-75 hover:text-purple-600 hover:border-b-2 hover:border-b-purple-600">Home</a>
              <a href="" class="duration-75 hover:text-purple-600 hover:border-b-2 hover:border-b-purple-600">About Us</a>
              <a href="" class="duration-75 hover:text-purple-600 hover:border-b-2 hover:border-b-purple-600">Contact</a>
              <button class="p-3 duration-75 bg-purple-600 rounded-xl hover:bg-purple-700" onclick="toggleSignupForm()">Sign Up</button>
              <button onclick="toggleLoginForm()">Login</button>
          </div>
      </div>
      <div class="items-center hidden w-3/5 font-semibold justify-evenly md:flex">
        <a href="./" class="duration-75 hover:text-purple-600 hover:border-b-2 hover:border-b-purple-600">Home</a>
        <a href="" class="duration-75 hover:text-purple-600 hover:border-b-2 hover:border-b-purple-600">About Us</a>
        <a href="" class="duration-75 hover:text-purple-600 hover:border-b-2 hover:border-b-purple-600">Contact</a>
      </div>
      <div class="items-center hidden w-1/5 font-semibold justify-evenly md:flex">
        <button class="p-3 text-white duration-75 bg-purple-600 rounded-xl hover:bg-purple-700" onclick="toggleSignupForm()">Sign Up</button>
        <button onclick="toggleLoginForm()">Login</button>
      </div>
      <button class="relative w-10 h-10 text-gray-500 bg-white focus:outline-none md:hidden " @click="open = !open" onclick="toggleList()">
          <span class="sr-only">Open div menu</span>
          <div class="absolute block w-5 transform -translate-x-1/2 -translate-y-1/2 left-1/2 top-1/2">
              <span aria-hidden="true" class="block absolute h-0.5 w-5 bg-current transform transition duration-500 ease-in-out button-line -translate-y-1.5"></span>
              <span aria-hidden="true" class="block absolute  h-0.5 w-5 bg-current   transform transition duration-500 ease-in-out button-line"></span>
              <span aria-hidden="true" class="block absolute  h-0.5 w-5 bg-current transform  transition duration-500 ease-in-out button-line translate-y-1.5"></span>
          </div>
      </button>
  </div>

</nav>

<div class="hidden absolute top-0 left-0 bg-opacity-[92%] mx-auto animate-slideIn h-full w-full items-center justify-center bg-gray-900 text-white duration-200" id="login-form">
  <div class="flex w-[30rem] flex-col space-y-10">
    <div class="text-4xl font-medium text-center">Log In</div>
    <div class="w-full text-lg duration-300 transform bg-transparent border-b-2 focus-within:border-purple-500">
      <input type="text"
        name="username"
        placeholder="Username:"
        class="w-full bg-transparent border-none outline-none placeholder:italic focus:outline-none"/>
    </div>

    <div class="w-full text-lg duration-300 transform bg-transparent border-b-2 focus-within:border-purple-500">
      <input type="password"
        name="username"
        placeholder="Password:"
        class="w-full bg-transparent border-none outline-none placeholder:italic focus:outline-none"/>
    </div>

    <button class="py-2 font-bold duration-300 transform bg-purple-600 rounded-sm hover:bg-purple-400">
      LOG IN
    </button>
    <button class="py-2 font-bold duration-300 transform bg-purple-600 rounded-sm hover:bg-purple-400" onclick="toggleLoginForm()">
      Cancel
    </button>

    <p class="text-lg text-center">
      No account?
      <a href="#" class="font-medium text-purple-500 underline-offset-4 hover:underline">Create One</a>
    </p>
  </div>
</div>

<div class="hidden absolute top-0 left-0 bg-opacity-[92%] mx-auto animate-slideIn h-full w-full items-center justify-center bg-gray-900 text-white duration-200" id="signup-form">
  <div class="flex w-[30rem] flex-col space-y-10">
    <div class="text-4xl font-medium text-center">Sign up</div>

    <div class="flex justify-between gap-3">
      <div class="w-full text-lg duration-300 transform bg-transparent border-b-2 focus-within:border-purple-500">
        <input type="text"
          name="first_name"
          placeholder="First Name:"
          class="w-full bg-transparent border-none outline-none placeholder:italic focus:outline-none"/>
      </div>
      <div class="w-full text-lg duration-300 transform bg-transparent border-b-2 focus-within:border-purple-500">
        <input type="text"
          name="last_name"
          placeholder="Last Name:"
          class="w-full bg-transparent border-none outline-none placeholder:italic focus:outline-none"/>
      </div>
    </div>

    <div class="w-full text-lg duration-300 transform bg-transparent border-b-2 focus-within:border-purple-500">
      <input type="text"
        name="username"
        placeholder="Username:"
        class="w-full bg-transparent border-none outline-none placeholder:italic focus:outline-none"/>
    </div>

    <div class="w-full text-lg duration-300 transform bg-transparent border-b-2 focus-within:border-purple-500">
      <input type="email"
        name="email"
        placeholder="Email:"
        class="w-full bg-transparent border-none outline-none placeholder:italic focus:outline-none"/>
    </div>

    <div class="w-full text-lg duration-300 transform bg-transparent border-b-2 focus-within:border-purple-500">
      <input type="date"
        name="birth_date"
        
        class="w-full bg-transparent border-none outline-none placeholder:italic focus:outline-none"/>
    </div>

    <div class="w-full text-lg duration-300 transform bg-transparent border-b-2 focus-within:border-purple-500">
      <input type="password"
        name="pswrd"
        placeholder="Password:"
        class="w-full bg-transparent border-none outline-none placeholder:italic focus:outline-none"/>
    </div>

    <div class="w-full text-lg duration-300 transform bg-transparent border-b-2 focus-within:border-purple-500">
      <input type="password"
        name="confirm_pswrd"
        placeholder="Confirm password:"
        class="w-full bg-transparent border-none outline-none placeholder:italic focus:outline-none"/>
    </div>

    <button class="py-2 font-bold duration-300 transform bg-purple-600 rounded-sm hover:bg-purple-400">
      SIGN UP
    </button>
    <button class="py-2 font-bold duration-300 transform bg-purple-600 rounded-sm hover:bg-purple-400" onclick="toggleSignupForm()">
      Cancel
    </button>

    <p class="text-lg text-center">
      Have account?
      <a href="#" class="font-medium text-purple-500 underline-offset-4 hover:underline">Log in</a>
    </p>
  </div>
</div>

<header class="flex flex-col gap-5 p-6">
  
  <div class="flex flex-col-reverse md:h-[25rem] md:flex-row md:items-center bg-purple-900 shadow-shadowAround">
    <div class="flex flex-col items-start w-full gap-5 px-10 py-6 md:w-1/2">
      <h1 class="text-2xl font-semibold text-white">Latest:</h1>
      <div class="max-w-lg md:order-2">
        <h2 class="text-3xl font-medium tracking-wide text-gray-100 md:text-4xl">The best Apple Watch apps</h2>
        <p class="mt-4 text-justify text-gray-300">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aut quia asperiores alias vero magnam recusandae adipisci ad vitae laudantium quod rem voluptatem eos accusantium cumque.</p>
        <div class="flex justify-end mt-6">
            <a href="#" class="inline-block text-lg font-semibold text-right text-white transition-colors duration-200 transform rounded-md hover:text-gray-300">Read more »</a>
        </div>
      </div>
    </div>

    <div class="flex items-center justify-center w-full h-full md:w-1/2">
        <img class="object-cover w-full h-full" src="https://images.unsplash.com/photo-1579586337278-3befd40fd17a?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1352&q=80" alt="article thumbnail">
    </div>
  </div>
  
  <div class="flex justify-center w-full px-6">
    <form action="#" method="get" class="flex w-full md:max-w-[35rem]">
      <input type="text" name="search" placeholder="Looking for something?" class="w-full px-3 py-2 text-lg border border-gray-600 rounded-l-md focus:outline-none focus:border-gray-900 ">
      <button type="submit" class="px-8 py-2 text-lg text-gray-100 duration-150 bg-purple-800 border border-purple-900 rounded-r-md hover:bg-purple-700"><i class="fa fa-search"></i></button>
    </form>
  </div>
  
</header>

<main>
  <section class="flex flex-col gap-5">
    
    <div class="relative items-center w-full px-5 mx-auto md:px-12 lg:px-24 max-w-7xl">
      <div class="grid w-full grid-cols-1 gap-6 mx-auto lg:grid-cols-2">
        
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