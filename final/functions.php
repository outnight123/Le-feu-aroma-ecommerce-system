<?php
session_start();

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'lefeu_aroma');

// variable declaration
$fname = "";
$lname = "";
$email = "";
$house_number = "";
$street = "";
$brgy = "";
$city = "";
$province = "";
$errors = array();

// if register_btn is clicked
if (isset($_POST['register_btn'])) {
	register();
}

// REGISTER USER
function register(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $fname, $lname, $email;

	// receive all input values from the form.
    // defined below to escape form values
	$fname = ($_POST['fname']);
	$lname = ($_POST['lname']);
	$email =  ($_POST['email']);
	$pnumber = ($_POST['pnumber']);
	$house_number =  ($_POST['house_number']);
	$street =  ($_POST['street']);
	$brgy =  ($_POST['brgy']);
	$city =  ($_POST['city']);
	$province =  ($_POST['province']);
	$password_1  =  ($_POST['password_1']);
	$password_2  =  ($_POST['password_2']);

	// form validation: ensure that the form is correctly filled
	if (empty($fname)) {
		array_push($errors, "*First name is required");
	}
	if (empty($lname)) {
		array_push($errors, "*Last name is required");
	}
	if (empty($email)) {
		array_push($errors, "*Email is required");
	}
	if (empty($pnumber)) {
		array_push($errors, "*Phone number is required");
	}
	if (empty($house_number)) {
		array_push($errors, "*House number is required");
	}
	if (empty($street)) {
		array_push($errors, "*Street is required");
	}
	if (empty($brgy)) {
		array_push($errors, "*Barangay is required");
	}
	if (empty($city)) {
		array_push($errors, "*City is required");
	}
	if (empty($province)) {
		array_push($errors, "*Province is required");
	}
	if (empty($password_1)) {
		array_push($errors, "*Password is required");
	}
	if ($password_1 != $password_2) {
		array_push($errors, "*The two passwords do not match");
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($password_1);//encrypt the password before saving in the database
		$query = "SELECT email FROM users WHERE email = '$email'";
		$run_query = mysqli_query($db,$query);
		if (mysqli_num_rows($run_query) > 0) {
			array_push($errors, "*Email already exist");
		}else {
		if (isset($_POST['user_type'])) {
			$user_type = e($_POST['user_type']);
			$query = "INSERT INTO users (fname, lname, email, pnumber, house_number, street, brgy, city, province, user_type, password)
					  VALUES('$fname', '$lname', '$email', '$pnumber', '$house_number', '$street', '$brgy', '$city', '$province',  '$user_type', '$password')";
			mysqli_query($db, $query);
			$_SESSION['success']  = "New user successfully created!!";
			echo '<script>window.location.href = "/final/admin/home.php"</script>';
		}else{
			$query = "INSERT INTO users (fname, lname, email, pnumber, house_number, street, brgy, city, province, user_type, password)
					  VALUES('$fname', '$lname', '$email', '$pnumber', '$house_number', '$street', '$brgy', '$city', '$province', 'user', '$password')";
			mysqli_query($db, $query);

			$logged_in_user_id = mysqli_insert_id($db);


			$_SESSION['user_id'] = $logged_in_user_id; // put logged in user in session
			$_SESSION['success']  = "You are now logged in";
			echo '<script>window.location.href = "/final/home.php"</script>';
		}
	}
	}
}

// escape string
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}

// log user out if logout button clicked
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	echo '<script>window.location.href = "/final/login.php"</script>';
}

// call the login() function if register_btn is clicked
if (isset($_POST['login_btn'])) {
	login();
}

// LOGIN USER
function login(){
	global $db, $email, $errors;

	// grap form values
	$email = e($_POST['email']);
	$password = e($_POST['password']);

	// make sure form is filled properly
	if (empty($email)) {
		array_push($errors, "*Email is required");
	}
	if (empty($password)) {
		array_push($errors, "*Password is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) { // user found
			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);
			if ($logged_in_user['user_type'] == 'admin') {
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";
				echo '<script>window.location.href = "/final/admin/home.php"</script>';
			}else{
				$_SESSION['user_id'] = $logged_in_user['id'];
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";

				echo '<script>window.location.href = "/final/home.php"</script>';
			}
		}else {
			array_push($errors, "*Wrong email and password combination");
		}
	}
}

// ...
function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
		return true;
	}else{
		return false;
	}
}
