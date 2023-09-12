const signupForm = document.querySelector('#form');
const user = document.querySelector('#username');
const email = document.querySelector('#email');
const password = document.querySelector('#password');
const confirmPassword = document.querySelector('#confirmPassword');

signupForm.addEventListener('submit', (e) => {
  e.preventDefault();
  validateForm();
  register();
});

function validateForm() {
  let isValid = true;
  const nameValue = user.value.trim();
  const emailValue = email.value.trim();
  const passwordValue = password.value.trim();
  const confirmPasswordValue = confirmPassword.value.trim();

  if (nameValue === '') {
    errorValidation(user, `Por favor, insira um nome de usuário!`);
    isValid = false;
  } else {
    successValidation(user);
  }
  
  if (emailValue === ''){
    errorValidation(email, `O campo de e-mail não pode estar vazio!`)
  } else if (!validateEmail(emailValue)) {
    errorValidation(email, `Por favor, insira um e-mail válido!`);
    isValid = false;
  } else {
    successValidation(email);
  }

  if (passwordValue === '') {
    errorValidation(password, `O campo senha não pode estar vazio!`);
    isValid = false;
  } else if (passwordValue.length < 6) {
    errorValidation(password, `A senha deve ter no mínimo 6 caracteres!`);
    isValid = false;
  } else if (!validatePassword(passwordValue)) {
    errorValidation(password, `A senha deve conter pelo menos uma letra maiúscula, uma minúscula e um número!`);
    isValid = false;
  } else {
    successValidation(password);
  }

  if (confirmPasswordValue === '') {
    errorValidation(confirmPassword,`Por favor, confirme sua senha!`);
    isValid = false;
  } else if (passwordValue !== confirmPasswordValue) {
    errorValidation(confirmPassword, `As senhas não são as mesma, favor verifique!`);
    isValid = false;
  } else {
    successValidation(confirmPassword);
  }

  return isValid;

}

function validateEmail(email) {
  const re = /\S+@\S+\.\S+/;
  return re.test(email);
}

function validatePassword(password) {
  const re = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,}$/;
  return re.test(password);
}

function errorValidation(input, message){
  const formControl = input.parentElement;

  const smalls = formControl.querySelectorAll('.erroMsg');
  formControl.classList.remove('success');
  formControl.classList.add('error');
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
  const small = formControl.querySelector('.erroMsg');
  formControl.classList.remove('error');
  formControl.classList.add('success');
  small.innerText = '';
  formControl.querySelector('.erroMsg').style.display = 'none';
}

function register() {
  const nameValue = user.value.trim();
  const emailValue = email.value.trim();
  const passwordValue = password.value.trim();
  const confirmPasswordValue = confirmPassword.value.trim();
  const requestBody = { name: nameValue, email: emailValue, password: passwordValue, confirmPassword: confirmPasswordValue }

  fetch("assets/php/action_php/register.php", {
    method: 'POST',
    body: JSON.stringify(requestBody),
    headers: {
      'Content-Type' : 'application/json'
    }
  })
  .then(response => response.json())
  .then(data => {
    if (data.status === 'success') {
      const succesModal = document.querySelector('.modal');
      succesModal.style.visibility = 'visible';
      succesModal.classList.add('animate');
      setTimeout(() => {
        window.location.href = data.redirect; ''
      }, 2000);
    } else {
      if (data.status === 'error') {
        if (data.error_name) {
          errorValidation(user, data.error_name);
        } else{
          successValidation(user);
        }

        if (data.error_email) {
          errorValidation(email, data.error_email);
        } else {
          successValidation(email);
        }
      }

      if (data.password_error){
        errorValidation(password, data.password_error);
      } else {
        successValidation(password);
      }

      if (data.confirmPassword_error) {
        errorValidation(confirmPassword, data.confirmPassword_error);
      } else {
        successValidation(confirmPassword);
      }
    }
  })
  .catch(error => console.error(error))
}