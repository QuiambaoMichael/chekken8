
const form = document.getElementById('signupForm');
const fullNameInput = document.getElementById('fullName');
const userNameInput = document.getElementById('userName');
const passwordInput = document.getElementById('password');
const confirmPassInput = document.getElementById('confirmPass');
const emailInput = document.getElementById('email');
const contactNumberInput = document.getElementById('contactNumber');

form.addEventListener('submit', function(event) {
  event.preventDefault(); 

  
  if (fullNameInput.value.trim() === '') {
    document.getElementById('fullNameError').textContent = 'Full name is required.';
  } else {
    document.getElementById('fullNameError').textContent = '';
  }


  if (userNameInput.value.trim() === '') {
    document.getElementById('userNameError').textContent = 'Username is required.';
  } else {
    document.getElementById('userNameError').textContent = '';
  }

  if (passwordInput.value.trim() === '') {
    document.getElementById('passwordError').textContent = 'Password is required.';
  } else {
    document.getElementById('passwordError').textContent = '';
  }

 
  if (confirmPassInput.value.trim() === '') {
    document.getElementById('confirmPassError').textContent = 'Confirm password is required.';
  } else if (confirmPassInput.value !== passwordInput.value) {
    document.getElementById('confirmPassError').textContent = 'Passwords do not match.';
  } else {
    document.getElementById('confirmPassError').textContent = '';
  }


  if (emailInput.value.trim() === '') {
    document.getElementById('emailError').textContent = 'Email is required.';
  } else if (!isValidEmail(emailInput.value)) {
    document.getElementById('emailError').textContent = 'Invalid email format.';
  } else {
    document.getElementById('emailError').textContent = '';
  }


  if (contactNumberInput.value.trim() === '') {
    document.getElementById('contactNumberError').textContent = 'Mobile number is required.';
  } else if (!isValidMobileNumber(contactNumberInput.value)) {
    document.getElementById('contactNumberError').textContent = 'Invalid mobile number format.';
  } else {
    document.getElementById('contactNumberError').textContent = '';
  }

  if (
    document.getElementById('fullNameError').textContent === '' &&
    document.getElementById('userNameError').textContent === '' &&
    document.getElementById('passwordError').textContent === '' &&
    document.getElementById('confirmPassError').textContent === '' &&
    document.getElementById('emailError').textContent === '' &&
    document.getElementById('contactNumberError').textContent === ''
  ) {
   
    form.submit();
  }
});

function isValidEmail(email) {

  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

function isValidMobileNumber(mobileNumber) {
 
  const mobileNumberRegex = /^[0-9]{10}$/;
  return mobileNumberRegex.test(mobileNumber);
}
