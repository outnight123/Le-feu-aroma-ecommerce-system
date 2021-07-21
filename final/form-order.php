<?php require 'functions.php';
require 'header.php';
    
    $queryUserDetails = "SELECT CONCAT(fname, ' ', lname) AS customer_name, house_number, street, brgy, city, province, pnumber, email FROM users WHERE id = '".$_SESSION['user_id']."'";
    $sqlUserDetails = mysqli_query($db, $queryUserDetails);

    $user_details = mysqli_fetch_assoc($sqlUserDetails);

    $queryItems = "SELECT products.id, image, productname, price, product_id, user_id, quantity FROM cart inner join products ON product_id = products.id WHERE user_id = '".$_SESSION['user_id']."'";
    $sqlItems = mysqli_query($db, $queryItems);

    $all_items = mysqli_fetch_all($sqlItems, MYSQLI_ASSOC);

?>

    <section id="form-order">

    <!--form-order-->  


    <li><a href="user-cart.php" class="fa fa-angle-left"> Back to cart</a> </li>

    <h1>Checkout</h1>

    <form action="purchase-receipt.php" method="post">
        <div class="contact-info">
          <h3>SHIPPING DETAILS</h3>
            <div>Customer name: <input type="text" name="full-name" value="<?php echo $user_details['customer_name'];?>" disabled></div>
            <div>Contact Number: <input type="text" name="number" value="<?php echo $user_details['pnumber'];?>" disabled></div>
            <div>E-mail address: <input type="text" name="email" value="<?php echo $user_details['email'];?>" disabled></div>
            <br><div><!-- Default address: <input type="text" name="default_address" style="width: 280px;" value="<?php echo $user_details['default_address'];?>"></div> -->
            <br><p>Shipping address:</p>
            <input type="text" name="house_number" placeholder="House no." value="<?php echo $user_details['house_number'];?>" />
            <input type="text" name="street" placeholder="Street" value="<?php echo $user_details['street'];?>"/><br>
            <input type="text" name="brgy" placeholder="Barangay" value="<?php echo $user_details['brgy'];?>"/>
            <input type="text" name="city" placeholder="City" value="<?php echo $user_details['city'];?>"/>
            <input type="text" name="province" placeholder="Province" value="<?php echo $user_details['province'];?>"/><br>
        </div>
        
        <h2>Viewing</h2>
        <h3>All Orders</h3>

        <div class="shopping-cart">

            <div class="column-labels">
              <div class="product-image">Image</div>
              <div class="product-details">Product</div>
              <div class="product-line-price">Total</div>
            </div>

 <?php foreach($all_items as $item):?>
              <div class="product">
              <div class="product-image">
                <img src="uploads/<?php echo $item['image']; ?>">
              </div>
              <div class="product-details">
                <div class="product-title"><?php echo $item['productname']; ?></div>
              </div>
              <div class="product-line-price"><?php echo $item['price'] * $item['quantity'];?></div>
            </div>
          <?php endforeach ?>

        <div class="totals">
            <div class="totals-item">
              <p>Subtotal</p>
              <div class="totals-value" id="cart-subtotal"><?php echo $item['price'];?></div>
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
              <input readonly class="totals-value" name="grand_total" id="cart-total"></input>
            </div>
          </div>
        <div class="submit-order">
        <p>Cash on delivery only, please prepare exact amount<br>NO CANCELLATION ONCE ORDERS ARE PLACED</p>
        <button type="submit" name="submit" class="submit-order1">SUBMIT ORDER</button>
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
    $('#cart-total').val(total.toFixed(2));
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
    <!--Footer-->
<?php require 'footer.php';?>