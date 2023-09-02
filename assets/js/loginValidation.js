const loginForm = document.querySelector('#loginForm');
const email = document.querySelector('#email');
const password = document.querySelector('#password');
const inputs = document.querySelectorAll('input');

loginForm.addEventListener('submit',  (e) => {
  e.preventDefault();
  if (ValidateForm()) {
    login()
  }
});
function ValidateForm() {
  let isValid = true;
  const emailValue = email.value.trim();
  const passwordValue = password.value.trim();

  if (emailValue === '' || !validateEmail(emailValue)) {
    errorValidation(email, `Por favor, insira um e-mail válido!`);
    isValid = false;
  } else {
    successValidation(email);
  }

  if (passwordValue === '') {
    errorValidation(password, `Por favor, insira sua senha!`);
    isValid = false;
  } else {
    successValidation(password);
  }

  return isValid;
  }

function validateEmail(email) {
  const emailReg = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailReg.test(email);
  }
  
  function errorValidation(input, message) {
  const formControl = input.parentElement;

  const smalls = formControl.querySelectorAll('.erroMsg')
  formControl.classList.remove('success');
  formControl.classList.add("error");
  smalls.forEach((small) => {
    small.innerText = message;
    small.style.display = 'block';
    small.classList.add('shake');
    setTimeout(() => {
      small.classList.remove('shake');
    }, 500);
  });
}

function successValidation(input) {
  const formControl = input.parentElement;
  formControl.classList.remove('error');
  const errorMessage = formControl.querySelector('.erroMsg');
  errorMessage.textContent = '';
}

function login(){
  const emailValue = email.value;
  const passwordValue = password.value;

  fetch("assets/php/action_php/login_authenticator.php", {
    method: "POST",
    headers: {"Content-Type" : "application/json"},
    body: JSON.stringify({email: emailValue, password: passwordValue})
  })
  .then(response => response.json())
  .then(data => {
    if (data.status === "success"){
      if (data.redirect) {
        window.location.href = data.redirect;
      }
    } else {
      if (data.status === 'error') {
        if (data.error_email) {
          errorValidation(email, data.error_email);
        } else {
          successValidation(email);
        }

        if (data.error_password) {
          errorValidation(password, data.error_password);
        } else {
          successValidation(password);
        }
      }
    }
  })
  .catch(error => console.error(error));
}