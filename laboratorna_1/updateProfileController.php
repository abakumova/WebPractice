<?php
include 'dbUtils.php';
include 'validation.php';
session_start();
$profilePage = "profile.php";
$ii= "index.php";
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header("Location: $profilePage?id='.$id.'");
} else {
    $id = $_SESSION['id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $role = $_POST['role'];
    if (test_input($email) && test_input($password) && test_input($firstName) && test_input($lastName)) {
        $addUserSql = "UPDATE `users` SET `users`.email = '" . $email . "' , `users`.password = '" . $password . "', `users`.first_name = '" . $firstName . "', `users`.last_name = '" . $lastName . "' WHERE `users`.`id`='" . $id . "';";
        runQuery($addUserSql);
    }
    if($_SESSION['role']=='admin'){
        if($role==2){
            $addUserSql = "UPDATE `users` SET `users`.role_id = 2 WHERE `users`.`id`='" . $id . "';";
            runQuery($addUserSql);
            $_SESSION['role']='user';
        } else{
            $addUserSql = "UPDATE `users` SET `users`.role_id = 1 WHERE `users`.`id`='" . $id . "';";
            runQuery($addUserSql);
            $_SESSION['role']='admin';
        }

    }
    header("Location: $profilePage?id='.$id.'");
}
