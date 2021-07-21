<?php
    require('../functions.php');

    if (isset ($_POST['delete'])) {
        $deleteId = $_POST['deleteId'];

        $queryDelete = "DELETE FROM orders WHERE transaction_id = '$deleteId'";
        $sqlDelete = mysqli_query($db, $queryDelete);

        echo '<script>alert("Successfully deleted!")</script>';
        echo '<script>window.location.href = "/final/admin/orders.php"</script>';
    }else {
        echo '<script>window.location.href = "/final/admin/orders.php"</script>';
    }

?>