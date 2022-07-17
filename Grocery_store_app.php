<?php
session_start();
session_regenerate_id();
$msg = "";
//include "../Web_App/db_stuff/db.php";
include "../Web_App/db_stuff/test_db.php";
?>
<!DOCTYPE html>
<html>

<head>
    <title>Grocery shop</title>
    <meta charset="UTF-8">
    <meta name="keywords" content="HTML5,CSS,JavaScript, html5 session storage, html5 local storage">
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/master.css" rel="stylesheet" type="text/css" />
    <link href="css/dark-mode.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="js/producePage.js" type="text/javascript"></script>
    <script src="https://kit.fontawesome.com/8986e240e9.js" crossorigin="anonymous"></script>
    <link rel="icon" href="images/fu.ico" type="images/x-icon" />
</head>

<body>
    <?php
    if (!isset($_SESSION['user_name'])) {//if nothing is set
        header("location: ../Web_App/index.php"); // redirects back to the login page 
    }
    ?>
    <?php if (isset($_SESSION['user_name'])) { ?>
        <!-- navbar -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="logo-image">
                <img src="images/135763.png" class="img-fluid">
            </div>
            <a class="navbar-brand">Grocery Shop</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#category">Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#product">Products</a>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#cart" onclick="showCart();"><i class="fa-solid fa-cart-shopping"></i>Cart</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-dark" id="butt3" data-toggle="modal" data-target="#contactDetails">Contact Us</button>
                    </li>
                    <li class="nav-item">
                        <form class="form-inline" action="login_logout&registration/logout.php" method="post" id="signOut">
                            <button class="btn btn-dark" type="submit">Sign out</button>
                        </form>
                    </li>
                </ul>
                <div class="fixed-top">
                    <div class="collapse" id="navbarToggleExternalContent">
                        <div class="bg-dark p-4">
                            <h5 class="text-white h4">Collapsed content</h5>
                            <span class="text-muted">Toggleable via the navbar brand.</span>
                        </div>
                    </div>
                </div>
                <img src="images/moon.png" id="icon">
        </nav>
        <br />
        <br />
        <br />
        <!-- category section -->
        <div class="category"></div>
        <h2 style="text-align: center">Categories</h2>
        <div class="card-deck">
            <div class="card card border-success" id="cat">
                <img class="card-img-top" src="images/cat_1.jpg">
                <div class="card-body">
                    <h5 class="card-title">Vegetables</h5>
                    <p class="card-text">upto 30% off</p>
                    <br />
                    <!-- "#product" -->
                    <a class="btn btn-success btn-lg" href="https://impomu.com/" role="button"><span>Buy now </span></a>
                </div>
            </div>
            <div class="card card border-warning" id="cat">
                <img class="card-img-top" src="images/cat_2.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Fruits</h5>
                    <p class="card-text">upto 44% off</p>
                    <br>
                    <!-- #product -->
                    <a class="btn btn-success btn-lg" href="https://impomu.com/" role="button"><span>Buy now </span></a>
                </div>
            </div>
            <div class="card card border-danger" id="cat">
                <img class="card-img-top" src="images/cat_3.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Meat</h5>
                    <p class="card-text">upto 50% off</p>
                    <br>
                    <!-- #product -->
                    <a class="btn btn-success btn-lg" href="https://impomu.com/" role="button"><span>Buy now </span></a>
                </div>
            </div>
        </div>
        </a>
        <!-- Product Pages -->
        <h2 style="text-align: center">Products</h2>
        <?php include "../Web_App/db_stuff/get_product_from_db.php"; ?>
        <!-- contact us -->
        <div class="modal fade" id="contactDetails" tabindex="-1" role="dialog" aria-labelledby="contactDetails" aria-hidden="true">
            <div class="modal-dialog modal-dialong-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="contactDetails">Contact Us</h4>
                        <button type="button" class="btn btn-primary close" data-dismiss="modal" aria-label="close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Contact Details: 66568945</p>
                        <p>Send us through this number through WhatsApp or just call-in to enquire about our products</p>
                        <p>Vist the office at 10 Upper Aljunied Link 06-04 York International Ind Bldg Singapore 367904</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/xavierScripts.js" text="text/javascript"></script>
        <!-- cart -->
        <div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="cartTable" aria-hidden="true">
            <div class="modal-dialog modal-dialong-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="cartTItle">Cart</h4>
                        <button type="button" class="btn btn-primary close" data-dismiss="modal" aria-label="close"><span aria-hidden="true"></span></button>
                    </div>
                    <div class="modal-body">
                        <table class="table" id="cartTable" style="width:100%">
                            <thread>
                                <tr>
                                    <th style="border-bottom: 1px solid #000106;" scope="col">Product</th>
                                    <th style="border-bottom: 1px solid #000106;" scope="col">Price</th>
                                </tr>
                            </thread>
                            <tbody id="cartContents">
                            </tbody>
                        </table>
                        <br>
                        <h5 align="right">Total Price $<span id="modal_total-price"></span></h5>
                    </div>
                    <div class="modal-footer border-top-0 d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-dark" onclick="ClearAll()">Clear Cart</button>
                        <form action="../Web_App/cart_items.php" method="POST">
                            <input type="hidden" id="naming" name="product-name" value="">
                            <input type="hidden" id="pricing" name="product-price" value="">
                            <button type="submit" class="btn btn-primary">Checkout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
        <script src="js/cart.js" type="text/javascript"></script>
    <?php } ?>
</body>

</html>