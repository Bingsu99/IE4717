window.onload = function () {
  var totalPrice = 0;
  var orders = {
    justJava: 0,
    cafeAuLait: 0,
    cappucino: 0,
  };
  var prices = {
    justJava: 2,
    cafeAuLait: 2,
    cappucino: 4.75,
  };

  // Quantity Inputs
  var justJava = document.getElementById("justJava");
  var cafeAuLait = document.getElementById("cafeAuLait");
  var cappucino = document.getElementById("cappucino");

  // Sub-Price Displays
  var justJavaDisplay = document.getElementById("justJavaDisplay");
  var cafeAuLaitDisplay = document.getElementById("cafeAuLaitDisplay");
  var cappucinoDisplay = document.getElementById("cappucinoDisplay");

  // Total Price Display
  var totalPriceDisplay = document.getElementById("totalPriceDisplay");

  // Radio Buttons
  var cafeAuLaitSingle = document.getElementById("cafeAuLaitSingle");
  var cafeAuLaitDouble = document.getElementById("cafeAuLaitDouble");
  var cappucinoSingle = document.getElementById("cappucinoSingle");
  var cappucinoDouble = document.getElementById("cappucinoDouble");

  // Add Event Listeners
  justJava.addEventListener("change", (evt) => {
    calPrice(evt, "justJava", justJavaDisplay);
  });
  cafeAuLait.addEventListener("change", (evt) => {
    calPrice(evt, "cafeAuLait", cafeAuLaitDisplay);
  });
  cappucino.addEventListener("change", (evt) => {
    calPrice(evt, "cappucino", cappucinoDisplay);
  });

  cafeAuLaitSingle.addEventListener("click", (evt) => {
    priceChange(evt, "cafeAuLait", 2, cafeAuLaitDisplay);
  });
  cafeAuLaitDouble.addEventListener("click", (evt) => {
    priceChange(evt, "cafeAuLait", 3, cafeAuLaitDisplay);
  });
  cappucinoSingle.addEventListener("click", (evt) => {
    priceChange(evt, "cappucino", 4.75, cappucinoDisplay);
  });
  cappucinoDouble.addEventListener("click", (evt) => {
    priceChange(evt, "cappucino", 5.75, cappucinoDisplay);
  });

  // Functions
  function calPrice(event, item, display) {
    display.innerHTML = "$" + event.target.valueAsNumber * prices[item];
    var changes = (event.target.valueAsNumber - orders[item]) * prices[item];
    updateTotal(changes);
    orders[item] = event.target.valueAsNumber;
  }

  function updateTotal(changes) {
    totalPrice += changes;
    totalPriceDisplay.innerHTML = "$" + totalPrice;
  }

  function priceChange(event, item, newPrice, display) {
    priceDiff = newPrice - prices[item];
    prices[item] = newPrice;
    display.innerHTML = "$" + orders[item] * prices[item];
    var changes = priceDiff * orders[item];
    updateTotal(changes);
  }
};
