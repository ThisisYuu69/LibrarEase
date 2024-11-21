<?php
    include "header.php";
?>
<body>
    <div class="container">
        <img src="resources/trademark.png" class="logo">
        <div class=error>
            <span class="error"> <?php echo $EmailErr; ?>
            <br>
            <span class="error"> <?php echo $PasswordErr; ?></span>
        </span></div>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="text" name="Email" placeholder="Email" value="<?php echo $Email; ?>">
            <div class="password_container">
            <input type="password" name="Password" placeholder="Password" id="password">
            <img src="resources/passhide.jpg" onclick="pass()" class="pass-icon" id="pass-icon">
            </div>
            <div class="remember-forget">
                <label for="rememberme" class="checkbox"><input type="checkbox" id="rememberme"><small>Remember me</small></label>
                &nbsp; &nbsp; &nbsp; &nbsp;
                <a href="bobo.php"><small>Forgot password?</small></a>
            </div>
            <br>
            <input type="submit" value="Log in">
            <div class="create-account">
                <small>Don't have an account yet?&nbsp;<a href="registration.php">Create one.</a></small>
            </div>
        </form>
    </div>
</body>

</html>