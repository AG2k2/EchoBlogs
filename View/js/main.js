const navBarLogo = document.getElementById("nav-bar-logo");
const navListMob = document.getElementById("nav-list-mobile");
const navbarTrigger = document.getElementById("navbar-trigger");
const btnLines = [...document.getElementsByClassName("button-line")];
const signupBtn = [...document.getElementsByClassName("signup-button")];
const signupFrom = document.getElementById("signup-form");
const loginBtn = [...document.getElementsByClassName("login-button")];
const loginFrom = document.getElementById("login-form");
const cancelBtns = [...document.getElementsByClassName("cancel-button")];
const navbarProfileList = document.getElementById("navbar-profile-list");
const navbarProfileSec = document.getElementById("navbar-profile-sec");
const deletionFrom = document.getElementById("deletion-form");


const switchForms = () => {
  toggleSignupForm();
  toggleLoginForm();
};

const toggleLoginForm = () => {
  loginFrom.classList.toggle("flex");
  loginFrom.classList.toggle("hidden");
};

const showNavProfileList = () => {
  navbarProfileList.classList.toggle("hidden");
  navbarProfileList.classList.toggle("flex");
};

const toggleSignupForm = () => {
  signupFrom.classList.toggle("flex");
  signupFrom.classList.toggle("hidden");
};

const toggleNavList = () => {
  navBarLogo.classList.toggle("hidden");
  navBarLogo.classList.toggle("flex");

  navListMob.classList.toggle("hidden");
  navListMob.classList.toggle("flex");

  btnLines[0].classList.toggle("rotate-45");
  btnLines[0].classList.toggle("-translate-y-1.5");
  
  btnLines[1].classList.toggle("opacity-0");
  
  btnLines[2].classList.toggle("-rotate-45");
  btnLines[2].classList.toggle("translate-y-1.5");
};

const showDeletionForm = () => {
  deletionFrom.classList.toggle("hidden");
  deletionFrom.classList.toggle("flex");
}

cancelBtns.forEach((el) => {
  el.addEventListener("click", () => {
    loginFrom.classList.contains("hidden") ? showSignupForm() : showLoginForm();
  });
});

document.addEventListener("click", (e) => {
  if(!navbarProfileSec.contains(e.target) ){
    navbarProfileList.classList.replace("flex", "hidden");
  };
});
