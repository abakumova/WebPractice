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
            $getId = "SELECT `users`.`id` FROM `users` WHERE  `users`.`email` = '$email';";
            $result = runQuery($getId);
            $row = $result->fetch_assoc();
            $_SESSION['id'] =  $row['id'];
            $_SESSION['firstName'] = $firstName;
            $_SESSION['lastName'] = $lastName;
            $_SESSION['email'] = $email;
            if ($role == 2) {
                $_SESSION['role'] = 'users';
            }
            if ($role == 1) {
                $_SESSION['role'] = 'admin';
                echo 'success';
                exit;
            }
        }
    } echo 'invalidData';
}

