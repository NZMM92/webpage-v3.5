<?php
//include "db.php";
include "test_db.php";
$query = "SELECT * FROM products";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll();
$i = 0;
$action = isset($_GET['action']) ? $_GET['action'] : "";
foreach ($result as $data) {
    $i += 1;
?>
    <div class="col-md-4 mt-4" style="display:inline-block; max-width: 18rem;">
        <div class="card border-warning">
            <div class="card-header"><?php echo $data['product_name']; ?></div>
            <div class="card-body">
                <img src="../Web_App/images/pro-<?php echo $i ?>.jpg" width="200" height="150">
                <p class="card-text"><?php echo "Price: $", $data['product_price']; ?></p>
                <br>
                <form action="/" method="POST">
                    <a class="btn btn-success btn-lg" name="add-to-cart" role="button" onclick="addToCart(<?php echo $data['id']; ?>)"><span>Buy now</span></a>
                    <input type="hidden" name="productName" value="<?php echo $data['product_name']; ?>">
                    <input type="hidden" name="productPrice" value="<?php echo $data['product_price']; ?>">
                </form>
            </div>
        </div>
    </div>
<?php
}
?>
