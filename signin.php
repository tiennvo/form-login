<?php
require_once 'public/config.php';
?>
<?php include('template/head.php') ?>
<?php include('template/header.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="public/style.css">
</head>
<body>
    <div class="form-container">
        <form action="controller/Auth.php" method="POST">
            <h2>Sign In</h2>
            <div class="input-group">
                <label for="username">Email Address</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="login">Sign In</button>
            <p>Chưa có tài khoản? <a href="signup.php">Sign Up</a></p>
        </form>
    </div>
    <br><br><br><br>
</body>
</html>

<?php include('template/footer.php') ?>
