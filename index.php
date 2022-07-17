<?php
$msg = "";
$button = "disabled";
if (isset($_POST) & !empty($_POST)) {
    if ($_POST['captcha']) {
        $msg = "correct captcha";
    } else {
        $msg = "Invalid captcha";
    }
}
if ($msg == "correct captcha") {
    $button = "";
} else {
    $button = "disabled";
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/login.css" rel="stylesheet" type="text/css" />
    <link href="css/master.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery-3.6.0.min.js" rel="stylesheet" type="text/javascript"></script>
    <script src="js/bootstrap.bundle.min.js" rel="stylesheet" type="text/javascript"></script>
    <script src="js/openForm.js" type="text/javascript"></script>
    <title>Grocery shop</title>
    <link rel="icon" href="images/fu.ico" type="images/x-icon" />
    <title></title>
</head>

<body>
    <br />
    <br />
    <div class="container" id="box-container">
        <br />
        <nav class="navbar navbar-dark bg-dark">
            <button type="button" class="btn btn-dark" id="butt1" onclick="openForm('loginTab')">Login</button>
            <button type="button" class="btn btn-dark" id="butt2" onclick="openForm('registrationTab')">Registration</button>
        </nav>
        <br />
        <div class="formPages" id="registrationTab" style="display: none">
            <legend class="registration-box" style="text-align: center; color: #000;">Registration Page</legend>
            <div class="control-group">
                <form action="login_logout&registration/registration.php" method="post">
                    <input class="form-control" type="text" autocomplete="off" placeholder="Username" name="username" oninvalid="alert('The username field must be filled');" required>
                    <input class="form-control" type="password" autocomplete="off" placeholder="Password" name="password" oninvalid="alert('The password field must be filled');" required>
                    <input class="form-control" type="password" placeholder="Confirm Password" name="password" oninvalid="alert('The password field must be filled');" required>
                    <input class="form-control" type="text" placeholder="Name" name="name" oninvalid="alert('The Name field must be filled');" required>
                    <input class="form-control" type="text" placeholder="Email Address" name="email" oninvalid="alert('The Email field must be filled');" required>
                    
                    <br>
                    <div style="text-align: center;">
                        <img src="captcha/captcha.php" /><input class="form-control" type="text" placeholder="Enter Captcha here" name="captcha">
                        <p style="color:#000 ;"><?php echo $msg;?></p>
                        <input class="btn btn-warning" type="submit" name="submitCaptcha" value="Submit">
                    </div>
                </form>
                <br />
            </div>
        </div>
        <div class="formPages" id="loginTab" >
            <legend class="login-box" style="text-align: center; color: #000;">Login Page</legend>
            <div class="loginPage">
                <form class="form" action="login_logout&registration/loginProcess.php" method="post">
                    <input class="form-control" type="text" autocomplete="off" placeholder="Username" name="username" oninvalid="alert('No username entered');" required>
                    <input class="form-control" type="password" autocomplete="off" placeholder="Password" name="password" oninvalid="alert('No password entered');" required>
                    <input class="form-control" type="number" placeholder="2FA code" name="MFA_code" required>
                    <br />
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">Login</button>
                        <br>
                        <br>
                        <a href="../Web_App/forget_password/forgot_password.php">Forgot your password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>