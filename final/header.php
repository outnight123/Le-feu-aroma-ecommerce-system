<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Le feu aroma</title>
    <link rel="shortcut icon" type="image" href="lefeu_icon.png"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://kit.fontawesome.com/yourcode.js"></script>
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

</head>

<body>
    <!--Nav bar-->
    <header>
    <section id="Nav-bar">
        <label for="toggle">&#9776;</label>
        <input type="checkbox" id="toggle"/>
        <div id="main_menu">
            <div class="logo_area">
                <a href="home.php" ><img src="lefeu_logo.png"></a>
            </div>
            <div class="inner_main_menu">
                <ul>
                    <li><a href="home.php">HOME</a></li>
                    <li><a href="shop.php">SHOP</a></li>
                    <li><a href="about.php">ABOUT</a></li>
                    <?php  if (isset($_SESSION['user_id'])) { ?>
                    <li><a href="logout.php">LOGOUT</a></li>
                    <li><a href="orders.php">ORDERS</a></li>
                    <li><a href="user-cart.php" class="fa fa-shopping-cart"></a></li>
                    <?php } ?>
                    <?php  if (!isset($_SESSION['user_id'])) { ?>
                    <li><a href="login.php">LOGIN</a></li>
                    <li><a href="cart.php" class="fa fa-shopping-cart"></a></li>
                    <?php } ?>             
                </ul>
            </div>
        </div>
    </section>
    </header>