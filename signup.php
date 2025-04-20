<?php include('template/head.php') ?>
<?php include('template/header.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="public/style.css">
</head>
<body>
    <div class="form-container">
        <form action="controller/Auth.php" method="POST">
            <h2>Sign Up</h2>
            <div class="input-group">
                <label for="username">Email Address</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <label for="firstname">First Name</label>
                <input type="text" id="firstname" name="firstname" required>
            </div>
            <div class="input-group">
                <label for="lastname">Last Name</label>
                <input type="text" id="lastname" name="lastname" required>
            </div>
            <button type="submit" name="Register">Sign Up</button>
            <p>Đã có tài khoản? <a href="signin.php">Sign In</a></p>
        </form>
    </div>
    <?php include('template/footer.php') ?>
</body>
</html>
