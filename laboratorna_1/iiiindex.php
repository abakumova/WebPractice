<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/e99543c0a3.js" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/d59b846578.js"></script>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<div class="bg-image-index">
    <img class="logo" src=assets/img/logo.png>
    <?php
    if (empty($_SESSION['email'])) {
        echo '<form action="../authController.php" method="post">
<a href="#openModal" class="button-in-index">Sign in</a>
            <div id="openModal" class="modalDialog">
                 <div>
                        <a href="#close" title="Close" class="close">X</a>
                        <div class="login-box">
                            <h1>Login</h1>
                            <div class="textbox">
                                <i class="fas fa-user"></i>
                                <input type="text" placeholder="Username" name="" value="">
                            </div>
                            <div class="textbox">
                                <i class="fas fa-lock"></i>
                                <input type="password" placeholder="Password" name="" value="">
                            </div>
                             <input class="button-up-index" type="button" name="" value="Sign up">
                        </div>
                 </div>
            </div>    
                 </form>

   ';
    } else {
        echo '
    <span>
          <h4 id="greeter">Hello, ' . $_SESSION['firstName'] . '!</h4>
    </span>
        <input class="button-up-index" type="button" name="" value="Profile">
        <input class="button-in-index" type="button" name="" value="Logout" href="../logoutController.php">\';
     
    ';
    }
    ?>
</div>


<div class="table-responsive">
    <?php
    $servername = "localhost";
    $user = "root";
    $password = "";
    $database = "laba1";
    $conn = new mysqli($servername, $user,$password, $database);
    if ($conn->connect_error) {
        die('Oops, something went wrong! Try again, please.');
    }
    $sql = "SELECT `users`.`id`, `users`.`first_name`, `users`.`last_name`, `users`.`email`, `roles`.`title`
FROM `users` LEFT JOIN `roles` ON `users`.`role_id` = `roles`.`id`;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo '<table class="table table-hover table-bordered">
                   <tr>
                    <td>#</td>
                    <td>First name</td>
                    <td>Last name</td>
                    <td>Email</td>
                    <td>Role</td>
                   </tr>';
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                        <td><a href='#'>" . $row["id"] . "</a></td>
                        <td>" . $row["first_name"] . "</td>
                        <td>" . $row["last_name"] . "</td>
                        <td>" . $row["email"] . "</td>
                        <td>" . $row["title"] . "</td>
                      </tr>";
        }
        echo '</table>';
    } else {
        echo '<p>Nothing to show :(</p>';
    }
    ?>
</div>

</body>
</html>