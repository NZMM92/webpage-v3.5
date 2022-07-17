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
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/login.css" rel="stylesheet" type="text/css" />
    <link href="../css/master.css" rel="stylesheet" type="text/css" />
    <script src="../js/jquery-3.6.0.min.js"type="text/javascript"></script>
    <script src="../js/bootstrap.bundle.min.js"type="text/javascript"></script>

    <title>Grocery shop</title>
    <link rel="icon" href="images/fu.ico" type="images/x-icon" />
</head>

<body onload="window.onload = function (){alert('Please fill in your username and email to reset your password');}">
    <br />
    <br />
    <div class="container" id="box-container">
        <br />
        <nav class="navbar navbar-dark bg-dark">
            <button type="button" class="btn btn-dark" id="butt1" onclick="Javascript:window.location.href = '../index.php';">Login</button>
            <button type="button" class="btn btn-dark" id="butt2" onclick="Javascript:window.location.href = '../index.php';">Registration</button>
        </nav>
        <br />
        <div class="formPages" id="ForgetPassword">
            <legend class="registration-box" style="text-align: center; color: #000;">Reset Password</legend>
            <div class="control-group">
                <form action="doResetPassword.php" method="post">
                    <input class="form-control" type="text" placeholder="Username" name="username" oninvalid="alert('The username field must be filled');" required>
                    <input class="form-control" type="text" placeholder="Email Address" name="email" oninvalid="alert('The email address field must be filled');" required>
                    <br>
                    <div style="text-align: center;">
                        <img src="../captcha/captcha.php" /><input class="form-control" type="text" placeholder="Enter Captcha here" name="captcha">
                        <p style="color:#000 ;"><?php echo $msg ?></p>
                        <input class="btn btn-dark" type="submit" name="submitCaptcha" value="Submit">
                    </div>
                </form>
                <br />
            </div>
        </div>
    </div>
</body>

</html>