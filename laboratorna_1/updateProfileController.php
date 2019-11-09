<?php
include 'dbUtils.php';
session_start();
$profilePage = "profile.php";
$ii= "iindex.php";
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header("Location: $profilePage?id='.$id.'");
} else {
    //getting user data
    $id = $_SESSION['id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    if (test_input($email) && test_input($password) && test_input($firstName) && test_input($lastName)) {
        $addUserSql = "UPDATE `users` SET `users`.email = '" . $email . "' , `users`.password = '" . $password . "', `users`.first_name = '" . $firstName . "', `users`.last_name = '" . $lastName . "' WHERE `users`.`id`='" . $id . "';";
        runQuery($addUserSql);
    }
    header("Location: $profilePage?id='.$id.'");
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
