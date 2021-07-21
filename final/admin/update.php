<?php
    require('../functions.php');

    if (isset ($_POST['edit'])) {
        $editId = $_POST['editId'];
        $editProductname = $_POST['editProductname'];
        $editSize = $_POST['editSize'];
        $editPrice = $_POST['editPrice'];
        $editDescription = $_POST['editDescription'];
    }

    if (isset($_POST['update'])) {
        $updateId = $_POST['updateId'];
        $updateProductname = $_POST['updateProductname'];
        $updateSize = $_POST['updateSize'];
        $updatePrice = $_POST['updatePrice'];
        $updateDescription = $_POST['updateDescription'];

        $queryUpdate = "UPDATE products SET productname = '$updateProductname', size = '$updateSize', price = '$updatePrice', description = '$updateDescription' WHERE id = '$updateId'";
        $sqlUpdate = mysqli_query($db, $queryUpdate);

        echo '<script>alert("Successfully updated!")</script>';
        echo '<script>window.location.href = "/final/admin/products.php"</script>';
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <li><a href="products.php" class="fa fa-angle-left"> Back to Products</a> </li>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPDATE PRODUCT</title>
    <link rel="stylesheet" type="text/css" href="admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
    
<body>

    <div class="main">
        <form action="/final/admin/update.php" class="update-main" method="post">
            <h3>UPDATE PRODUCT</h3>
            <input type="text" name="updateProductname" placeholder="Enter final Product" value="<?php echo $editProductname ?>" required/>
            <input type="text" name="updateSize" placeholder="Enter final Size" value="<?php echo $editSize ?>" required/>
            <input type="text" name="updatePrice" placeholder="Enter final Price" value="<?php echo $editPrice ?>" required/>
            <input type="text" name="updateDescription" placeholder="Description" value="<?php echo $editDescription ?>">
            <input type="submit" name="update" value="UPDATE" />
            <input type="hidden" name="updateId" value="<?php echo $editId ?>" />
        </form>


    </div>

</body>
</html>