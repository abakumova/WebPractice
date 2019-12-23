<?php


class db
{
    function getConnect($sql) {
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
}