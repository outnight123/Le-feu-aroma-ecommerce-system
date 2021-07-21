<?php
    require('./read_products.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
    <link rel="stylesheet" type="text/css" href="admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<body>
<section id="products">
<li><a href="home.php" class="fa fa-angle-left"> Back to Home</a> </li>
    <div class="main">
        <form action="/final/admin/create.php" class="create-main" method="post" enctype="multipart/form-data">
            <h3>ADD PRODUCT</h3>
            <div>
            <input type="file" name="image" required/>
            </div>
            <input type="text" name="productname" placeholder="Product Name" required/>
            <input type="text" name="size" placeholder="Size" required/>
            <input type="number" name="price" placeholder="Price" required/>
            <input type="text" name="description" placeholder="Description" required/>
            <input type="submit" name="create" value="ADD" />
        </form>

        <table class="read-main">
            <tr>
                <th><a href="?column=id&sort=<?php echo $sort ?>">ID</a></th>
                <th>IMAGE</th>
                <th><a href="?column=productname&sort=<?php echo $sort ?>">PRODUCT NAME</a></th>
                <th><a href="?column=size&sort=<?php echo $sort ?>">SIZE</a></th>
                <th>PRICE</th>
                <th>DESCRIPTION</th>
                <th>ACTIONS</th>
            </tr>
            <?php while($results = mysqli_fetch_array($sqlProducts)) { ?>
            <tr>
                <td><?php echo $results['id']?></td>
                <td><img src="../uploads/<?php echo $results['image']; ?>"alt='no Image' style="width: 150px;"></td>
                <td><?php echo $results['productname']?></td>
                <td><?php echo $results['size']?></td>
                <td><?php echo $results['price']?></td>
                <td><?php echo $results['description']?></td>
                <td>
                    <form action="/final/admin/update.php" method="post">
                        <input type="submit" name="edit" value="EDIT">
                        <input type="hidden" name="editId" value="<?php echo $results['id'] ?>">
                        <input type="hidden" name="editProductname" value="<?php echo $results['productname'] ?>">
                        <input type="hidden" name="editSize" value="<?php echo $results['size'] ?>">
                        <input type="hidden" name="editPrice" value="<?php echo $results['price'] ?>">
                        <input type="hidden" name="editDescription" value="<?php echo $results['description']?>">
                    </form>
                    <form action="/final/admin/delete_products.php" method="post">
                        <input type="submit" name="delete" value="DELETE">
                        <input type="hidden" name="deleteId" value="<?php echo $results['id'] ?>">
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    </section>
</body>
</html>