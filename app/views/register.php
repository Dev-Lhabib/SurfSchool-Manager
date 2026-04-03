<?php ?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Register</h2>

<?php if (isset($_GET['error'])): ?>
    <p style="color: red;">
        <?php
        if ($_GET['error'] == 'empty') echo "Please fill in all fields!";
        if ($_GET['error'] == 'email_exists') echo "This email is already registered!";
        if ($_GET['error'] == 'failed') echo "Something went wrong, please try again!";
        ?>
    </p>
<?php endif; ?>

<form method="POST" action="../../app/controllers/AuthController.php?action=register">

    <label>Nom:</label><br>
    <input type="text" name="nom" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Register</button>

</form>

<p>Already have an account? <a href="login.php">Login here</a></p>


</body>
</html>