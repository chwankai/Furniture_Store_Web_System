let cNumber = document.getElementById('number');
cNumber.addEventListener('keyup', function(e){
 let num = cNumber.value;

 let newValue = '';
 num = num.replace(/\s/g, '');
 for(var i = 0; i < num.length; i++) {
  if(i%4 == 0 && i > 0) newValue = newValue.concat(' ');
  newValue = newValue.concat(num[i]);
  cNumber.value = newValue;
 }

 let ccNum = document.getElementById('c-number');
 if(num.length<16){
  ccNum.style.border="1px solid red";
 }else{
  ccNum.style.border="1px solid greenyellow";
 }
});

let eDate = document.getElementById('e-date');
eDate.addEventListener('keyup', function( e ){

 let newInput = eDate.value;

 if(e.which !== 8) {
  var numChars = e.target.value.length;
  if(numChars == 2){
   var thisVal = e.target.value;
   thisVal += '/';
   e.target.value = thisVal;
   console.log(thisVal.length)
  }
 }

 if(newInput.length<5){
  eDate.style.border="1px solid red";
 }else{
  eDate.style.border="1px solid greenyellow";
 }
});

let cvv = document.getElementById('cvv');
cvv.addEventListener('keyup', function(e){

 let elen = cvv.value;
 let cvvBox = document.getElementById('cvv-box');
 if(elen.length<3){
  cvvBox.style.border="1px solid red";
 }else{
  cvvBox.style.border="1px solid greenyellow";
 }
})

//show error message if card number is invalid
document.getElementById('number').addEventListener('blur', function() {
    var cardNumberInput = document.getElementById('number');
    var cardNumberValue = cardNumberInput.value.trim();
    var errorMessageElement = document.getElementById('number-error');

    // Regular expression to match the format of a credit card number
    var cardNumberPattern = /^\d{4} \d{4} \d{4} \d{4}$/;

    if (cardNumberValue === '') {
        errorMessageElement.textContent = 'Please enter your credit card number.';
    } else if (!cardNumberPattern.test(cardNumberValue)) {
        errorMessageElement.textContent = 'Please enter a valid credit card number (digits only, no dashes or spaces).';
    } else {
        errorMessageElement.textContent = '';
    }
});

//show error message if card expiry date is invalid
// document.getElementById('e-date').addEventListener('blur', function() {
//     var expiryDateInput = document.getElementById('e-date');
//     var expiryDateValue = expiryDateInput.value.trim();
//     var errorMessageElement = document.getElementById('expiry-date-error');

//     // Regular expression to match the format of an expiry date (MM/YY)
//     var expiryDatePattern = /^(0[1-9]|1[0-2])\/\d{2}$/;

//     if (expiryDateValue === '') {
//         errorMessageElement.textContent = 'Please enter your expiry date (MM/YY).';
//     } else if (!expiryDatePattern.test(expiryDateValue)) {
//         errorMessageElement.textContent = 'Please enter a valid expiry date in the format MM/YY.';
//     } else {
//         errorMessageElement.textContent = '';
//     }
// });

//show error message if cvv is invalid
document.getElementById('cvv').addEventListener('blur', function() {
    var cvvInput = document.getElementById('cvv');
    var cvvValue = cvvInput.value.trim();   
    var errorMessageElement = document.getElementById('cvv-error');

    // Regular expression to match the format of a CVV (3 digits)
    var cvvPattern = /^\d{3}$/;

    if (cvvValue === '') {
        errorMessageElement.textContent = 'Please enter your CVV to verify.';
    } else if (!cvvPattern.test(cvvValue)) {
        errorMessageElement.textContent = 'Please enter a valid CVV (3 digits).';
    } else {
        errorMessageElement.textContent = '';
    }
});

function assignFunction(e) {
    document.getElementById("number").value = e.target.value
}

// // Function to check if all required fields are filled and valid
// function checkFields() {
//     var cardNumberValue = document.getElementById('number').value.trim();
//     var expiryDateValue = document.getElementById('e-date').value.trim();
//     var cvvValue = document.getElementById('cvv').value.trim();

//     var cardNumberPattern = /^\d{4} \d{4} \d{4} \d{4}$/;

//     return cardNumberPattern.test(cardNumberValue) && expiryDateValue !== '' && cvvValue !== '';
// }

// // Enable/disable submit button based on field inputs
// document.getElementById('payment-form').addEventListener('input', function() {
//     var submitBtn = document.querySelector('input[type="submit"]');
//     if (checkFields()) {
//         submitBtn.removeAttribute('disabled');
//     } else {
//         submitBtn.setAttribute('disabled', 'disabled');
//     }
// });

// // Validate credit card number on form submit
// document.getElementById('payment-form').addEventListener('submit', function(event) {
//     var cardNumberInput = document.getElementById('number');
//     var cardNumberValue = cardNumberInput.value.trim();
//     var errorMessageElement = document.getElementById('number-error');

//     var cardNumberPattern = /^\d{4} \d{4} \d{4} \d{4}$/;

//     if (cardNumberValue === '') {
//         errorMessageElement.textContent = 'Please enter your credit card number.';
//         event.preventDefault(); // Prevent form submission
//     } else if (!cardNumberPattern.test(cardNumberValue)) {
//         errorMessageElement.textContent = 'Please enter a valid credit card number.';
//         event.preventDefault(); // Prevent form submission
//     } else {
//         errorMessageElement.textContent = '';
//     }
// });
