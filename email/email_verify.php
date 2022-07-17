<?php
date_default_timezone_set("Asia/Singapore");
//include "../db_stuff/db.php";
include "../db_stuff/test_db.php";
if (isset($_POST["verify_email"])&& isset($_POST['email'])) {
    $email = hash('sha256', htmlspecialchars(stripslashes($_POST['email'])));
    $time = date('Y-m-d H:i:s');
    $verification_code = htmlspecialchars(stripslashes($_POST["verification_code"]));
    $queryStmt = $conn->prepare("SELECT * FROM users WHERE email_address = (:email)");
    $queryStmt->bindParam(':email', $email);
    $queryResult = $queryStmt->execute();
    if ($queryResult == 1 ) {
        $stmt = $conn->prepare("UPDATE users SET email_verified_at=now() WHERE email_address = (:email)  AND verification_code = (:veriCode)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':veriCode', $verification_code);
        $execution = $stmt->execute();
        $img = "../images/check-mark-green-tick-mark-symbol-recycling-symbol-text-logo-transparent-png-1725288.png";
        $message1 = "Account Activated";
        $msg = "Your account has been activated";
    } else {
        $img = "../images/Red-Cross-Mark-Download-PNG.png";
        $message1 = "Account not activated";
        $msg = "Your account has not been activated, please check the verification code and re-enter again";
    }
}
$conn = null;
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/email_veri.css" rel="stylesheet" type="text/css" />
    <script src="../js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <link href="../css/master.css" rel="stylesheet" type="text/css" />
    <title>Grocery shop</title>
    <link rel="icon" href="images/fu.ico" type="images/x-icon" />
</head>
<body>
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" id="img" src="<?php echo $img; ?>" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title"><?php echo $message1 ?></p></h5>
            <p class="card-text"><?php echo $msg; ?></p>
            <a href="../index.php" class="btn btn-dark">Back To Login Page</a>
        </div>
    </div>
</body>