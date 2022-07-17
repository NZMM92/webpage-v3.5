import purify from "./purify";
var nameOfProduct = [];
var priceOfProduct = [];
var productID = {};
var cart = [];
var nameArray = [];
var priceArray = [];
var table = document.getElementById("cartContents");
var total = document.getElementById("modal_total-price");
var uniqueName = [];
var uniquePrice = [];
document.querySelectorAll('input[name=productName]').forEach(function (name) {
    nameOfProduct.push(purify.sanitize(name.value));
})
document.querySelectorAll('input[name=productPrice]').forEach(function (price) {
    priceOfProduct.push(purify.sanitize(price.value));
})
function addToCart(id) {
    productID = parseInt(id);
    productID--;
    if (nameOfProduct[productID] != null && priceOfProduct[productID] != null) {
        var Items = {
            name: nameOfProduct[productID],
            price: parseFloat(priceOfProduct[productID]),
        };
        cart.push(Items);
        sessionStorage.setItem("cart", JSON.stringify(cart));
        showCart();
    }
}
function showCart() {
    var userCart = JSON.parse(sessionStorage.getItem("cart"));
    purify.sanitize(userCart);
    const tr = [];
    var totalPrice = 0.00;
    userCart.forEach(item => {
        totalPrice += item.price;
        tr.push('<tr><td>' + item.name + '</td>' + '<td>' + item.price + '</>');
        nameArray.push(item.name);
        priceArray.push(item.price);
        uniqueName = [...new Set(nameArray)];
        uniquePrice = [... new Set(priceArray)];
        table.value = tr.join("");
        total.value = totalPrice.toFixed(2);
        document.getElementById("naming").value = uniqueName;
        document.getElementById("pricing").value = uniquePrice;

    })
}
function ClearAll() {
    sessionStorage.clear();
    table.innerText = '';
    total.innerText = '0';
}

