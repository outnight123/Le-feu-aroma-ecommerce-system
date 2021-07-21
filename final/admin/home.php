<?php require('../functions.php');

if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	echo '<script>window.location.href = "/final/login.php"</script>';
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	echo '<script>window.location.href = "/final/login.php"</script>';
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="admin_style.css">
	<link rel="stylesheet" href="style.css">

</head>
<body>
	<div class="header">
		<h2>Admin - Home Page</h2>
	</div>
	<div class="content">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php
						echo $_SESSION['success'];
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>

		<!-- logged in user information -->
		<div class="profile_info">
			<img src="../uploads/user-solid.svg"  >

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['fname']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i>
						<br>
						<a href="home.php?logout='1'" style="color: red;">logout</a>
					   &nbsp; <a href="users.php">users</a>
					   &nbsp; <a href="products.php">products</a>
					   &nbsp; <a href="orders.php">orders</a>
					</small>

				<?php endif ?>
			</div>
		</div>
	</div>
</body>
</html>