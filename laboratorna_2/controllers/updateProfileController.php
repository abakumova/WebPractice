<?php
include "dbUtils.php";
include "validationUtils.php";

session_start();

$profilePage = "../pages/profile.php";

if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header("Location: $profilePage?id='.$id.'");
} else {
    $id = $_SESSION['id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $role = $_POST['role'];

    if (isValid($email) && isValid($password) && isValid($firstName) && isValid($lastName)) {
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
    if($_SESSION['role']!='admin'){
        $_SESSION['firstName']=$firstName;
    }
    header("Location: $profilePage?id=$id");
}
