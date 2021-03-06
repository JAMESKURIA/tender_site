<!-- <?php
if (!isset($_SESSION)) {
    session_start();

    if ($_SESSION['user_name']) {
        $user = $_SESSION['user_name'];
        $email = $_SESSION['email'];
        $id = $_SESSION['bidder_id'];
    } else if ($_SESSION['admin_name']) {
        $user = $_SESSION['admin_name'];
        $email = $_SESSION['email'];
        $id = $_SESSION['admin_id'];
    }
}



include './assets/register.php';
include './assets/login_handler.php';
?> -->

<!-- Header -->
<?php
include './includes/header.php';
?>

<!-- Main section -->
<main>
    <section class="intro-section">
        <div class="intro-section-content">
            <h2>It's never too late to start</h2>
            <div class="navigation">
                <h3><a href="./index.php">Home</a></h3>
                <i class="fas fa-chevron-right"></i>
                <h3>Login / Register</h3>
            </div>
        </div>
    </section>

    <section class="container">
        <div class="container-content">

            <!-- two buttons -->
            <div class="two-buttons">
                <button>Login</button>
                <button>Register</button>
            </div>

            <!-- Login section -->
            <div class="login-section">

                <form method="POST" enctype="multipart/form-data" class="login-now">
                    <h3>Login Now</h3>

                    <input type="email" name="login_email" placeholder="user@gmail.com">
                    <input type="password" name="login_password" placeholder="●●●●●●●●●●">
                    <div class="send-button-div">
                        <input type="submit" name="login" value="Log In">
                        <h5><a href="#">Forgot Password?</a></h5>
                    </div>
                </form>

                <div class="login-social">
                    <h3>Login via Social</h3>

                    <div class="facebook">
                        <i class="fab fa-facebook-f"></i>
                        <h4>Login With Facebook</h4>
                        <i class="fas fa-chevron-right"></i>
                    </div>
                    <div class="twitter">
                        <i class="fab fa-twitter"></i>
                        <h4>Login With Twitter</h4>
                        <i class="fas fa-chevron-right"></i>
                    </div>
                    <div class="google">
                        <i class="fab fa-google"></i>
                        <h4>Login With Google</h4>
                        <i class="fas fa-chevron-right"></i>
                    </div>

                </div>
            </div>

            <!-- Register section -->
            <div class="register-section">

                <form method="POST" class="register-now">
                    <h3>Register Now</h3>

                    <input type="text" name="f_name" placeholder="first name e.g John" required>
                    <input type="text" name="l_name" placeholder="last name e.g. Doe" required>
                    <input type="tel" name="phone_number" placeholder="phone number e.g. 0700123456" required>
                    <input type="text" name="address" placeholder="address e.g. Limuru" required>
                    <input type="password" name="register_password" placeholder="password" required>
                    <input type="email" name="register_email" placeholder="Email e.g. johndoe@gmail.com" required>
                    <div class="send-button-div">
                        <input type="submit" name="reg" value="Sign Up">
                        <h5 id="existing-account">Already have an account?</h5>
                    </div>
                </form>

                <div class="login-social">
                    <h3>Register via Social</h3>
                    <div class="facebook">
                        <i class="fab fa-facebook-f"></i>
                        <h4>Sign Up with Facebook</h4>
                        <i class="fas fa-chevron-right"></i>
                    </div>
                    <div class="twitter">
                        <i class="fab fa-twitter"></i>
                        <h4>Sign Up with Twitter</h4>
                        <i class="fas fa-chevron-right"></i>
                    </div>
                    <div class="google">
                        <i class="fab fa-google"></i>
                        <h4>Sign Up with Google</h4>
                        <i class="fas fa-chevron-right"></i>
                    </div>

                </div>
            </div>
        </div>
    </section>


</main>

<script src="./scripts/toggle_login.js"></script>
</body>

</html>