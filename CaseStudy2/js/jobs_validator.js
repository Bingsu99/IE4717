// // Added by Bing
nameValid = false;
emailValid = false;
startDateValid = false;
experienceValid = false;

function checkFields() {
  var submitButton = document.getElementById("Submit");
  console.log("checking field");
  if (
    nameValid == true &&
    emailValid == true &&
    startDateValid == true &&
    experienceValid == true
  ) {
    submitButton.disabled = false;
  }
  // if (nameValid == false) {
  //   chkName();
  // }
  // if (emailValid == false) {
  //   chkEmail();
  // }
  // if (startDateValid == false) {
  //   chkStartDate();
  // }
  // if (experienceValid == false) {
  //   chkExp();
  // }
}

// checking name
function chkName() {
  var name = document.getElementById("name").value;
  //remove any whitespace from both ends of the string
  name.trim();

  if (name.length > 0) {
    // make sure it is not empty
    var regexp = /^([A-z',.\s?]+)$/;
    if (regexp.test(name)) {
      nameValid = true;
      checkFields();
      return true;
    } else {
      alert(
        "Name has incorrect format, please enter alphabetical symbols separated with a blankspace."
      );
      nameValid = false;
      return false;
    }
  }
  alert("Please fill in your name." + name);
  nameValid = false;
  return false;
}

// checking email
function chkEmail() {
  var email = document.getElementById("email").value;
  email.trim();

  //make sure it is not empty
  if (email.length > 0) {
    var regexp = /^([\w\.-])+@([\w]+\.){1,4}([A-z]){2,3}$/;
    if (regexp.test(email)) {
      emailValid = true;
      checkFields();
      return true;
    } else {
      alert("Email entered in wrong format.");
      emailValid = false;
      return false;
    }
  }

  alert("Please fill in your email." + email);
  emailValid = false;
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
      if (date.getDate() > currentDate.getDate()) {
        startDateValid = true;
        checkFields();
        return true;
      }
    }
  }
  alert("Date must be in the future. \n You chosen: " + date);
  startDateValid = false;
  return false;
}

function chkExp() {
  var experience = document.getElementById("experience").value;
  experience.trim();

  // check if empty
  if (experience.length > 0) {
    experienceValid = true;
    checkFields();
    return true;
  }
  alert("Please fill in your experience." + experience);
  experienceValid = false;
  return false;
}
