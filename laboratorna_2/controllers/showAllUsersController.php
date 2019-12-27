<?php
include "dbUtils.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $sql = "SELECT `users`.id, `users`.first_name, `users`.last_name, `users`.email, `roles`.`title` FROM `users` LEFT JOIN `roles` ON `users`.`role_id` = `roles`.`id`;";

    if (isset($_GET['sortByFirstName'])) {
        $sql = "SELECT `users`.id, `users`.first_name, `users`.last_name, `users`.email, `roles`.`title` FROM `users` LEFT JOIN `roles` ON `users`.`role_id` = `roles`.`id` ORDER BY `users`.first_name;";
    } else if (isset($_GET['sortByLastName'])) {
        $sql = "SELECT `users`.id, `users`.first_name, `users`.last_name, `users`.email, `roles`.`title` FROM `users` LEFT JOIN `roles` ON `users`.`role_id` = `roles`.`id` ORDER BY `users`.last_name;";
    } else if (isset($_GET['sortByEmail'])) {
        $sql = "SELECT `users`.id, `users`.first_name, `users`.last_name, `users`.email, `roles`.`title` FROM `users` LEFT JOIN `roles` ON `users`.`role_id` = `roles`.`id` ORDER BY `users`.email;";
    } else if (isset($_GET['sortByRole'])) {
        $sql = "SELECT `users`.id, `users`.first_name, `users`.last_name, `users`.email, `roles`.`title` FROM `users` LEFT JOIN `roles` ON `users`.`role_id` = `roles`.`id` ORDER BY `users`.role_id;";
    } else if (isset($_GET['sortById'])) {
        $sql = "SELECT `users`.id, `users`.first_name, `users`.last_name, `users`.email, `roles`.`title` FROM `users` LEFT JOIN `roles` ON `users`.`role_id` = `roles`.`id` ORDER BY `users`.id;";
    }
    echo json_encode(mysqli_fetch_all(runQuery($sql), MYSQLI_ASSOC));
}