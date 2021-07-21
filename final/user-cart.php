<?php require 'functions.php';
include 'header.php';
    
    if (isset($_GET['id']) && isset($_GET['quantity'])) {
      $query = "SELECT * FROM cart WHERE product_id = '".$_GET['id']."'";
      $run_query = mysqli_query($db, $query);
      $productInCart= $run_query->fetch_assoc();

      // ang ginagawa nito, chinecheck nya muna if nasa cart na yung product if wala, iaadd nya, if meron iuupdate nya lang yung quantity
      if (!empty($productInCart)) {
        $updatedQuantity = $productInCart['quantity'] + $_GET['quantity'];
        $productInCartId = $productInCart['id'];
        $queryUpdate = "UPDATE cart SET quantity = $updatedQuantity WHERE id = $productInCartId";
        $run_query_update = mysqli_query($db, $queryUpdate);
      } else {
        $query = "INSERT INTO cart (product_id, user_id, quantity)
        VALUES ('".$_GET['id']."', '".$_SESSION['user_id']."', '".$_GET['quantity']."')";
        $run_query = mysqli_query($db, $query);
      }
      
    }

    if (isset($_SESSION['user_id'])) {
    $query = "SELECT products.id, image, productname, price, product_id, quantity, user_id FROM cart inner join products ON product_id = products.id WHERE user_id = '".$_SESSION['user_id']."'";
    $run_query = mysqli_query($db, $query);

    $carts = mysqli_fetch_all($run_query, MYSQLI_ASSOC);
  }
      if (isset ($_POST['remove_item'])) {
        $remove_item = $_POST['remove_item'];

        $queryDelete = "DELETE FROM cart WHERE product_id = $remove_item AND '".$_SESSION['user_id']."'";
        $sqlDelete = mysqli_query($db, $queryDelete);

          echo "<script>alert('Successfully removed!');
          window.location.href='user-cart.php';</script>";
    }

?>
    <!--user-cart-->
    <?php if(!empty($carts)):?>
      <section id="user-cart">
          <h1>Shopping cart</h1>
          <div class="shopping-cart">
          
            <div class="column-labels">
              <div class="product-image">Image</div>
              <div class="product-details">Product</div>
              <div class="product-price">Price</div>
              <div class="product-quantity">Quantity</div>
              <div class="product-removal">Remove</div>
              <div class="product-line-price">Total</div>
            </div>
          
            <?php foreach($carts as $cart):?>
              <div class="product">
              <div class="product-image">
                <img src="uploads/<?php echo $cart['image']; ?>">
              </div>
              <div class="product-details">
                <div class="product-title"><?php echo $cart['productname']?></div>
              </div>
              <div class="product-price"><?php echo $cart['price']?></div>
              <div class="product-quantity">
                <input type="number" readonly value="<?php echo $cart['quantity'] ?>" min="1" name="quantity">
              </div>
              <div class="product-removal">
                      <form action="user-cart.php" method="post">
                      <button class="remove-product" >Remove</button>
                      <input type="hidden" name="remove_item" value="<?php echo $cart['id'] ?>">
                      </form>
              </div>
              <div class="product-line-price"><?php echo $cart['price'] * $cart['quantity']?></div>
            </div>
            <?php endforeach ?>
  
            <div class="totals">
              <div class="totals-item">
                <p>Subtotal</p>
                <div class="totals-value" id="cart-subtotal"></div>
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
                <a id="checkout" class="checkout" href ="form-order.php?checkout=<?php echo $_SESSION['user_id']?>">Checkout</a>
          </div>
        </section>
    <?php else:?>
      <section id="cart">
        <p>Your shopping cart is empty. <a href="/final/shop.php">Checkout our products.</a></p>
    </section>
    <?php endif;?>
    <!--Footer-->
    <section id="footer">
        <div class="container">

        <div class="row">
            <div class="footer-col">
                <h6>SHOP</h6>
                <ul>
                    <li><a href="home.php">Le feu aroma website</a></li>
                    <li><a href="https://shopee.ph/lefeuaroma?smtt=0.0.9">Shopee</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h6>CONTACT US</h6>
                <p>0938-618-1581</p>
                <p>lefeuaroma@gmail.com</p>

            </div>
            <div class="footer-col">
                <h6>LOCATION</h6>
                <p>Brgy. Looc<br>Calamba City, Laguna<br>Philippines<br>4027</p>
            </div>
            <div class="footer-col">
                <h6>SOCIAL MEDIA</h6>
                <p>Follow Our Story</p>
                <div class="social-links">
                <ul>
                    <a href="#" class="fa fa-twitter"></a>
                    <a href="https://www.facebook.com/lefeuaroma/" class="fa fa-facebook"></a>
                    <a href="https://instagram.com/lefeuaroma" class="fa fa-instagram"></a>
                </ul>
                </div>
            </div>
          </div>
        </div>

        <div class="footer-logo">
        <a href="#" ><img src="https://drive.google.com/uc?id=1kswusREaqaR2TIphyHl00OpnMGRO8Oun"></a>
        </div>
    </section>

    <!--JS-->
    <script src="./app.js"></script>
<!--JS-->
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
</body>
</html>