


function showSuccessMessage() {

    if ($('#password').val() == $('#confirmPass').val()) {
        alert("Register Complete");
        return true;
    } 
    else {
        alert("Password do not match");
        return false;
    }

}

$( "#register" ).on( "click", function() {
    $("#container" ).addClass("active");
});

$("#login").click(function(){
    $("#container" ).removeClass("active");
});


    const form = document.getElementById('signupForm');
    const fullNameInput = document.getElementById('fullName');
    const userNameInput = document.getElementById('userName');
    const passwordInput = document.getElementById('password');
    const confirmPassInput = document.getElementById('confirmPass');
    const emailInput = document.getElementById('email');
    const contactNumberInput = document.getElementById('contactNumber');

    form.addEventListener('submit', function(event) {
      event.preventDefault(); // Prevent form submission

      // Full Name validation
      if (fullNameInput.value.trim() === '') {
        document.getElementById('fullNameError').textContent = 'Full name is required.';
      } else {
        document.getElementById('fullNameError').textContent = '';
      }

      // Username validation
      if (userNameInput.value.trim() === '') {
        document.getElementById('userNameError').textContent = 'Username is required.';
      } else {
        document.getElementById('userNameError').textContent = '';
      }

      // Password validation
      if (passwordInput.value.trim() === '') {
        document.getElementById('passwordError').textContent = 'Password is required.';
      } else {
        document.getElementById('passwordError').textContent = '';
      }

      // Confirm Password validation
      if (confirmPassInput.value.trim() === '') {
        document.getElementById('confirmPassError').textContent = 'Confirm password is required.';
      } else if (confirmPassInput.value !== passwordInput.value) {
        document.getElementById('confirmPassError').textContent = 'Passwords do not match.';
      } else {
        document.getElementById('confirmPassError').textContent = '';
      }

      // Email validation
      if (emailInput.value.trim() === '') {
        document.getElementById('emailError').textContent = 'Email is required.';
      } else if (!isValidEmail(emailInput.value)) {
        document.getElementById('emailError').textContent = 'Invalid email format.';
      } else {
        document.getElementById('emailError').textContent = '';
      }

      // Mobile number validation
      if (contactNumberInput.value.trim() === '') {
        document.getElementById('contactNumberError').textContent = 'Mobile number is required.';
      } else if (!isValidMobileNumber(contactNumberInput.value)) {
        document.getElementById('contactNumberError').textContent = 'Invalid mobile number format.';
      } else {
        document.getElementById('contactNumberError').textContent = '';
      }

      // Check if all validations passed
      if (
        document.getElementById('fullNameError').textContent === '' &&
        document.getElementById('userNameError').textContent === '' &&
        document.getElementById('passwordError').textContent === '' &&
        document.getElementById('confirmPassError').textContent === '' &&
        document.getElementById('emailError').textContent === '' &&
        document.getElementById('contactNumberError').textContent === ''
      ) {
        // All validations passed, submit the form
        form.submit();
      }
    });

    function isValidEmail(email) {
      // Regular expression for email validation
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(email);
    }

    function isValidMobileNumber(mobileNumber) {
      // Regular expression for mobile number validation
      const mobileNumberRegex = /^[0-9]{10}$/;
      return mobileNumberRegex.test(mobileNumber);
    }
 