<?php require 'functions.php';
require 'header.php';
// echo "<pre>", print_r($_POST, true), "</pre>";
// die();


        if (isset($_POST['submit'])) {
       $house_number =  $_POST['house_number'];
       $street =  $_POST['street'];
       $brgy =  $_POST['brgy'];
       $city =  $_POST['city'];
       $province = $_POST['province'];
       $order_id = array();
       $total_price = 0;
       $grandTotal = $_POST['grand_total'];
       $transactionId = bin2hex(random_bytes(10));

    //    $query = "INSERT INTO shipping_address (house_number, street, brgy, city, province) VALUES ('$house_number', '$street', '$brgy', '$city', '$province')";
    //    mysqli_query($db, $query);
    //    $shipping_address_id = mysqli_insert_id($db);

       $queryItems = "SELECT products.id, image, productname, price, product_id, user_id, quantity FROM cart inner join products ON product_id = products.id WHERE user_id = '".$_SESSION['user_id']."'";
       $sqlItem = mysqli_query($db, $queryItems);
       $all_item = mysqli_fetch_all($sqlItem, MYSQLI_ASSOC);
       foreach ($all_item as $item) {
       $query = "INSERT INTO orders (transaction_id, user_id, product_id, quantity, grand_total) VALUES ('$transactionId','".$_SESSION['user_id']."', '".$item['product_id']."', '".$item['quantity']."', '$grandTotal')";
       mysqli_query($db, $query);
       array_push($order_id, mysqli_insert_id($db));
       $total_price += $item['quantity'] * $item['price'];
      }
       $query = "DELETE FROM cart  WHERE user_id = '".$_SESSION['user_id']."'";
       mysqli_query($db, $query);
       $current_id = current($order_id); 
       $end_id = end($order_id);
        $query = "SELECT productname, size FROM orders inner join products ON product_id = products.id WHERE user_id = '".$_SESSION['user_id']."'
        AND orders.id BETWEEN '$current_id' AND '$end_id'";
        $sql = mysqli_query($db, $query);
        $product_details = mysqli_fetch_all($sql, MYSQLI_ASSOC);
    }

        $tax = $total_price * 0.05;
        $grand_total = $total_price + $tax + 15;
?>
      <!--purchase-receipt-->
      <section id="purchase-receipt">
        <div class="card">
            <div class="title">Purchase Reciept</div>
            <div class="info">
                <div class="row">
                    <div class="col-5 pull-right"> <span id="heading">Order No.</span><br> <span id="details">
                        <?php echo $transactionId?>
            </span>
            </div>
                </div>
            </div>
            <?php foreach($product_details as $pdetail):?>
            <div class="pricing">
                <div class="row">
                    <div class="col-9"> <span id="product"><?php echo $pdetail['productname']; ?></span>- <span id="size"><?php echo $pdetail['size'];?></span> </div>
                </div>

            </div>
        <?php endforeach?>
            <div class="total">
                <div class="row">
                    <div class="col-9"></div>
                    <div class="col-3 totals-value" id="cart-total"><?php echo $grand_total;?></div>
                </div>
            </div>
            <div class="tracking">
                <div class="title">Tracking Order</div>
            </div>
            <div class="progress-track">
                <ul id="progressbar">
                    <li class="step0 active " id="step1">Ordered</li>
                    <li class="step0 text-center" id="step2">Shipped</li>
                    <li class="step0 text-right" id="step3">On the way</li>
                    <li class="step0 text-right" id="step4">Delivered</li>
                </ul>
            </div>
            <li><a href="orders.php"> View Orders </a> </li>
        </div>
</section>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<!--Footer-->
<?php require 'footer.php';?>