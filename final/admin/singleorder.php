
<?php require '../functions.php';
require 'header.php';
$user = array();
$orders = array();
$userId = $_GET['user_id'];

if(isset($_GET['user_id'])){
  $queryItems = "SELECT *
              FROM users
              WHERE id = $userId LIMIT 1";
$sqlItem = mysqli_query($db, $queryItems);
$user = mysqli_fetch_assoc($sqlItem);
}

if(isset($_GET['transaction_id'])){
  $transactionId = $_GET['transaction_id']; 
  $queryItems = "SELECT o.*, p.image, p.productname, p.price, p.size 
              FROM orders AS o 
              JOIN products AS p ON o.product_id = p.id
              WHERE o.transaction_id = '$transactionId'";
$sqlItem = mysqli_query($db, $queryItems);
$orders = mysqli_fetch_all($sqlItem, MYSQLI_ASSOC);
}

if(isset($_POST['order-update'])){
$transactionId = $_POST['transaction_id']; 
$status = $_POST['status'];

$queryUpdate = "UPDATE orders SET status = '$status' WHERE transaction_id = '$transactionId'";
$sqlUpdate = mysqli_query($db, $queryUpdate);

header("Location: /final/admin/orders.php");

}


?>

<link rel="stylesheet" type="text/css" href="admin_style.css">
    

    <li><a href="orders.php" class="fa fa-angle-left"> Back to orders</a> </li>
    <section id="singleorder">
    <form action="singleorder.php" method="post">
        <div class="contact-info">
          <h3>Shipping Details</h3>
          <input type="hidden" name="transaction_id" value="<?php echo $_GET['transaction_id']?>">
            <div>Customer name: <input type="text" name="full-name" value='<?php echo "{$user['fname']} {$user['fname']}" ;?>'' disabled></div>
            <div>Contact Number: <input type="text" name="number" value="<?php echo $user['pnumber'];?>" disabled></div>
            <div>E-mail address: <input type="text" name="email" value="<?php echo $user['email'];?>" disabled></div>
            <br><p>Shipping address:</p>
            <input type="text" name="house_number" placeholder="House no." value="<?php echo $user['house_number'];?>" />
            <input type="text" name="street" placeholder="Street" value="<?php echo $user['street'];?>"/><br>
            <input type="text" name="brgy" placeholder="Barangay" value="<?php echo $user['brgy'];?>"/>
            <input type="text" name="city" placeholder="City" value="<?php echo $user['city'];?>"/>
            <input type="text" name="province" placeholder="Province" value="<?php echo $user['province'];?>"/><br>
        </div>

        <h3>Orders</h3>

        <div class="shopping-cart">

            <div class="column-labels">
              <div class="product-image">Image</div>
              <div class="product-details">Product</div>
              <div class="product-line-price">Total</div>
            </div>
            <?php foreach($orders as $order):?>
              <div class="product">
              <div class="product-image">
                <img src="../uploads/<?php echo $order['image']; ?>">
              </div>
              <div class="product-details">
                <div class="product-title"><?php echo $order['productname']; ?></div>
              </div>
              <div class="product-line-price"><?php echo $order['price'] * $order['quantity'];?></div>
            </div>
            <?php endforeach?>
        <div class="totals">
            <div class="totals-item">
              <p>Subtotal</p>
              <div class="totals-value" id="cart-subtotal"><?php echo $order['price'];?></div>
            </div>
            <div class="totals-item">
              <p>Tax (5%)</p>
              <div class="totals-value" id="cart-tax"></div>
            </div>
            <div class="totals-item">
              <p>Shipping</p>
              <div class="totals-value" id="cart-shipping"></div>
            </div>
            <div class="totals-item totals-item-total">
              <p>Grand Total</p>
              <div class="totals-value" id="cart-total"></div>
            </div>
          </div>
        <div class="submit-order">
          <select name="status">
              <option <?php echo ($order['status']=='ordered') ? 'selected' :''?> value="ordered">Ordered</option>
              <option <?php echo ($order['status']=='shipped') ? 'selected' :''?> value="shipped">Shipped</option>
              <option <?php echo ($order['status']=='ontheway') ? 'selected' :''?> value="ontheway">On-the-way</option>
              <option <?php echo ($order['status']=='delivered') ? 'selected' :''?> value="delivered">Delivered</option>
          </select>
            <button type="submit" name="order-update" class="submit-order1">Update</button>
        </div>
        </div>
    </form>

</section>

<script>
    var taxRate = 0.05;
var shippingRate = 15.00;
var fadeTime = 300;


/* Assign actions */
$('.product-quantity input').change( function() {
  updateQuantity(this);
});

$('.product-removal button').click( function() {
  removeItem(this);
});


/* Recalculate cart */
function recalculateCart()
{
  var subtotal = 0;
  
  /* Sum up row totals */
  $('.product').each(function () {
    subtotal += parseFloat($(this).children('.product-line-price').text());
  });
  
  /* Calculate totals */
  var tax = subtotal * taxRate;
  var shipping = (subtotal > 0 ? shippingRate : 0);
  var total = subtotal + tax + shipping;
  
  /* Update totals display */
  $('.totals-value').fadeOut(fadeTime, function() {
    $('#cart-subtotal').html(subtotal.toFixed(2));
    $('#cart-tax').html(tax.toFixed(2));
    $('#cart-shipping').html(shipping.toFixed(2));
    $('#cart-total').html(total.toFixed(2));
    if(total == 0){
      $('.checkout').fadeOut(fadeTime);
    }else{
      $('.checkout').fadeIn(fadeTime);
    }
    $('.totals-value').fadeIn(fadeTime);
  });
}
recalculateCart();

/* Update quantity */
function updateQuantity(quantityInput)
{
  /* Calculate line price */
  var productRow = $(quantityInput).parent().parent();
  var price = parseFloat(productRow.children('.product-price').text());
  var quantity = $(quantityInput).val();
  var linePrice = price * quantity;
  
  /* Update line price display and recalc cart totals */
  productRow.children('.product-line-price').each(function () {
    $(this).fadeOut(fadeTime, function() {
      $(this).text(linePrice.toFixed(2));
      recalculateCart();
      $(this).fadeIn(fadeTime);
    });
  });
}


/* Remove item from cart */
function removeItem(removeButton)
{
  /* Remove row from DOM and recalc cart total */
  var productRow = $(removeButton).parent().parent();
  productRow.slideUp(fadeTime, function() {
    productRow.remove();
    recalculateCart();
  });
}
</script>