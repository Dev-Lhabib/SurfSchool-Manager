<!DOCTYPE html>
<html>
<head>
    <title>Add Student - SurfSchool</title>
</head>
<body>

<h2>Add New Student</h2>

<?php if (isset($_GET['error'])): ?>
    <p style="color: red;">
        <?php
        if ($_GET['error'] == 'empty') echo "Please fill in the name!";
        if ($_GET['error'] == 'failed') echo "Something went wrong, please try again!";
        if ($_GET['error'] == 'nostudent') echo "Please create your student profile first!";
        ?>
    </p>
<?php endif; ?>

<form method="POST" action="../controllers/StudentController.php?action=store">
    <label>Name:</label><br>
    <input type="text" name="nom" required><br><br>

    <label>Country:</label><br>
    <input type="text" name="pays"><br><br>

    <label>Level:</label><br>
    <select name="niveau">
        <option value="debutant">Beginner</option>
        <option value="intermediaire">Intermediate</option>
        <option value="avance">Advanced</option>
    </select><br><br>

    <button type="submit">Add Student</button>
</form>

<br>
<a href="../views/students.php?action=index">← Back to list</a>

</body>
</html>