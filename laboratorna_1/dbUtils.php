<?php
function runQuery($sql) {
    $servername = "localhost";
    $user = "root";
    $password = "";
    $database = "laba1";
    $conn = new mysqli($servername, $user, $password, $database);
    if ($conn->connect_error) {
        die('Something went wrong! Try again, please.');
    }
    $result = $conn->query($sql);
    mysqli_close($conn);
    return $result;
}
