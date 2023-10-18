// var customerNode = document.getElementById("custName");
// var phoneNode = document.getElementById("phone");
// customerNode.addEventListener("change", chkName, false);
// phoneNode.addEventListener("change", chkPhone, false);

// var Name = document.getElementById("name");
// var Email = document.getElementById("email");
// var startDate = document.getElementById("date");
// // var Experience = document.getElementById("experience");

// Name.addEventListener("change", chkName, false);
// Email.addEventListener("change", chkEmail, false);
// startDate.addEventListener("change", chkStartDate, false);
// // Experience.addEventListener("change", chkExp, false);

// checking name
function chkName() {
  var name = document.getElementById("name").value;
  name.trim(); //remove any whitespace from both ends of the string
  if (name.length > 0) {
    // make sure it is not empty
    var regexp = /^([A-z',.\s?]+)$/;
    if (regexp.test(name)) {
      alert("good.");
      return true;
    } else {
      alert(
        "Name has incorrect format, please enter alphabetical symbols separated with a blankspace."
      );
      return false;
    }
  }
  alert("Please fill in your name." + name);
  return false;
}

// checking email
function chkEmail() {
  var email = document.getElementById("email").value;
  email.trim();
  if (email.length > 0) {
    //make sure it is not empty
    var regexp = /^([\w\.-])+@([\w]+\.){1,3}([A-z]){2,3}$/;
    if (regexp.test(email)) {
      alert("amazing.");
      return true;
    } else {
      alert("Email entered in wrong format.");
      return false;
    }
  }
  alert("Please fill in your email." + email);
  return false;
}

// checking date
function chkStartDate() {
  var date = new Date(document.getElementById("date").value);
  var currentDate = new Date();
  if (date.getFullYear() > currentDate.getFullYear()) {
    alert("can.");
    return true;
  } else if (date.getFullYear() == currentDate.getFullYear()) {
    if (date.getMonth() > currentDate.getMonth()) {
      alert("cann.");
      return true;
    } else if (date.getMonth() == currentDate.getMonth()) {
      if (date.getDate() > currentDate.getDate()) {
        alert("cannn.");
        return true;
      }
    }
  } else {
    //   ...
  }
  alert("Date must be in the future." + date);
  return false;
}

function chkExp() {
  var experience = document.getElementById("experience").value;
  experience.trim();
  if (experience.length > 0) {
    alert("yes.");
    return true;
  }
  alert("Please fill in your experience." + experience);
  return false;
}
