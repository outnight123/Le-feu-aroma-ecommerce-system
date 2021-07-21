<?php
    require('./read_users.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" type="text/css" href="admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
    <li><a href="home.php" class="fa fa-angle-left"> Back to Home</a> </li>

    <div class="main">
            <table class="read-main">
            <tr>
                <th><a href="?column=id&sort=<?php echo $sort ?>">ID</a></th>
                <th><a href="?column=fname&sort=<?php echo $sort ?>">First Name</a></th>
                <th><a href="?column=lname&sort=<?php echo $sort ?>">Last Name</a></th>
                <th>Email</th>
                <th>ADDRESS</th>
                <th>ACTIONS</th>
            </tr>
            <?php while($results = mysqli_fetch_array($sqlUsers)) { ?>
            <tr>
                <td><?php echo $results['id']?></td>
                <td><?php echo $results['fname']?></td>
                <td><?php echo $results['lname']?></td>
                <td><?php echo $results['email']?></td>
                <td><?php echo $results['house_number']. ' ' .
                $results['street']. ' '.
                $results['brgy']. ' '.
                $results['city']. ', '.
                $results['province'] ?></td>
                <td>
                    <form action="/final/admin/delete_users.php" method="post">
                        <input type="submit" name="delete" value="DELETE">
                        <input type="hidden" name="deleteId" value="<?php echo $results['id'] ?>">
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
    </div>
</body>
</html>