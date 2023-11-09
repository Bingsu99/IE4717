// // Added in for submission of form
nameValid = false;
emailValid = false;
digitsValid = false;
startDateValid = false;

function checkFields() {
  var submitButton = document.getElementById("submit");
  console.log("checking field");
  if (
    nameValid == true &&
    emailValid == true &&
    digitsValid == true &&
    startDateValid == true
  ) {
    submitButton.disabled = false;
  } else {
    submitButton.disabled = true;
  }
}

// checking name
function chkName() {
  var firstname = document.getElementById("firstname").value;
  var lastname = document.getElementById("lastname").value;

  //remove any whitespace from both ends of the string
  firstname = firstname.trim();
  lastname = lastname.trim();

  if (firstname.length > 0 || lastname.length > 0) {
    // Make sure both fields are not empty
    var nameRegExp = /^[A-Za-z]+$/;

    if (nameRegExp.test(firstname)) {
      nameValid = true;
      checkFields();
      return true;
    } else if (nameRegExp.test(lastname)) {
      nameValid = true;
      checkFields();
      return true;
    } else {
      alert(
        "Name has incorrect format. Please enter alphabetical characters separated by spaces."
      );
      nameValid = false;
      checkFields();
      return false;
    }
  }

  alert("Please fill in your first name and last name, with letters only");
  nameValid = false;
  checkFields();
  return false;
}

// checking email
function chkEmail() {
  var email = document.getElementById("email").value;
  email.trim();

  //make sure it is not empty
  if (email.length > 0) {
    var regexp = /^([\w\.-])+@([\w]+\.){1,3}([A-z]){2,3}$/;
    if (regexp.test(email)) {
      emailValid = true;
      checkFields();
      return true;
    } else {
      alert(
        "Email entered in wrong format. Please fill in your email, with proper domain name"
      );
      emailValid = false;
      checkFields();
      return false;
    }
  }

  alert("Please fill in your email.");
  emailValid = false;
  checkFields();
  return false;
}

// checking 8 digits phone number
function checkPhoneDigits(input) {
  var phone = document.getElementById("phone").value;
  phone.trim();

  var regexp = /^\d{8}$/; // Regular expression to match exactly 8 digits
  if (phone.length > 0) {
    if (regexp.test(phone)) {
      digitsValid = true;
      checkFields();
      return true;
    } else {
      alert(
        "Phone number entered in wrong format. Please fill in your Phone number, with 8 digits only"
      );
      digitsValid = false;
      checkFields();
      return false;
    }
  }
  alert("Please fill in your phone number, with 8 digits only");
  emailValid = false;
  checkFields();
  return false;
}

function chkPosterCode(input) {
  var postal = document.getElementById("postal").value;
  postal.trim();

  var regexp = /^\d{6}$/; // Regular expression to match exactly 8 digits
  if (postal.length > 0) {
    if (regexp.test(postal)) {
      digitsValid = true;
      checkFields();
      return true;
    } else {
      alert(
        "Poster Code entered in wrong format. Please fill in your Poster Code, with 6 digits only"
      );
      digitsValid = false;
      checkFields();
      return false;
    }
  }
  alert("Please fill in your Poster Code, with 6 digits only");
  emailValid = false;
  checkFields();
  return false;
}

// checking date
function chkStartDate() {
  var date = new Date(document.getElementById("date").value);
  var currentDate = new Date();

  // check year
  if (date.getFullYear() > currentDate.getFullYear()) {
    startDateValid = true;
    checkFields();
    return true;
  } else if (date.getFullYear() == currentDate.getFullYear()) {
    // check month
    if (date.getMonth() > currentDate.getMonth()) {
      startDateValid = true;
      checkFields();
      return true;
    } else if (date.getMonth() == currentDate.getMonth()) {
      // check date
      if (date.getDate() > currentDate.getDate() + 3) {
        startDateValid = true;
        checkFields();
        return true;
      }
      else{
          alert("Catering date must be 3 day in advance.");
          startDateValid = false;
          checkFields();
          return false;
      }
    }
  }
  alert("Catering date must be 3 day in advance.");
  startDateValid = false;
  checkFields();
  return false;
}
