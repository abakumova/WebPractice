<?php
session_start();
$mainPage = "../index.php";
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
<form action="../registrationController.php" method="post">
    <div class="signup-form">
        <h1>Sign up</h1>
        <div class="textbox-up">
            <input type="text" placeholder="First name" name="" value="">
        </div>
        <div class="textbox-up">
            <input type="text" placeholder="Last name" name="" value="">
        </div>

        <div class="role-select">
            <select>
                <option value="unauthorized" selected>Unauthorized</option>
                <option value="users">Group users</option>
                <option value="admins">Group admins</option>
            </select>
        </div>

        <div class="textbox-up">
            <input type="password" placeholder="Password" name="" value="">
        </div>
        <div class="textbox-up">
            <input type="password" placeholder="Repeat password" name="" value="">
        </div>

        <input class="button-up" type="button" name="" value="Sign up">
    </div>
</form>
<div class="text-right">
        <span>
            <a href="../index.php">Back to main page</a>
        </span>
</div>
</body>
</html>
