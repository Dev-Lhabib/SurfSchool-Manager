<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - SurfSchool</title>
</head>
<body>

<h2>Login</h2>

<?php if (isset($_GET['error'])): ?>
    <p style="color: red;">
        <?php
        if ($_GET['error'] == 'invalid') echo "Invalid email or password!";
        if ($_GET['error'] == 'empty') echo "Please fill in all fields!";
        if ($_GET['error'] == 'failed') echo "Something went wrong, please try again!";
        ?>
    </p>
<?php endif; ?>

<?php if (isset($_GET['success']) && $_GET['success'] == 'registered'): ?>
    <p style="color: green;">Registration successful! You can now login.</p>
<?php endif; ?>

<?php if (isset($_GET['success']) && $_GET['success'] == 'logout'): ?>
    <p style="color: green;">You have been logged out successfully!</p>
<?php endif; ?>

<form method="POST" action="../../app/controllers/AuthController.php?action=login">
    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

<p>Don't have an account? <a href="register.php">Register here</a></p>

</body>
</html>