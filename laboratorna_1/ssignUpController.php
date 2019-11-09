<?php
include 'dbUtils.php';
session_start();
$mainPage = "iindex.php";
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header("Location:" . $mainPage);
} else {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $role = $_POST['role'];
    $password_r = $_POST['password_r'];
    $registrationPage = "signUp.php";

    if (test_input($email) && test_input($password) && test_input($firstName) && test_input($lastName)) {
        if (strlen($firstName) > 0 && strlen($lastName) > 0 && ($password_r == $password) && strlen($password) >= 6 && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $addUserSql = "INSERT INTO `users` (first_name, last_name, email, password, role_id)
            VALUES ('" . $firstName . "', '" . $lastName . "', '" . $email . "', '" . $password . "', '" . $role . "');";
            runQuery($addUserSql);
            $getId = "SELECT id FROM users WHERE email = $email";
            $result = runQuery($getId);
            $row = 1;
            $_SESSION['id'] = $row['id'];
            $_SESSION['firstName'] = $firstName;
            $_SESSION['lastName'] = $lastName;
            $_SESSION['email'] = $email;
            if ($role == "2") {
                $_SESSION['role'] = 2;
            }
            if ($role == "1") {
                $_SESSION['role'] = 1;
            }
            header("Location:" . $mainPage);

        } else {
            header("Location:" . $registrationPage);
        }
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}