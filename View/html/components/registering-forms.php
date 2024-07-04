<div class="hidden absolute top-0 left-0 bg-opacity-[92%] mx-auto animate-slideIn h-full w-full items-center justify-center bg-gray-900 text-white duration-200 z-50" id="login-form">
  <button type="button" class="absolute py-2 font-bold duration-300 transform rounded-sm right-2 top-2 hover:text-gray-300" onclick="toggleLoginForm()">
    Cancel
  </button>
  <form method="post" action="../../routes/login.php" class="flex w-[30rem] flex-col space-y-10">
    <div class="text-4xl font-medium text-center">Log In</div>
    <div class="w-full text-lg duration-300 transform bg-transparent border-b-2 focus-within:border-purple-500">
      <input type="text"
        name="input"
        placeholder="Username or Email:"
        class="w-full bg-transparent border-none outline-none placeholder:italic focus:outline-none"/>
    </div>

    <div class="w-full text-lg duration-300 transform bg-transparent border-b-2 focus-within:border-purple-500">
      <input type="password"
        name="pswrd"
        placeholder="Password:"
        class="w-full bg-transparent border-none outline-none placeholder:italic focus:outline-none"/>
    </div>

    <button type="submit" class="py-2 font-bold duration-300 transform bg-purple-600 rounded-sm hover:bg-purple-400">
      LOG IN
    </button>

    <p class="text-lg text-center">
      No account?
      <button type="button" class="font-medium text-purple-500 underline-offset-4 hover:underline" onclick="switchForms()">
        Create One
      </button>
    </p>
  </form>
</div>

<div class="hidden absolute top-0 left-0 bg-opacity-[92%] mx-auto animate-slideIn h-full w-full items-center justify-center bg-gray-900 text-white duration-200 z-50" id="signup-form">
  <button type="button" class="absolute py-2 font-bold duration-300 transform rounded-sm right-2 top-2 hover:text-gray-300" onclick="toggleSignupForm()">
    Cancel
  </button>
  
  <form method="post" action="../../routes/signup.php" class="flex w-[30rem] flex-col space-y-10">
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
      <input type="text"
        name="birth_date"
        placeholder="Birth date:"
        onfocus="(this.type = 'date')"
        class="w-full text-white bg-transparent border-none outline-none placeholder:italic focus:outline-none"/>
    </div>

    <div class="w-full text-lg duration-300 transform bg-transparent border-b-2 focus-within:border-purple-500">
      <select name="gender" class="w-full bg-transparent focus:outline-none">
        <option value="m" class="text-black">Male</option>
        <option value="f" class="text-black">Female</option>
      </select>
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

    <button type="submit" class="py-2 font-bold duration-300 transform bg-purple-600 rounded-sm hover:bg-purple-400">
      SIGN UP
    </button>
    
    <p class="text-lg text-center">
      Have account?
      <button type="button" class="font-medium text-purple-500 underline-offset-4 hover:underline" onclick="switchForms()">
        Log in
      </button>
    </p>
  </form>
</div>