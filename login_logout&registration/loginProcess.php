<?php
session_start();
session_regenerate_id();
// php file that contains the common database connection code
//include "../db_stuff/db.php";
include "../db_stuff/test_db.php";
//MFA portion
include "../MFA/MFA.php";
//end of MFA portion
if (isset($_POST['username'])&& isset($_POST['password'])&& isset ($_POST['MFA_code'])){
    $entered_username = hash('sha256', htmlspecialchars(stripslashes($_POST['username'])));
    $entered_password = hash('sha256', htmlspecialchars(stripslashes($_POST['password'])));
    $MFA_code = $_POST['MFA_code'];
}
else{
    echo "All fields must be filled up before continuing";
}
$msg = "";
$MFA_response = "";
$stmt = $conn->prepare("SELECT * FROM users
           WHERE user_name=(:eu)
           AND password = (:ep) AND email_verified_at IS NOT NULL");
$stmt->bindParam(":eu", $entered_username, PDO::PARAM_STR);
$stmt->bindParam(":ep", $entered_password, PDO::PARAM_STR);
$result = $stmt->execute();
$img = "../images/Red-Cross-Mark-Download-PNG.png";
if ($result == 1 && $g->checkCode($secret, $MFA_code) == 1) {
    $rows = $stmt->fetchAll();
    foreach ($rows as $row) {
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['user_name'] = $row['user_name'];
        $_SESSION['start'] = time();
        $_SESSION['expire'] = $_SESSION['start'] + (30*60);
        header("Location: ../Grocery_store_app.php");
    }
} else {
    $msg = "<p>Please try again the entered username and password is wrong or the code you have entered is wrong</p>";
}
//$conn = null;
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/registration.css" rel="stylesheet" type="text/css" />
    <link href="../css/master.css" rel="stylesheet" type="text/css" />
    <script src="../js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <title>Grocery shop</title>
    <link rel="icon" href="../images/fu.ico" type="images/x-icon" />
</head>

<body>
    <br />
    <br />
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" id="img" src="<?php echo $img; ?>" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">Login Failed</p>
            </h5>
            <p class="card-text"></p>
            <?php echo $msg; ?>
            <p>Click here if your account has not been activated</p>
            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">Activate Account</button>
            <br>
            <br>
            <a href="../index.php" class="btn btn-dark">Back To Login Page</a>
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
                        <input class="form-control" type="text" name="email" placeholder="Enter your email address" required>
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