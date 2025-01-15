<?php

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

$mysqli = require __DIR__ . "/includes/config.php";

$sql = "SELECT * FROM users
        WHERE reset_token_hash = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
  die("token not found");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
  die("token has expired");
}
if ($user === null) {
  die("Token not found");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
  die("Token has expired");
}

?>
<!DOCTYPE html>
<html>

<head>
  <title>Reset Password</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
  <link rel="stylesheet" href="assets/css/orange.css">
  <link rel="stylesheet" href="assets/css/password-validation-message.css">
  <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico" />

</head>
<header>

</header>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
  }

  .container {
    width: 80%;
    margin: auto;
    padding: 20px;
    background-color: #f4f4f4;
    border-radius: 8px;

  }

  h1 {
    color: #ff6600;
    text-align: center;
  }

  .form-group label {
    color: #ff6600;
  }

  .form-control {
    border: 1px solid #ff6600;
    border-radius: 4px;
  }

  .form-control:focus {
    border-color: #cc5200;
    box-shadow: 0 0 8px #ff6600;
  }

  .logo {
    text-align: center;

  }

  .logo img {
    max-width: 300px;
  }

  .btn {
    background-color: #ff6600;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
  }

  .btn:hover {
    background-color: #cc5200;
  }

  .view-password {
    display: flex;
    align-items: center;
    margin-top: 10px;

  }

  .view-password input[type="checkbox"] {
    margin-right: 10px;
    margin-top: -5px;
    width: 20px;
    height: 20px;
  }

  .view-password label {
    font-size: 14px;
    color: #666;
    color: #ff6600;
  }
</style>

<body>
  <div class="container">
    <div class="logo">
      <img src="https://i.ibb.co/2Ymx8Lc/Main-logo.png" alt="Online Furniture Store Logo">
    </div>
  </div>
  <h1>Reset Password</h1>

  <form method="post" action="update-reset-password.php">

    <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
    <h3>Follow the intruction and reset your password </h3>
    <div class="form-group">
      <label class="info-title" for="New Password">New Password <span>*</span></label>
      <input type="password" class="form-control unicase-form-control text-input" id="password" name="password"
        placeholder="New password" required="required">
      <div class="view-password">
        <input type="checkbox" onclick="togglePasswordVisibility('password')">
        <label for="view-password-checkbox-confirmation">View Password</label>
      </div>
      <div class="row">
        <div id="message">
          <h3>Password must contain the following:</h3>
          <p id="letter" class="invalid">At least <b>lowercase</b> letter</p>
          <p id="capital" class="invalid">At least <b>capital (uppercase)</b> letter</p>
          <p id="number" class="invalid">At least <b>number</b></p>
          <p id="length" class="invalid">Minimum <b>8 characters</b></p>
          <p id="special" class="invalid">At least <b>one special character</b></p>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label class="info-title" for="Confirm Password">Confirm Password <span>*</span></label>
      <input type="password" class="form-control unicase-form-control text-input" id="password_confirmation"
        name="password_confirmation" required="required" placeholder="Confrim New Password">
      <div class="view-password">
        <input type="checkbox" id="view-password-checkbox-confirmation"
          onclick="togglePasswordVisibility('password_confirmation')">
        <label for="view-password-checkbox-confirmation">View Password</label>
      </div>

    </div>
    <button type="submit" method="post" class="btn">Change</button>
  </form>




  </div>
  </div>
  </div>
  <!-- checkout-step-02  -->

  </div><!-- /.checkout-steps -->
  </div>

  </div><!-- /.row -->
  </div><!-- /.checkout-box -->


  </form>

</body>
<script>
  var myInput = document.getElementById("password");
  var letter = document.getElementById("letter");
  var capital = document.getElementById("capital");
  var number = document.getElementById("number");
  var length = document.getElementById("length");
  var special = document.getElementById("special");



  // When the user starts to type something inside the password field
  myInput.onkeyup = function () {
    // Validate lowercase letters
    var lowerCaseLetters = /[a-z]/g;
    if (myInput.value.match(lowerCaseLetters)) {
      letter.classList.remove("invalid");
      letter.classList.add("valid");
    } else {
      letter.classList.remove("valid");
      letter.classList.add("invalid");
    }

    // Validate capital letters
    var upperCaseLetters = /[A-Z]/g;
    if (myInput.value.match(upperCaseLetters)) {
      capital.classList.remove("invalid");
      capital.classList.add("valid");
    } else {
      capital.classList.remove("valid");
      capital.classList.add("invalid");
    }

    // Validate numbers
    var numbers = /[0-9]/g;
    if (myInput.value.match(numbers)) {
      number.classList.remove("invalid");
      number.classList.add("valid");
    } else {
      number.classList.remove("valid");
      number.classList.add("invalid");
    }

    // Validate length
    if (myInput.value.length >= 8) {
      length.classList.remove("invalid");
      length.classList.add("valid");
    } else {
      length.classList.remove("valid");
      length.classList.add("invalid");
    }

    var specialCharacters = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/g;
    if (myInput.value.match(specialCharacters)) {
      special.classList.remove("invalid");
      special.classList.add("valid");
    } else {
      special.classList.remove("valid");
      special.classList.add("invalid");
    }

  }

  function togglePasswordVisibility(id) {
    var x = document.getElementById(id);
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
</script>


</html>