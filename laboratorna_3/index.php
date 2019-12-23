<?php
require_once 'route/api.php';

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/e99543c0a3.js" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/d59b846578.js"></script>
    <script src="../laboratorna_3/assets/js/usersTable.js"></script>
    <script src="../laboratorna_3/assets/js/loginFormValidation.js"></script>
    <script src="../laboratorna_3/assets/js/regFormValidation.js"></script>
    <script src="../laboratorna_3/assets/js/addUserValidation.js"></script>
    <meta charset="UTF-8">
    <title>Index Page</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<header>
    <h1>Outstanding users of an outstanding system</h1>
</header>

<?php
if (empty($_SESSION['email'])) {
    echo '
            <nav class="buttonsPanel">
            <a href="index.php"><img class="logo" src=assets/img/logo1.png alt="VA"></a>
                <button class="buttonIn">
                    <a href="#openModal" target="_self"> Sign in </a>
                </button>
                <button class="buttonUp">
                    <a href="#openModalUp" target="_self">Sign up</a>
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
                <form>
                    <div id="openModalUp" class="modalDialogUp">
                        <div>
                            <a href="#closeUp" title="Close" class="closeUp">X</a>
                            <h1 class="signupText">Sign up</h1>
                            <div class="textbox-up">
                                <input id="first_name" type="text" placeholder="First name" name="firstName" value="">
                            </div>
                            <div id="reg-first-name-hint" class="textboxHint"></div>
                            
                            <div class="textbox-up">
                                <input id="last_name" type="text" placeholder="Last name" name="lastName" value="">
                            </div>
                            <div id="reg-last-name-hint" class="textboxHint"></div>
                            
                            <div class="role-select">
                                <select id="role" name="role">
                                    <option disabled selected>Select the role</option>
                                    <option value="2">Group users</option>
                                    <option value="1">Group admins</option>
                                </select>
                            </div>
                            <div id="reg-role-hint" class="textboxHint"></div>
                        
                            <div class="textbox-up">
                                <input id="reg-login" type="text" placeholder="E-mail" name="email">
                            </div>
                            <div id="reg-login-hint" class="textboxHint"></div>
                            
                            <div class="textbox-up">
                                <input id="reg-pwd" type="password" placeholder="Password" name="password">
                            </div>
                            <div id="reg-password-hint" class="textboxHint"></div>
                            
                            <div class="textbox-up">
                                <input id="reg-pwd-r" type="password" placeholder="Repeat password" name="password_r">
                            </div>
                            <div id="reg-password-r-hint" class="textboxHint"></div>
                        
                            <button class="button-up" onclick="validateAndSignUp()">Sign Up</button>
                        </div>
                     </div>    
                </form>  
            </nav>';
} else {
    echo ' <nav class="buttonsPanel">
            <img class="logo" src=assets/img/logo1.png alt="VA">
                <span>
                    <button type="button" class="buttonIn">
                        <a href="../laboratorna_2/pages/profile.php?id=' . $_SESSION['id'] . '" class="text-white">' . $_SESSION['firstName'] . '</a>
                    </button>
                </span>
                <span>
                    <button type="button" class="buttonUp">
                        <a href="controllers/logOutController.php" class="text-white">Sign out</a>   
                    </button>
                </span>
            </nav>';
}
?>

<div class="">
    <div id="users"></div>
</div>

<?php
if (!empty($_SESSION['email']) && $_SESSION['role'] == 'admin') {
    echo '
     <button class="buttonIn">
        <a href="#openModalAdd">Add user</a>
    </button>
    <div id="openModalAdd" class="modalDialogUp">
                        <div>
                            <a href="#closeUp" title="Close" class="closeUp">X</a>
                            <h1 class="signupText">Add user</h1>
                            <div class="textbox-up">
                                <input id="add-first_name" type="text" placeholder="First name" name="firstName" value="">
                            </div>
                            <div id="add-first-name-hint" class="textboxHint"></div>
                            
                            <div class="textbox-up">
                                <input id="add-last_name" type="text" placeholder="Last name" name="lastName" value="">
                            </div>
                            <div id="add-last-name-hint" class="textboxHint"></div>
                            
                            <div class="role-select">
                                <select id="add-role" name="role">
                                    <option disabled selected>Select the role</option>
                                    <option value="2">Group users</option>
                                    <option value="1">Group admins</option>
                                </select>
                            </div>
                            <div id="add-role-hint" class="textboxHint"></div>
                        
                            <div class="textbox-up">
                                <input id="add-login" type="text" placeholder="E-mail" name="email">
                            </div>
                            <div id="add-login-hint" class="textboxHint"></div>
                            
                            <div class="textbox-up">
                                <input id="add-pwd" type="password" placeholder="Password" name="password">
                            </div>
                            <div id="add-password-hint" class="textboxHint"></div>
                            
                            <div class="textbox-up">
                                <input id="add-pwd-r" type="password" placeholder="Repeat password" name="password_r">
                            </div>
                            <div id="add-password-r-hint" class="textboxHint"></div>
                        
                            <button class="button-up" onclick="validateAndAdd()">Add user</button>
                        </div>
                     </div>  ';
}
?>
<footer class="footer">
    © Copyright VA 2019
</footer>
</html>