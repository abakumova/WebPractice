<?php
include "dbUtils.php";
session_start();

$id= $_SESSION['id'];
$sql = "SELECT `users`.`first_name`, `users`.`last_name`, `users`.`email`, `users`.`password`, `users`.`photo`
FROM `users` WHERE `users`.`id`='" . $id . "';";
$result = runQuery($sql);
$show = false;
$row = null;
$linkToPhoto = null;
if ($result->num_rows > 0 && $row = $result->fetch_assoc()) {
    $show = true;
    $linkToPhoto = !empty($row['photo']) ? 'public/images/' . $row['photo'] : "assets/img/defaultProfilePhoto.png";
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
</head>
<body>
<?php
if (empty($_SESSION['email'])) {
    echo '<div class="text-right">
                <span>
                    <button type="button" class="btn btn-success nav-button" data-toggle="modal" data-target="#myModal">
                        Sign in
                    </button>
                </span>
                <span>
                    <button type="button" class="btn btn-info nav-button">
                        <a href="signUp.php" class="text-white">Sign up</a>
                    </button>
                </span>
            </div>';
} else {
    echo '<div class="text-right">
        <span>
            <button type="button" class="btn btn-info nav-button">
                <a href="iindex.php" class="text-white">Main page</a>
            </button>
        </span>
        <span>
            <button type="button" class="btn btn-danger logout-button">
                <a href="llogoutController.php" class="text-white">Logout</a>
            </button>
        </span>
    </div>';
}
?>
</nav>

<div class="container">
    <?php
    if ($_SESSION['id'] == $id && $_SESSION['role'] == 'user') {
        if ($show) {
            echo '<div >
        <div >
            <div>
                <img src="' . $linkToPhoto . '" alt="Profile photo" id="usersImage">
            </div>
            <form action="uploadController.php?id=' . $id . '" method="post" enctype="multipart/form-data">
                Select image to upload:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Upload Image" name="submit">
            </form>
        </div>
        
        <div >
                <form action="updateProfileController.php" method="post">
                 <div class="signup-form">
        <h1>Sign up</h1>
       
        <div >
            <input type="text" placeholder="First name" name="firstName" value="' . $row['first_name'] . '" required>
        </div>
        <div >
            <input type="text" placeholder="Last name" name="lastName" value="' . $row['last_name'] . '" required>
        </div>

        <div >
            <input id="email" type="text" placeholder="E-mail" name="email" value="' . $row['email'] . '"  required>
        </div>

        <div >
            <input id="password" type="password" placeholder="Password" name="password" value="' . $row['password'] . '" required>
        </div>
       
          <button type="submit" class="btn btn-success btn-block">Edit</button>  
                     
                            <button type="" class="btn btn-danger btn-block">
                                <a href="deleteProfileController.php?id=' . $id . '" class="text-white">Delete</a>
                            </button>   
        </form>               
         </div> 
              ';
        } else {
            echo "<div><p>Update is wrong:(</p><a href='iindex.php'>Main page</a></div>";
        }
        echo '</div>
    </div>';
    };
    ?>
</div>
</body>
</html>

