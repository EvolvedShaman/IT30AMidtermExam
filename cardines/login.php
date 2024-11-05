<?php
session_start();
if(isset($_SESSION['user_id'])) {
    header("Location: cardines/dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <form class="login-form" id="loginForm" method="POST" action="cardines/process_login.php">
            <h2>Login</h2>
            <?php if(isset($_SESSION['error'])): ?>
                <div class="error-message"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
            <?php endif; ?>
            <div class="form-group">
                <input type="email" name="email" placeholder="Email" required id="email">
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required id="password">
            </div>
            <button type="submit">Login</button>
            <div class="links">
                <a href="cardines/forgot_password.php" class="forgot-password">Forgot Password?</a>
                <a href="cardines/register.php" class="register">Register</a>
            </div>
        </form>
    </div>
</body>
</html> 