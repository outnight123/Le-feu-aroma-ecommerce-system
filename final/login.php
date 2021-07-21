<?php require 'functions.php';
include 'header.php'; ?>
<style>
            .errors {
            padding: 10px;
/*            font-weight: bolder;
            background-color: red;*/
            color: red;
            width: 50%;
        }
        
</style>
    <!--ACCOUNT-->
    <section id="account">
        <div class="container">
            <div class="row">
                <div class="acc-col">
                        <h>My Account</h>
                        <p>Welcome to Le feu aroma!</p>
                    </div>
                <div class="acc-col">
                    <div class="login">
                        <h>Returning Customer</h>
                        <p>Log in to your account below</p>
                                                <?php if(!empty($errors)):?>
                         <div class="errors">
                            <?php echo display_error(); ?>
                        </div><br>
                         <?php endif?>
                        <form method="post" action="login.php">
                        <input type="text" name="email" placeholder="Email">
                        <input type="password" name="password" placeholder="Password"/><br>
                        <button type="submit" class="btn" name="login_btn">SIGN IN</button>
                        </form>
                    </div>
                </div>
                <div class="acc-col">
                    <div class="signup">
                        <h>New to Le feu aroma?</h>
                        <p>Create an account to enjoy the benefits.</p>
                        <button><a href="register.php">REGISTER</a></button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Footer-->
<?php include 'footer.php';?>