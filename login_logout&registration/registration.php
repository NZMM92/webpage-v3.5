<?php
//loading of MFA resources
include "../MFA/MFA.php";
//loading of MFA resources
//db connection stuff 
//include "../db_stuff/db.php";
include "../db_stuff/test_db.php";
//end of db connection stuff
//email related stuff
use PHPMailer\PHPMailer\PHPMailer;
require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';
//email related stuff end
//getting the information from the form

$username = hash('sha256', htmlspecialchars(stripslashes($_POST['username'])));
$userDisplay = htmlspecialchars(stripslashes($_POST['username']));
$password = hash('sha256', htmlspecialchars(stripslashes($_POST['password'])));
$email = hash('sha256', htmlspecialchars(stripslashes($_POST['email'])));
$names = hash('sha256', htmlspecialchars(stripslashes($_POST['name'])));
//all of the information has been hashed for security reasons
//non hashed information
$userDisplay = htmlspecialchars(stripslashes($_POST['username']));
$emailSend = htmlspecialchars(stripslashes($_POST['email']));
$verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6); //the verification code users would be seeing in their email
//query portion
$sqlQuery = $conn->prepare("SELECT * FROM users WHERE user_name = (:user)");
//binding the parameter
$sqlQuery->bindParam(":user", $username);
//executing the query
$sqlQuery->execute();
$results = $sqlQuery->rowCount();
//checking if the username exists or not. 
if ($results == 1) {
    $message = "The selected username already exist please try again with another username";
    $message1 = "Account not Created";
    //the red cross would be shown on the boostrap if the username exists (thanks Xavier for this)
    $img = "../images/Red-Cross-Mark-Download-PNG.png";
} else {
    //if the username doesn't exists insert into the database
    $query = $conn->prepare("INSERT INTO users(user_name, password, email_address, name, verification_code) VALUES (:userInsert, :passwordInsert, :emailInsert, :nameInsert, :veriCode)");
    $query->bindParam(":userInsert", $username);
    $query->bindParam(":passwordInsert", $password);
    $query->bindParam(":emailInsert", $email);
    $query->bindParam(":nameInsert", $names);
    $query->bindParam(":veriCode", $verification_code);
    $status = $query->execute();
    //inserting the information gathered into the database
    if ($status == 1) {
        $message = "\n Successful Account Creation";
        $message1 = "Account Created Successfully";
        $img = "../images/check-mark-green-tick-mark-symbol-recycling-symbol-text-logo-transparent-png-1725288.png";
    } else {
        $message = "\n The selected username $username already exist please select another one";
    }
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
//
$mail->AddAddress($emailSend, $names);
$mail->Subject  =  'Activating your account';
$mail->IsHTML(true);
$mail->Body    = "Hi ".$userDisplay.",<br>Please enter this " . $verification_code . " to activate your account.";
if ($results != 1) {
    $mail->Send();
    $msg = "An email with a verification link has been sent to your inbox";
} else {
    "Mail Error - >" . $mail->ErrorInfo;
    $msg = "You have already registered with us. Check Your email box and activate your account.";
}
//end of mail portion
//$conn = null;
//MFA portion
$qrLink =  \Sonata\GoogleAuthenticator\GoogleQrUrl::generate($userDisplay, $secret, 'Web_App');
//end of MFA portion
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/registration.css" rel="stylesheet" type="text/css" />
    <link href="../css/master.css" rel="stylesheet" type="text/css" />
    <script src="../js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="../js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <title>Grocery shop</title>
    <link rel="icon" href="../images/fu.ico" type="images/x-icon" />
    <title>Registration</title>
</head>

<body>
    <br />
    <br />
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" id="img" src="<?php echo $img; ?>" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title"><?php echo $message1 ?></p>
            </h5>
            <p class="card-text"><?php echo $message; ?><br><?php echo $msg; ?></p>
            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">Activate Account</button>
            <br>
            <br>
            <a href="../index.php" class="btn btn-dark">Back To Login Page</a>
            <br>
            <!-- disappearing 2fa portion -->
            <label class="form-check-label" for="2faQRDisplayer">Please download the Google Authenticator App on the Google Play Store or App Store</label>
            <div class="2faPortion">
                <img src = "<?=$qrLink?>">
            </div>
        </div>
    </div>
    <!-- activate email modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Account Activation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../email/email_verify.php">
                        <input type="hidden" name="email" value="<?php echo $emailSend ?>" required>
                        <input class="form-control" type="text" name="verification_code" placeholder="Enter verification code" required />
                        <input type="submit" class="btn btn-primary" name="verify_email" value="Verify Email" />
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>