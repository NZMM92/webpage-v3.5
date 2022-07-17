<?php
session_start();
// php file that contains the common database connection code
//include "../db_stuff/db.php";
include "../db_stuff/test_db.php";
$NewPw = hash('sha256', $_POST['newpw']);
$veriCode = $_POST['verification_code'];
$entered_username = $_POST['username'];
$msg = "";
if ($_SESSION['veriCodes'] == $veriCode) {
    $stmt = $conn->prepare("UPDATE users SET password = :Newpw  WHERE user_name = :eu AND email_address = :ee ");
    $stmt->bindParam(":Newpw", htmlspecialchars(stripslashes($NewPw)), PDO::PARAM_STR);
    $stmt->bindParam(":eu", htmlspecialchars(stripslashes($entered_username)), PDO::PARAM_STR);
    $stmt->bindParam(":ee", htmlspecialchars(stripslashes($entered_email)), PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->rowCount();
    echo $results;
    if ($results == 1) {
        $msg = "Password has been resetted";
    } else {
        $msg = "Password not resetted";
    }
}
else{
    $msg = "Verification code entered is wrong";
}
?>
<DOCTYPE html>
<html>
<head>
    <title>Grocery shop</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=">
    <meta name="keywords" content="HTML5,CSS,JavaScript, html5 session storage, html5 local storage">
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/master.css" rel="stylesheet" type="text/css" />
    <link href="../css/checkoutPage.css" rel="stylesheet" type="text/css" />
    <script src="../js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <link rel="icon" href="../images/fu.ico" type="images/x-icon" />
</head>

<body>
    <div class="card text-center" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Password Reset</p>
            </h5>
            <p class="card-text"><?php echo $msg;?></p>
            <br>
            <br>
            <a href="../index.php" class="btn btn-dark">Back To Login Page</a>
            <br>
        </div>
</body>