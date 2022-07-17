<?php
session_start();
//include "../db_stuff/db.php";
include "../db_stuff/test_db.php";
$address = htmlspecialchars(stripslashes($_POST['Address']));
$query = $conn->prepare("UPDATE orders SET address= :addr WHERE username = :user");
$query->bindParam(":addr", $address);
$query->bindParam(":user", htmlspecialchars(stripslashes($_SESSION['user_name'])));
$query->execute();
$conn = null;
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta http-equiv="refresh" content="10;url=../Grocery_store_app.php" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/checkoutPage.css" rel="stylesheet" type="text/css" />
    <link href="../css/master.css" rel="stylesheet" type="text/css" />
    <script src="../js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <title>Grocery shop</title>
    <link rel="icon" href="../images/fu.ico" type="images/x-icon" />
    <title>Success</title>
</head>

<body>
    <br>
    <br>
    <br>
    <h3 style="text-align: center;">Thank you for shopping with us!</h3>
</body>