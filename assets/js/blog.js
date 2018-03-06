let loginBtn = document.querySelector(".header__btn-login ");
let formEl = document.querySelector(".header__form");
let modal = document.querySelector(".modal");
let closeButton = document.querySelector(".close-button");


// modal

function toggleModal() {
  modal.classList.toggle("show-modal");
}

function windowOnClick(event) {
  if (event.target === modal) {
    toggleModal();
  }
}

loginBtn.addEventListener("click", toggleModal);
closeButton.addEventListener("click", toggleModal);
window.addEventListener("click", windowOnClick);
