<nav class="z-50 flex justify-between w-auto h-auto p-2 bg-white rounded-lg shadow-lg md:h-16">
  <div class="flex justify-between w-full ">
      <div class="flex items-center w-1/2 px-6 text-2xl font-semibold md:w-1/5 md:px-1 md:flex md:items-center md:justify-center"
      x-transition:enter="transition ease-out duration-300" id="nav-bar-logo">
          <a href="/EchoArticle/View/html/">Echo<span class="text-purple-600">Article</span></a>
      </div>

      <div class="flex-col hidden w-full h-auto md:hidden animate-slideIn" id="nav-list-mobile">
        <div class="flex flex-col items-center justify-center gap-2">
          <a href="/EchoArticle/View/html/" class="duration-75 hover:text-purple-600">Home</a>
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
              <a href="/EchoArticle/View/html/profiles/settings.php?username=<?= $user["username"] ?>" class="block w-full px-2 py-1 duration-100">Settings</a>
              <hr>
              <form action="../../routes/logout.php" class="w-full" method="post">
                <button class="w-full px-2 py-1 text-center duration-100 hover:underline">Logout</button>
              </form>
            </div>
          <?php endif ?>
        </div>
      </div>
      <div class="items-center hidden w-3/5 font-semibold justify-evenly md:flex">
        <a href="/EchoArticle/View/html/" class="duration-75 hover:text-purple-600 hover:border-b-2 hover:border-b-purple-600">Home</a>
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
                <a href="/EchoArticle/View/html/profiles/settings.php?username=<?= $user["username"] ?>" class="block w-full px-2 py-1 duration-100 rounded-t-md hover:bg-purple-400">Settings</a>
              </li>
              <hr>
              <li>
                <form action="/EchoArticle/routes/logout.php" class="w-full" method="post">
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