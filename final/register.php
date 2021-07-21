<?php require 'functions.php';
include 'header.php';?>
<style>
            .errors {
            padding: 10px;
/*            font-weight: bolder;
            background-color: red;*/
            color: red;
            width: 50%;
        }
</style>
    <!--SIGNUP-->
    <section id="signup">
        <div class="container">
            <div class="row">
                <div class="acc-col reg">
                        <h>Register</h>
                        <p>Welcome to Le feu aroma!<br>Get started with your new account.</p>
                    </div>
                <div class="acc-col">
                    <div class="signup">
                        <h>New Customer</h>
                        <p>Create your account by filling the form below</p>
                    <form method="post" action="register.php">
                        <?php if(!empty($errors)):?>
                         <div class="errors">
                            <?php echo display_error(); ?>
                        </div><br>
                         <?php endif?>
                        <input type="text" name="fname" value="<?php echo $fname; ?>" placeholder="First Name">
                        <input type="text" name="lname" value="<?php echo $lname; ?>" placeholder="Last Name"><br>
                        <input type="email" name="email" value="<?php echo $email; ?>" placeholder="Email">
                        <input type="number" name="pnumber" value="<?php echo $pnumber; ?>" placeholder="Phone Number">
                        <input type="password" name="password_1" placeholder="Password"><br>
                        <input type="password" name="password_2" placeholder="Confirm Password"><br><br>
                        <p>Enter your home address</p>
                        <input type="text" name="house_number" value="<?php echo $house_number; ?>" placeholder="House No.">
                        <input type="text" name="street" value="<?php echo $street; ?>" placeholder="Street"><br>
                        <input type="text" name="brgy" value="<?php echo $brgy; ?>" placeholder="Barangay">
                        <input type="text" name="city" value="<?php echo $city; ?>" placeholder="City">
                        <input type="text" name="province" value="<?php echo $province; ?>" placeholder="Province"><br>
                        <button type="submit" class="btn" name="register_btn">Register</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Footer-->
<?php include 'footer.php';?>