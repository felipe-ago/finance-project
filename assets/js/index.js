const modalCorpo = document.querySelector(".modal-container");
const mostrarModal = document.querySelector(".btn-open");
const closeModal = document.querySelectorAll(".close-modal");

function openModal(){
  modalCorpo.classList.add("active");
}

function closeModalCorpo(){
  modalCorpo.classList.remove("active");
}

mostrarModal.addEventListener("click", openModal);

for(let i = 0; i <closeModal.length; i++){
  closeModal[i].addEventListener("click", closeModalCorpo);
}