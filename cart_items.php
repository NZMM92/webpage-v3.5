<?php
session_start();
include "../Web_App/payment/strip_config.php";
//include "../Web_App/db_stuff/db.php";
include "../Web_App/db_stuff/test_db.php";
\Stripe\Stripe::setApiKey($secret_key);
$name = htmlspecialchars(stripslashes($_POST['product-name']));
$pricing = htmlspecialchars(stripslashes($_POST['product-price']));
$price_arr = explode(",", $pricing);
$final = 0.00;
foreach ($price_arr as $y) {
    $final += floatval($y);
}
//db portion
$query = $conn->prepare("INSERT INTO orders (items, total_price, username) VALUES (:name, :price, :user)");
$query->bindParam(":name", $name);
$query->bindParam(":price", $final);
$query->bindParam(":user", htmlspecialchars(stripslashes($_SESSION['user_name'])));
$result = $query->execute();
$conn = null;
//end of db portion
$conn = null;
//payment section

$session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [[
        'price_data' => [
            'currency' => 'sgd',
            'product_data' => [
                'name' => $name,
            ],
            'unit_amount_decimal' => floatval($final) * 100,
        ],
        'quantity' => 1,
    ]],
    'mode' => 'payment',
    //note to self replace this with the domain link if not this won't work on the production site and also change it to https
    'success_url' => 'http://localhost/Web_App/payment/success.php',
    //note to self replace this with the domain link
    'cancel_url' => 'http://localhost/Web_App/Grocery_store_app.php',
]);
header("HTTP/1.1 303 See Other");
header("Location: " . $session->url);
//payment section end
?>
<!DOCTYPE html>
<html>
<head>
    <title>Grocery shop</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=">
    <meta name="keywords" content="HTML5,CSS,JavaScript, html5 session storage, html5 local storage">
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/master.css" rel="stylesheet" type="text/css" />
    <link href="css/checkoutPage.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="https://kit.fontawesome.com/8986e240e9.js" crossorigin="anonymous"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <link rel="icon" href="../images/fu.ico" type="images/x-icon" />
</head>
<body>
</body>