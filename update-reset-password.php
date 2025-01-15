<?php
//update password in the database
$token = $_POST["token"];

$token_hash = hash("sha256", $token);

require __DIR__ . "/includes/config.php";

$sql = "SELECT * FROM users WHERE reset_token_hash = ?";

$stmt = $mysqli->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $mysqli->error);
}

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

$stmt = $mysqli->prepare('SELECT password FROM users WHERE id = ?');
$stmt->bind_param('i', $user['id']); // use bind_param instead of bindParam
$stmt->execute();
$stmt->store_result(); // store the result set
$stmt->bind_result($oldPasswordHash); // bind the result variable
$stmt->fetch(); // fetch the result
$newPasswordHash = md5($_POST["password"]);

// compare the new password with the old password
if ($newPasswordHash == $oldPasswordHash) {
    $error = "New password cannot be the same as the old password";
} elseif ($user === null) {
    $error = "Token not found";
} elseif (strtotime($user["reset_token_expires_at"]) <= time()) {
    $error = "Token has expired";
} elseif (strlen($_POST["password"]) < 8) {
    $error = "Password must be at least 8 characters";
} elseif (!preg_match("/[a-z]/i", $_POST["password"])) {
    $error = "Password must contain at least one letter";
} elseif (!preg_match("/[0-9]/", $_POST["password"])) {
    $error = "Password must contain at least one number";
} elseif ($_POST["password"] !== $_POST["password_confirmation"]) {
    $error = "New Passwords must match with Confirm Password";
} elseif (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST["password"])) {
    $error = "Password must contain at least one special character";
}

if (isset($error)) {
    ?>
    <style>
        .popup-overlay {
            padding: 20px;
            position: overlay;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .popup-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .close-popup {
            background-color: #ff6600;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 15px;
        }

        .close-popup:hover {
            background-color: #444;
        }
    </style>
    <div class="popup-overlay">
        <div class="popup-content">
            <h2>Error</h2>
            <p><?= $error ?></p>
            <button class="close-popup">Close</button>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var popupOverlay = document.querySelector(".popup-overlay");
            var closePopup = document.querySelector(".close-popup");
            closePopup.addEventListener("click", function () {
                popupOverlay.style.display = "none";
                window.history.back();
            });
        });
    </script>
    <?php
    exit;
}

//hash the password using md5 same as the login page method 
$new_password = md5($_POST["password"]);

$sql = "UPDATE users SET password =?, reset_token_hash = NULL, reset_token_expires_at = NULL  WHERE id = ?";

$stmt = $mysqli->prepare($sql);
//check the prepare statement
if (!$stmt) {
    die("Prepare failed: " . $mysqli->error);
}
$stmt->bind_param("si", $new_password, $user["id"]);

$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo '<script>
    alert("Your password has been changed successfully.");
    window.location.href = "login.php";
    </script>';//if the password is updated successfully then it will show the alert message and redirect to the login page
} else {
    echo "Failed to update password.";
}

$stmt->close();
$mysqli->close();

?>