<?php
function runQuery($sql) {
    $servername = "localhost";
    $user = "root";
    $password = "";
    $database = "laba1";
    $conn = new mysqli($servername, $user,$password, $database);

    if ($conn->connect_error) {
        die('Something went wrong! dbutils.');
    }
    $result = $conn->query($sql);
    mysqli_close($conn);
    return $result;
}

function checkEmailOriginality($email) {
    $sql = "SELECT `users`.id FROM `users` WHERE `users`.email = '$email';";
    return runQuery($sql)->num_rows == 0;
}