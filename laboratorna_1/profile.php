<?php
include "dbUtils.php";
include "validation.php";
session_start();

$id = $_GET['id'];
$sql = "SELECT `users`.`first_name`, `users`.`last_name`, `users`.`email`, `users`.`password`, `users`.`photo`, `users`.role_id
FROM `users` WHERE `users`.`id`='" . $id . "';";
$result = runQuery($sql);
$show = false;
$row = null;
$linkToPhoto = null;
if ($result->num_rows > 0 && $row = $result->fetch_assoc()) {
    $show = true;
    $linkToPhoto = !empty($row['photo']) ? 'public/images/' . $row['photo'] : "assets/img/defaultProfilePhoto.png";
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/e99543c0a3.js" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/d59b846578.js"></script>
    <title>Profile</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header>
    <h1>Outstanding users of an outstanding system</h1>
</header>
<?php
if (empty($_SESSION['email'])) {
    echo '
            <nav class="buttonsPanel">
                <img class="logo"  src=assets/img/logo1.png alt="VA">                
                    <button class="buttonIn">
                        <a href="index.php">Main</a>
                    </button>
                    <button class="buttonUp">
                        <a href="#openModal" target="_self"> Sign in </a>
                    </button>
                    <form  method="post" action="logInController.php">
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
                    </form>
            </nav>
            
    ';
} else {
    echo '<div>
            <nav class="buttonsPanel">
                <img class="logo" src=assets/img/logo1.png alt="VA"> 
                <button class="buttonIn">
                    <a href="index.php">Main</a>
                </button>
                <button class="buttonUp">
                    <a href="logOutController.php">Logout</a>
                </button>
            </nav>    
          </div>';
}
?>

<div class="container">
    <?php
    if (empty($_SESSION['email']) || $_SESSION['id'] != $id && $_SESSION['role'] != 'admin') {
        echo '
                <div>
                    <img class="profilePhoto" src="' . $linkToPhoto . '" alt="Profile photo">
                </div>
                <form class="profileForm">
                    <h1>Information</h1>
                    <div class="field">
                        <label>First name</label>
                    <input class="profileInput" type="text" placeholder="First name" name="firstName" value="' . $row['first_name'] . '" readonly>
                    </div>
                    <div class="field">
                        <label>Last name</label>
                        <input class="profileInput" type="text" placeholder="Last name" name="lastName" value="' . $row['last_name'] . '" readonly>
                    </div>
                    <div class="field">
                        <label>E-mail</label>
                        <input class="profileInput" type="text" placeholder="E-mail" name="email" value="' . $row['email'] . '" readonly>
                    </div>
                </form>
                ';

    } else
        if ($_SESSION['id'] == $id || $_SESSION['role'] == 'admin' && !empty($_SESSION['email'])) {
            if ($show) {
                echo '<div>
                        <div>
                            <div>
                                <img src="' . $linkToPhoto . '" alt="Profile photo" class="profilePhoto">
                            </div>
                            <form action="uploadController.php?id=' . $id . '" method="post" enctype="multipart/form-data" class="uploadForm">
                                Select image to upload:
                                <input class="profileUploadChoose" type="file" name="fileToUpload" id="fileToUpload">
                                <input type="submit" value="Upload Image" name="submit" class="uploadButtonPicture">
                            </form>
                        </div>
                        <div>
                            <form action="updateProfileController.php" method="post" class="profileForm">
                            <h1>Information</h1>
                                <div>
                                <div class="field">
                                    <label>First name</label>
                                    <input class="profileInput" type="text" placeholder="First name" name="firstName" value="' . $row['first_name'] . '" required>
                                </div>
                                <div class="field">
                                    <label>Last name</label>
                                    <input class="profileInput" type="text" placeholder="Last name" name="lastName" value="' . $row['last_name'] . '" required>
                                </div>
                                <div class="field">
                                    <label>E-mail   </label>
                                    <input class="profileInput" id="email" type="text" placeholder="E-mail" name="email" value="' . $row['email'] . '"  required>
                                </div>
                                <div class="field">
                                    <label>Password</label>
                                    <input class="profileInput" id="password" type="password" placeholder="Password" name="password" value="' . $row['password'] . '" required>
                                </div>';
                if ($_SESSION['role'] == 'admin') {
                    echo '
                        <form class="profileForm">
                             <div>
                                <select id="role" required class="uploadSelect">
                                    <option disabled selected>Change the role</option>
                                    <option  value="2">Group users</option>
                                    <option  value="1">Group admins</option>
                                </select>
                            </div>
                        </form>
                       ';
                }
                echo '<button type="submit" class="uploadButton">Edit</button>  
                            <button class="uploadButton">
                                <a href="deleteProfileController.php?id=' . $id . '">Delete</a>
                            </button>            
                    </div>';
            } else {
                echo "<div><p>Update is wrong:(</p><a href='index.php'>Main page</a></div>";
            }
            echo '</div>
    </div>';
        }
    ?>
</div>
<footer class="footer">
    © Copyright VA 2019
</footer>
</body>
</html>

