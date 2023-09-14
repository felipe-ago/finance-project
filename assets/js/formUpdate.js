const dateInputUpdate = document.querySelector("#dateInput-update");

dateInputUpdate.onchange = function () {
  const selectedDate = new Date(dateInputUpdate.value);
  const currentDate = new Date();
  if (selectedDate > currentDate) {
    const small = document.querySelector('.msgErro-update')
    small.style.display    = 'block'
    small.innerText = 'Digite uma data valida!'
    small.style.color = 'red'
    dateInputUpdate.value = "";
  } else {
    const small = document.querySelector('.msgErro-update')
    small.style.display    = 'none'
  }
}

/*$(document).ready(function () {
  $('#value, #value-update').mask('#.##0,00', { reverse: true });
});*/