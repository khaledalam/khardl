// TODO @todo change to live public key
var tap = Tapjsli('pk_test_eSKQWEusGry3q1mCYOk2MoXH');

var elements = tap.elements({});
var style = {
  base: {
    color: '#535353',
    lineHeight: '18px',
    fontFamily: 'sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: 'rgba(0, 0, 0, 0.26)',
      fontSize:'15px'
    }
  },
  invalid: {
    color: 'red'
  }
};
// input labels/placeholders
var labels = {
    cardNumber:"Card Number",
    expirationDate:"MM/YY",
    cvv:"CVV",
    cardHolder:"Card Holder Name"
  };
//payment options
var paymentOptions = {
  currencyCode:["SAR"],
  labels : labels,
  TextDirection:'ltr'
}
//create element, pass style and payment options
var card = elements.create('card', {style: style},paymentOptions);

//mount element
card.mount('#element-container');
//card change event listener
card.addEventListener('change', function(event) {
    console.log("here")
  if(event.BIN){
      console.log("here 1")

      console.log(event.BIN)
  }
  if(event.loaded){
      console.log("here 2")

      console.log("UI loaded :"+event.loaded);
    console.log("current currency is :"+card.getCurrency())
  }
  var displayError = document.getElementById('error-handler');
  if (event.error) {
      console.log("here 3")

      displayError.textContent = event.error.message;
  } else {
      console.log("here 4")

      displayError.textContent = '';
  }
});

// Handle form submission
var form = document.getElementById('form-container');
form.addEventListener('submit', function(event) {
  event.preventDefault();

    console.log("card:", card);

    console.log("tap:", tap);

    let token = tap.createToken(card);

    console.log("token:", token);


    token.then(function(result) {
    console.log(result);
    if (result.error) {
      // Inform the user if there was an error
      var errorElement = document.getElementById('error-handler');
      errorElement.textContent = result.error.message;
        Swal.fire({
            icon: 'error',
            title: result.error.message,
            showConfirmButton: false,
            timer: 3500
        });
    } else {
      // Send the token to your server
      var errorElement = document.getElementById('success');
      errorElement.style.display = "block";
      var tokenElement = document.getElementById('token');
      tokenElement.textContent = result.id;
      console.log(result.id);
    }
  }).error(e => {
      console.log("error: ", e);
  });

    // var cardNumber =  document.getElementById('card-number')?.value;
    // var expirationDate = document.getElementById('expiration-date')?.value;
    // var CVV = document.getElementById('cvv')?.value;
    // var cardHolder = document.getElementById('card-holder')?.value;
    // console.log(cardNumber,expirationDate,CVV,cardHolder);
});
