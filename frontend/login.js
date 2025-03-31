function handleSignUp(event) {
  event.preventDefault(); 

  $('.error-handling').remove();
  var name = document.getElementById('name').value;
  var email = document.getElementById('email').value;
  var password = document.getElementById('password').value;
  var password2 = document.getElementById('password2').value;
  let isValid = true;
  if (name == "") {
    $('#group-name').append('<p class="error-handling">*Name should not be empty.</p>');
    isValid = false;
  }
  if (!verifyEmail(email)) {
    $('#group-email').append('<p class="error-handling">*Please check email format.</p>');
    isValid = false;
  }
  if(!verifyPassword(password)){
    $('#group-password').append('<p class="error-handling">*Password must have: 1 Uppercase, 1 Lowercase, 1 Number, 8 or more characters.</p>');
    isValid = false;
  }
  if(!verifyPassword2(password, password2)){
    $('#group-password2').append('<p class="error-handling">*Both passwords must match.</p>');
    isValid = false;
  }
  if (isValid){
    proceedSignUp(name, email, password, password2);
  }
  
  
}

function handleLogin(event){
  var email = document.getElementById('email').value;
  var password = document.getElementById('password').value;
  event.preventDefault(); 
  var isValid = true;
  $('.error-handling').remove();

  if (!verifyEmail(email)) {
    $('#group-email').append('<p class="error-handling">*Please check email format.</p>');
    isValid = false;
  }
  if(!verifyPassword(password)){
    $('#group-password').append('<p class="error-handling">*Password must have: 1 Uppercase, 1 Lowercase, 1 Number, 8 or more characters.</p>');
    isValid = false;
  }
  if (isValid){
    proceedLogin(email, password);
  }

}

function verifyEmail(message) {
  var patternForEmail = /^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})$/i;
  return patternForEmail.test(message);
}

function verifyPassword(password) {
  var patternForPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
  return patternForPassword.test(password);
}

function verifyPassword2(password, password2){
  return password == password2;
}