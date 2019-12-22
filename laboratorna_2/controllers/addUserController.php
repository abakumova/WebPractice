<?php
include 'dbUtils.php';
include 'validationUtils.php';
session_start();
$mainPage = "../index.php";
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header("Location:" . $mainPage);
} else {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $role = $_POST['role'];
    $password_r = $_POST['password_r'];

    if (isValid($email) && isValid($password) && isValid($firstName) && isValid($lastName)) {
        if (!checkEmailOriginality($email)) {
            echo 'notOriginalEmail';
            exit;
        }

        if (strlen($firstName) > 0 && strlen($lastName) > 0 && ($password_r == $password) && strlen($password) >= 6 && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $addUserSql = "INSERT INTO `users` (first_name, last_name, email, password, role_id)
            VALUES ('" . $firstName . "', '" . $lastName . "', '" . $email . "', '" . $password . "', '" . $role . "');";
            runQuery($addUserSql);
            $getId = "SELECT id FROM users WHERE email = $email";
            $result = runQuery($getId);
            $row = 1;
            header("Location:" . $mainPage);
            echo 'success';
        }
    } echo 'invalidData';
}