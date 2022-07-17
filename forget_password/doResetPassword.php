<?php
// php file that contains the common database connection code
//include "../db_stuff/db.php";
include "../db_stuff/test_db.php";
//mail
use PHPMailer\PHPMailer\PHPMailer;

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';
//mail
$entered_username = hash('sha256', htmlspecialchars(stripslashes($_POST['username'])));
$entered_email = hash('sha256', htmlspecialchars(stripslashes($_POST['email'])));
$emailSend = htmlspecialchars(stripslashes($_POST['email']));
$verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6); //the verification code users would be seeing in their email
$stmt = $conn->prepare("SELECT * FROM users
           WHERE user_name=(:eu)
           AND email_address = (:ee)");
$stmt->bindParam(":eu", $entered_username, PDO::PARAM_STR);
$stmt->bindParam(":ee", $entered_email, PDO::PARAM_STR);
$stmt->execute();
$results = $stmt->rowCount();
if ($results == 1) {
    $msg = "Check your inbox for a link that will be used to reset your password";
} else {
    $msg = "The username you have entered doesn't exists.";
}
//mail portion
//initializing the PHPMailer
$mail = new PHPMailer(true);
//starting smtp
$mail->IsSMTP();
$mail->Mailer = "smtp";
// enable SMTP authentication
$mail->SMTPAuth = true;
// GMAIL username
$mail->Username = "jkak758@gmail.com";
// GMAIL password
$mail->Password = "ayksanthzgqcoqwo";
$mail->SMTPSecure = "ssl";
// sets GMAIL as the SMTP server
$mail->Host = "smtp.gmail.com";
// set the SMTP port for the GMAIL server
$mail->Port = "465";
$mail->From = 'jkak758@gmail.com';
$mail->FromName = 'GardenFreshCity';
//remember to update before deploying
$mail->AddAddress($emailSend);
$mail->Subject  =  'Password Reset';
$mail->IsHTML(true);
$mail->Body = "Hi, <br> Please enter this " . $verification_code . " in the input box provided to reset your account.";
if ($results = 1) {
    $mail->Send();
} else {
    "Mail Error - >" . $mail->ErrorInfo;
}
$conn = null;
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/registration.css" rel="stylesheet" type="text/css" />
    <script src="../js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="../js/showPw.js" type="text/javascript"></script>
    <link href="../css/master.css" rel="stylesheet" type="text/css" />
    <title>Grocery shop</title>
    <link rel="icon" href="../images/fu.ico" type="images/x-icon" />
</head>
<body>
    <br />
    <br />
    <div class="card" style="width: 18rem;">
        <div class="container" id="box-container">
            <div class="formPages" id="resetPassword">
                <br /><br /><br /><br /><br />
                <legend class="registration-box" style="text-align: center; color: #000;">Reset Password</legend>
                <div class="control-group">
                    <div class="card-body">
                        <p class="card-text"><?php echo $msg ?></p>
                    </div>
                    <form action="actualReset.php" method="post">
                        <input class="form-control" type="password" placeholder="New Password" name="newpw" id="Newpw" oninvalid="alert('The username field must be filled');" required>
                        <input class="form-control" type="password" placeholder="Confirm your password" id="confirmpw" name="confirmpw" oninvalid="alert('The email address field must be filled');" required>
                        <input class="form-control" type="text" name="verification_code" placeholder="Enter verification code" required />
                        <div style="text-align: center; color: #000;">
                            <input type="checkbox" id="showPW" class="form-check-input" onclick="showPw()">
                            <label for="showPW">Show Password</label>
                            <br>
                            <input class="btn btn-dark" type="submit" name="submitCaptcha" value="Submit">
                        </div>
                    </form>
                    <br />
                </div>

            </div>
        </div>
    </div>
</body>

</html>