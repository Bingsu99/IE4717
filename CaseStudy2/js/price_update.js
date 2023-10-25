orignalPrice = {};

window.onload = function () {
  //Obtaining elements
  var justJavaInput = document.getElementById("price1");
  var cafeAuLaitSingleInput = document.getElementById("price2");
  var cafeAuLaitDoubleInput = document.getElementById("price3");
  var cappucinoSingleInput = document.getElementById("price4");
  var cappucinoDoubleInput = document.getElementById("price5");

  var justJavaValidMsg = document.getElementById("pricevalid1");
  var cafeAuLaitSingleValidMsg = document.getElementById("pricevalid2");
  var cafeAuLaitDoubleValidMsg = document.getElementById("pricevalid3");
  var cappucinoSingleValidMsg = document.getElementById("pricevalid4");
  var cappucinoDoubleValidMsg = document.getElementById("pricevalid5");

  // Save Original Price
  orignalPrice["justJava"] = justJavaInput.value;
  orignalPrice["cafeAuLaitSingle"] = cafeAuLaitSingleInput.value;
  orignalPrice["cafeAuLaitDouble"] = cafeAuLaitDoubleInput.value;
  orignalPrice["cappucinoSingle"] = cappucinoSingleInput.value;
  orignalPrice["cappucinoDouble"] = cappucinoDoubleInput.value;

  //function to do price format validation
  function priceCheck(price, msg) {
    const pricePattern = /^\d+(\.\d{1,2})?$/; // Matches 99.99 or 99
    if (pricePattern.test(price)) {
      msg.innerHTML = "";
    } else {
      msg.innerHTML = "Invalid Price Format";
    }
  }

  // Adding event listener to all price inputs
  justJavaInput.addEventListener("blur", (evt) =>
    priceCheck(evt.target.value, justJavaValidMsg)
  );
  cafeAuLaitSingleInput.addEventListener("blur", (evt) =>
    priceCheck(evt.target.value, cafeAuLaitSingleValidMsg)
  );
  cafeAuLaitDoubleInput.addEventListener("blur", (evt) =>
    priceCheck(evt.target.value, cafeAuLaitDoubleValidMsg)
  );
  cappucinoSingleInput.addEventListener("blur", (evt) =>
    priceCheck(evt.target.value, cappucinoSingleValidMsg)
  );
  cappucinoDoubleInput.addEventListener("blur", (evt) =>
    priceCheck(evt.target.value, cappucinoDoubleValidMsg)
  );
};

function toggleInput(item) {
  if (item == "justJava") {
    var justJavaInput = document.getElementById("price1");

    if (!justJavaInput.disabled) {
      justJavaInput.value = orignalPrice["justJava"];
      justJavaInput.disabled = !justJavaInput.disabled;
    } else {
      justJavaInput.disabled = !justJavaInput.disabled;
    }
  } else if (item == "cafeAuLait") {
    var cafeAuLaitSingleInput = document.getElementById("price2");
    var cafeAuLaitDoubleInput = document.getElementById("price3");

    if (!cafeAuLaitSingleInput.disabled) {
      cafeAuLaitSingleInput.value = orignalPrice["cafeAuLaitSingle"];
      cafeAuLaitDoubleInput.value = orignalPrice["cafeAuLaitDouble"];
      cafeAuLaitSingleInput.disabled = !cafeAuLaitSingleInput.disabled;
      cafeAuLaitDoubleInput.disabled = !cafeAuLaitDoubleInput.disabled;
    } else {
      cafeAuLaitSingleInput.disabled = !cafeAuLaitSingleInput.disabled;
      cafeAuLaitDoubleInput.disabled = !cafeAuLaitDoubleInput.disabled;
    }
  } else if (item == "cappucino") {
    var cappucinoSingleInput = document.getElementById("price4");
    var cappucinoDoubleInput = document.getElementById("price5");

    if (!cappucinoSingleInput.disabled) {
      cappucinoSingleInput.value = orignalPrice["cappucinoSingle"];
      cappucinoDoubleInput.value = orignalPrice["cappucinoDouble"];
      cappucinoSingleInput.disabled = !cappucinoSingleInput.disabled;
      cappucinoDoubleInput.disabled = !cappucinoDoubleInput.disabled;
    } else {
      cappucinoSingleInput.disabled = !cappucinoSingleInput.disabled;
      cappucinoDoubleInput.disabled = !cappucinoDoubleInput.disabled;
    }
  }
}
