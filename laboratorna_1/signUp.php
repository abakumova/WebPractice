<?php
session_start();
$mainPage = "iindex.php";
if (isset($_SESSION['email'])) {
    header("Location: " . $mainPage);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/e99543c0a3.js" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/d59b846578.js"></script>
    <meta charset="UTF-8">
    <title>Sign Up Form</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
<div class="bg-image-up"></div>
<form action="ssignUpController.php" method="post">
    <div class="signup-form">
        <h1>Sign up</h1>
        <div class="textbox-up">
            <input id="firstName" type="text" placeholder="First name" name="firstName" value="" required>
        </div>
        <div class="textbox-up">
            <input id="lastName" type="text" placeholder="Last name" name="lastName" value="" required>
        </div>

        <div class="role-select">
            <select id="role" name="role" required>
                <option disabled selected>Select the role</option>
                <option  value="2">Group users</option>
                <option  value="1">Group admins</option>
            </select>
        </div>

        <div class="textbox-up">
            <input id="email" type="text" placeholder="E-mail" name="email" value="" required>
        </div>

        <div class="textbox-up">
            <input id="password" type="password" placeholder="Password" name="password" value="" required>
        </div>
        <div class="textbox-up">
            <input id="password_r" type="password" placeholder="Repeat password" name="password_r" value="" required>
        </div>

        <button>Sign Up</button>
    </div>
</form>
<div class="text-right">
        <span>
            <a href="iindex.php">Back to main page</a>
        </span>
</div>
</body>
</html>
