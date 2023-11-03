window.onload = function () {
  var items = {};

  function totalPriceCalculator() {
    const values = Object.values(items);
    let sum = values.reduce((acc, currentValue) => acc + currentValue, 0);
    return sum;
  }

  function changingPrices(item, quantity) {
    const itemID = item.querySelector(".itemID").innerHTML;
    const priceElement = item.querySelector(".itemPrice");
    const totalPriceElement = document.getElementById("totalPrice");

    const unitPrice = parseFloat(item.querySelector(".unitPrice").innerHTML);

    const total = unitPrice * quantity;
    items[itemID] = total;
    priceElement.textContent = `${total.toFixed(2)}`;
    totalPriceElement.innerHTML = totalPriceCalculator().toFixed(2);
  }

  // Initialising Initial Prices
  function calculateInitialPrices() {
    const allItems = document.querySelectorAll(".item");
    allItems.forEach((item) => {
      const quantity = parseInt(item.querySelector("input").value);
      changingPrices(item, quantity);
    });
  }
  calculateInitialPrices();

  // Event listener for input changes inside the products container
  document
    .getElementById("itemsContainer")
    .addEventListener("input", function (event) {
      const item = event.target.closest(".item");
      const quantity = parseInt(event.target.value);
      changingPrices(item, quantity);
    });
};
