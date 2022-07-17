<!DOCTYPE HTML>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/checkoutPage.css" rel="stylesheet" type="text/css" />
    <link href="../css/master.css" rel="stylesheet" type="text/css" />
    <script src="../js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="../js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <title>Grocery shop</title>
    <link rel="icon" href="../images/fu.ico" type="images/x-icon" />
    <title>Success</title>
</head>

<body>
    <br>
    <h3 style="text-align: center;">Transaction has been completed</h3>
    <div class="addressBox">
        <form action="doSuccess.php" method="POST">
            <h5 style="text-align: center;">Shipping Address</h5>
            <input class="form-control" type="text" placeholder="Ship To" name="Address">
            <br>
            <button class="btn btn-dark" style="text-align: center;" type="submit">Submit</button>
        </form>
    </div>
</body>