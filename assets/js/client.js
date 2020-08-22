var stripe = Stripe("Your Public Key Here");

var elements = stripe.elements();

var style = {
  base: {
    color: "#32325d",
    fontFamily: "Arial, sans-serif",
    fontSmoothing: "antialiased",
    fontSize: "16px",
    "::placeholder": {
      color: "##495057",
    },
  },
  invalid: {
    fontFamily: "Arial, sans-serif",
    color: "#fa755a",
    iconColor: "#fa755a",
  },
};

var cardNumber = elements.create("cardNumber", {
  style: style,
});
cardNumber.mount("#card-number");

var exp = elements.create("cardExpiry", {
  style: style,
});
exp.mount("#card-expiry");

var cvc = elements.create("cardCvc", {
  style: style,
});
cvc.mount("#card-cvv");

// Validate input of the card elements
var resultContainer = document.getElementById("card-error");
cardNumber.addEventListener("change", function (event) {
  if (event.error) {
    resultContainer.innerHTML =
      "<p class='alert alert-danger'>" + event.error.message + "</p>";
  } else {
    resultContainer.innerHTML = "";
  }
});

// Get payment form element
var form = document.getElementById("payment-form");

// Create a token when the form is submitted.
form.addEventListener("submit", function (e) {
  e.preventDefault();
  createToken();
});

// Create single-use token to charge the user
function createToken() {
  stripe.createToken(cardNumber).then(function (result) {
    if (result.error) {
      // Inform the user if there was an error
      resultContainer.innerHTML =
        "<p class='alert alert-danger'>" + result.error.message + "</p>";
    } else {
      // Send the token to your server
      stripeTokenHandler(result.token);
    }
  });
}

// Callback to handle the response from stripe
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var hiddenInput = document.createElement("input");
  hiddenInput.setAttribute("type", "hidden");
  hiddenInput.setAttribute("name", "stripeToken");
  hiddenInput.setAttribute("value", token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
