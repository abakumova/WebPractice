<?php
session_start();
$mainPage = "index.php";
if (isset($_SESSION['email']) && $_SESSION['role'] != 'admin') {
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
    <link rel="stylesheet" href="style.css">
</head>

<header>
    <h1>Outstanding users of an outstanding system</h1>
</header>
<body>
<nav class="buttonsPanel">
    <img class="logo" src=assets/img/logo1.png>
    <div class="buttonBack">
        <span>
            <a href="index.php">Back to main page</a>
        </span>
    </div>
</nav>

<form action="ssignUpController.php" method="post" class="bg-image-up">
    <div class="signup-form">
        <h1>Add user</h1>
        <div class="textbox-up">
            <input id="firstName" type="text" placeholder="First name" name="firstName" value="" required>
        </div>
        <div class="textbox-up">
            <input id="lastName" type="text" placeholder="Last name" name="lastName" value="" required>
        </div>

        <div class="role-select">
            <select id="role" name="role" required>
                <option disabled selected>Select the role</option>
                <option value="2">Group users</option>
                <option value="1">Group admins</option>
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

        <button class="button-up">Approve</button>
    </div>
</form>
<footer class="footer">
    © Copyright VA 2019
</footer>
</body>
</html>
