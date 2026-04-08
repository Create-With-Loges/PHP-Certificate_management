<?php
session_start();
// Do not auto-redirect, let user choose
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Tech Event Certificate Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-page" style="flex-direction: column; height: auto; min-height: 100vh; padding: 20px;">

<div class="container" style="text-align: center; margin-bottom: 30px; background: transparent; border: none; box-shadow: none;">
    <h1 style="color: #2c3e50; font-size: 2.5rem; margin-bottom: 10px;">Certificate Management System</h1>
    <p style="font-size: 1.2rem; color: #555; max-width: 600px; margin: 0 auto;">
        A centralized platform for managing and distributing tech event certificates. 
        Admins can generate and issue certificates, while participants can easily view and download their awards.
    </p>
</div>

<div class="login-container">
    <?php if (isset($_SESSION['user_id'])): ?>
        <div style="text-align: center;">
            <h2>Welcome Back, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h2>
            <p>You are already logged in.</p>
            <div style="margin-top: 20px;">
                <?php if ($_SESSION['role'] == 'admin'): ?>
                    <a href="admin/dashboard.php" class="button" style="width: 100%; display: block; box-sizing: border-box;">Go to Admin Dashboard</a>
                <?php else: ?>
                    <a href="user/dashboard.php" class="button" style="width: 100%; display: block; box-sizing: border-box;">Go to My Profile</a>
                <?php endif; ?>
                <br>
                <a href="logout.php" class="button" style="background-color: #e74c3c; width: 100%; display: block; box-sizing: border-box;">Logout</a>
            </div>
        </div>
    <?php else: ?>
        <h2>Login</h2>
        <?php if (isset($_GET['error'])): ?>
            <div class="error"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>
        <form action="login_action.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" style="width: 100%;">Login</button>
        </form>
    <?php endif; ?>
</div>

</body>
</html>
