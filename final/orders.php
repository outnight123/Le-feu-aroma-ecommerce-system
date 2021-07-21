<?php require 'functions.php';
require 'header.php';
$userId = $_SESSION['user_id'];
$queryItems = "SELECT o.*,
              p.image, p.productname, p.price, p.size
              FROM orders AS o 
              join products as p ON o.product_id = p.id
              WHERE o.user_id = $userId ORDER BY id DESC";
$sqlItem = mysqli_query($db, $queryItems);
$placedOrders = mysqli_fetch_all($sqlItem, MYSQLI_ASSOC);

// echo "<pre>", print_r($placedOrders, true), "</pre>";
// die();
?>

      <!--Orders-->

      <section id="orders">
        <h1>Orders</h1>
        <?php foreach($placedOrders as $order):?>
            <div class="order-1" style="margin-bottom: 20px;">
                <div class="info">
                    <div class="row">
                        <div class="col-5 pull-right"> <span id="heading">Order No.</span><br> <span id="details"><?php echo $order['transaction_id']?></span> </div>
                    </div>
                </div>

                <div class="pricing">
                    <div class="row">
                        <div class="col-9"> <span id="product"><?php echo $order['productname']?></span>- <span id="size"><?php echo $order['size']?></span> </div>
                    </div>
                </div>
                
                <div class="total">
                    <div class="row">
                        <div class="col-9"></div>
                        <div class="col-3 totals-value"  id="cart-total"><?php echo $order['grand_total']?></div>
                    </div>
                </div>
                <div class="tracking">
                    <div class="title">Tracking Order</div>
                </div>
                <div class="progress-track">
                    <ul id="progressbar">
                        <li class="step0 text-center <?php echo ($order['status'] == 'ordered') ? 'active': ''?>" id="step1">Ordered</li>
                        <li class="step0 text-center <?php echo ($order['status'] == 'shipped') ? 'active': ''?>" id="step2">Shipped</li>
                        <li class="step0 text-center <?php echo ($order['status'] == 'ontheway') ? 'active': ''?>" id="step3">On the way</li>
                        <li class="step0 text-center <?php echo ($order['status'] == 'delivered') ? 'active': ''?>" id="step4">Delivered</li>
                    </ul>
                </div>
            </div>
        <?php endforeach?>

    </section>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<!--Footer-->
<?php require 'footer.php';?>