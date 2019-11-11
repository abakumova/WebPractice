<?php
include 'dbUtils.php';
include 'validation.php';

session_start();

$mainPage = "index.php#openModalWrong";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['incorrect'] = false;
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (test_input($email) && test_input($password)) {
        $sql = "SELECT * FROM users WHERE email = '" . $email . "' LIMIT 1;";
        $result = runQuery($sql);
        if ($result->num_rows > 0 && $row = $result->fetch_assoc()) {
            if ($row['email']==test_input($email) && $row['password']==test_input($password)){
                $_SESSION['id'] = $row['id'];
                $_SESSION['firstName'] = $row['first_name'];
                $_SESSION['lastName'] = $row['last_name'];
                $_SESSION['email'] = $row['email'];
                if ($row['role_id'] == 1) {
                    $_SESSION['role'] = 'admin';
                } else {
                    $_SESSION['role'] = 'user';
                }
            } else {
                if ($row['email']!=$_POST['email']){
                    $emailErr="wrong";
                   echo $emailErr;
                }
                if ($row['password']!=$_POST['password']){
                }
                $_SESSION['incorrect'] = true;
            }
        }
    }
}
header('Location: ' . $mainPage);

