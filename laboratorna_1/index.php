<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/e99543c0a3.js" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/d59b846578.js"></script>
    <meta charset="UTF-8">
    <title>Index Page</title>
    <link rel="stylesheet" href="style.css">
</head>

<header>
    <h1>Outstanding users of an outstanding system</h1>
</header>

<?php
include 'dbUtils.php';
if (empty($_SESSION['email'])) {
    echo '
            <nav class="buttonsPanel">
                <img class="logo" src=assets/img/logo1.png>
                <button class="buttonIn">
                    <a href="#openModal" target="_self"> Sign in </a>
                </button>
                <button class="buttonUp">
                    <a href="signUp.php">Sign up</a>
                </button>
                <form  method="post" action="lloginController.php">
                    <div id="openModal" class="modalDialog">
                        <div>
                            <a href="#close" title="Close" class="close">X</a>
                            <div class="login-box">
                                <h1>Login</h1>
                                <div class="textbox">
                                    <i class="fas fa-user"></i>
                                    <input type="text" id = "email" placeholder="Username" name="email" required>
                                </div>
                                <div class="textbox">
                                    <i class="fas fa-lock"></i>
                                    <input type="password" id="password" placeholder="Password" name="password" required>
                                </div>
                            </div>
                            <button class="loginButton">Login in</button>
                        </div>
                     </div>    
                </form>  
            </nav>';
    echo ' 
    <form  method="post" action="lloginController.php">
        <div id="openModalWrong" class="modalDialog">
            <div>
                <a href="#close" title="Close" class="close">X</a>
                <div class="login-box">
                    <h1>Login</h1>
                    <p>Email or password is wrong. Try again</p>
                    <div class="textbox">
                        <i class="fas fa-user"></i>
                        <input type="text" id = "email" placeholder="Username" name="email" required>
                    </div>
                    <div class="textbox">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" placeholder="Password" name="password" required>
                    </div>
                    <button class="loginButton">Login in</button>
                </div>
            </div>
        </div>
    </form>';
} else {
    echo ' <nav class="buttonsPanel">
 <img class="logo" src=assets/img/logo1.png>
                <span>
                    <button type="button" class="buttonIn">
                        <a href="profile.php?id=' . $_SESSION['id'] . '" class="text-white">' . $_SESSION['firstName'] . '</a>
                    </button>
                </span>
                <span>
                    <button type="button" class="buttonUp">
                        <a href="llogoutController.php" class="text-white">Sign out</a>   
                    </button>
                </span>
            </nav>';
}
?>

<main>
    <div class="table">
        <?php
        $servername = "localhost";
        $user = "root";
        $password = "";
        $database = "laba1";
        $conn = new mysqli($servername, $user, $password, $database);
        if ($conn->connect_error) {
            die('Something went wrong! Try again, please.');
        }
        $sql = "SELECT `users`.`id`, `users`.`first_name`, `users`.`last_name`, `users`.`email`, `roles`.`title`
                        FROM `users` LEFT JOIN `roles` ON `users`.`role_id` = `roles`.`id`;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo '<table align="center">
                   <tr class="bold">
                    <td>#</td>
                    <td>First name</td>
                    <td>Last name</td>
                    <td>Email</td>
                    <td>Role</td>
                 </tr>';
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td><a href='profile.php?id=" . $row["id"] . "'>" . $row["id"] . "</a></td>
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
</main>

<?php
if (!empty($_SESSION['email']) && $_SESSION['role'] == 'admin') {
    echo '
     <button class="buttonIn">
        <a href="addUser.php">Add user</a>
    </button>';
}
?>
<footer class="footer">
    © Copyright VA 2019
</footer>
</body>
</html>