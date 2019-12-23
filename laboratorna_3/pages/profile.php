<?php
session_start();

include $_SERVER['DOCUMENT_ROOT'] . "/WebPractice/laboratorna_3/controllers/dbUtils.php";
include $_SERVER['DOCUMENT_ROOT'] . "/WebPractice/laboratorna_3/controllers/validationUtils.php";

$id = $_GET['id'];
$sql = "SELECT `users`.`first_name`, `users`.`last_name`, `users`.`email`, `users`.`password`, `users`.`photo`, `users`.role_id
FROM `users` WHERE `users`.`id`='" . $id . "';";
$result = runQuery($sql);
$show = false;
$row = null;
$linkToPhoto = null;
if ($result->num_rows > 0 && $row = $result->fetch_assoc()) {
    $show = true;
    $linkToPhoto = !empty($row['photo']) ? '../laboratorna_3/public/images/' . $row['photo'] : "../laboratorna_3/assets/img/defaultProfilePhoto.png";
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/e99543c0a3.js" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/d59b846578.js"></script>
    <script src="../assets/js/loginFormValidation.js"></script>
    <script src="../assets/js/deleteUser.js"></script>
    <title>Profile</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header>
    <h1>Outstanding users of an outstanding system</h1>
</header>
<?php
if (empty($_SESSION['email'])) {
    echo '
            <nav class="buttonsPanel">
                <a href="../index.php"><img class="logo" src=../assets/img/logo1.png alt="VA"></a>           
                    <button class="buttonIn">
                        <a href="../index.php">Main</a>
                    </button>
                    <button class="buttonUp">
                        <a href="#openModal" target="_self"> Sign in </a>
                    </button>
                <form>
                    <div id="openModal" class="modalDialog">
                        <div>
                            <a href="#close" title="Close" class="close">X</a>
                            <div class="login-box">
                                <h1>Login</h1>
                                <div class="textbox">
                                    <i class="fas fa-user"></i>
                                    <input type="text" id = "login" placeholder="Username" name="email" >
                                </div>
                                <div id="login-hint" class="textboxHint"></div>
                                <div class="textbox">
                                    <i class="fas fa-lock"></i>
                                    <input type="password" id="pwd" placeholder="Password" name="password" >
                                </div>
                                <div id="pwd-hint" class="textboxHint"></div>
                            </div>
                            <button class="loginButton" onclick="validateAndSignIn()">Login in</button>
                        </div>
                     </div>    
                </form>      
            </nav>
            
    ';
} else {
    echo '<div>
            <nav class="buttonsPanel">
                <img class="logo" src=../assets/img/logo1.png alt="VA"> 
                <button class="buttonIn">
                    <a href="../index.php">Main</a>
                </button>
                <button class="buttonUp">
                    <a href="../controllers/logOutController.php">Logout</a>
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
                    <img class="profilePhoto" src="../' . $linkToPhoto . '" alt="Profile photo">
                </div>
                <form class="profileForm">
                    <h1>Information</h1>
                    <div class="field">
                        <label for="first_name">First name</label>
                    <input class="profileInput" type="text" placeholder="First name" name="firstName" value="' . $row['first_name'] . '" readonly>
                    </div>
                    <div class="field">
                        <label for="last_name">Last name</label>
                        <input class="profileInput" type="text" placeholder="Last name" name="lastName" value="' . $row['last_name'] . '" readonly>
                    </div>
                    <div class="field">
                        <label for="email">E-mail</label>
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
                                <img src="../' . $linkToPhoto . '" alt="Profile photo" class="profilePhoto">
                            </div>
                            <form action="uploadController.php?id=' . $id . '" method="post" enctype="multipart/form-data" class="uploadForm">
                                Select image to upload:
                                <input class="profileUploadChoose" type="file" name="fileToUpload" id="fileToUpload">
                                <input type="submit" value="Upload Image" name="submit" class="uploadButtonPicture">
                            </form>
                        </div>
                        <div>
                            <form action="../controllers/updateProfileController.php" method="post" class="profileForm">
                            <h1>Information</h1>
                                <div>
                                <div class="field">
                                    <label for="first_name">First name</label>
                                    <input class="profileInput" type="text" placeholder="First name" name="firstName" value="' . $row['first_name'] . '" required>
                                </div>
                                <div class="field">
                                    <label for="last_name">Last name</label>
                                    <input class="profileInput" type="text" placeholder="Last name" name="lastName" value="' . $row['last_name'] . '" required>
                                </div>
                                <div class="field">
                                    <label for="email">E-mail   </label>
                                    <input class="profileInput" id="email" type="text" placeholder="E-mail" name="email" value="' . $row['email'] . '"  required>
                                </div>
                                <div class="field">
                                    <label for="pwd">Password</label>
                                    <input class="profileInput" id="password" type="password" placeholder="Password" name="password" value="' . $row['password'] . '" required>
                                </div>';
                if ($_SESSION['role'] == 'admin') {
                    echo '
                        <form class="profileForm">
                             <div>
                                <select id="role" required class="uploadSelect">';
                                    if($row['role_id']==2){
                                        echo'<option  value="2" selected>Group users</option>
                                             <option  value="1">Group admins</option>';
                                    } else {
                                            echo'<option  value="2">Group users</option>
                                             <option  value="1" selected>Group admins</option>';
                                    }echo

                                '</select>
                            </div>
                        </form>
                       ';
                }
                echo '<button type="submit" class="uploadButton">Edit</button>  
                            <button class="uploadButton">
                            <a href="../controllers/deleteProfileController.php?id=' . $id . '">Delete</a>   
                            </button>            
                    </div>';
            } else {
                echo "<div><p>Update is wrong:(</p><a href='../index.php'>Main page</a></div>";
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

