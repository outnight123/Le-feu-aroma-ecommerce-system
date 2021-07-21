<?php
require '../functions.php';
      $queryItems = "SELECT o.*, 
                    CONCAT(u.fname, ' ', u.lname) AS name, 
                    CONCAT(u.house_number, ' ', u.street, ' ', u.brgy, ' ', u.city, ' ', u.province) AS address 
                    FROM orders AS o join users AS u ON o.user_id = u.id";
      $sqlItem = mysqli_query($db, $queryItems);
      $orders = mysqli_fetch_all($sqlItem, MYSQLI_ASSOC);
//       echo "<pre>", print_r( $orders, true), "</pre>";
// die();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" type="text/css" href="admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


<body>
<li><a href="home.php" class="fa fa-angle-left"> Back to Home</a> </li>
    <div class="main">
        <table class="read-main">
            <tr>
                <th>Order Id</th>
                <th>User Name</th>
                <th>Shipping Address</th>
                <th>Status</th>
                <th>Delete</th>
            </tr>
            <?php foreach($orders as $order):?>
            <tr>
                <td><a href="/final/admin/singleorder.php?user_id=<?php echo $order['user_id']?>&transaction_id=<?php echo $order['transaction_id']?>"><?php echo $order['transaction_id']?></a></td>
                <td><?php echo $order['name']?></td>
                <td><?php echo $order['address']?></td>
                <td><?php echo $order['status']?></td>
                <td>
                    <form action="/final/admin/delete_orders.php" method="post">
                        <input type="submit" name="delete" value="DELETE">
                        <input type="hidden" name="deleteId" value="<?php echo $order['transaction_id'] ?>">
                </td>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
</body>
</html>