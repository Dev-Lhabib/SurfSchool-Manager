<!DOCTYPE html>
<html>
<head>
    <title>Edit Student - SurfSchool</title>
</head>
<body>

<h2>Edit Student</h2>

<?php if (isset($_GET['error'])): ?>
    <p style="color: red;">
        <?php
        if ($_GET['error'] == 'empty') echo "Please fill in the name!";
        if ($_GET['error'] == 'failed') echo "Something went wrong!";
        ?>
    </p>
<?php endif; ?>

<form method="POST" action="../controllers/StudentController.php?action=update">
    <input type="hidden" name="id" value="<?= $student['id'] ?>">

    <label>Name:</label><br>
    <input type="text" name="nom" value="<?= htmlspecialchars($student['nom']) ?>" required><br><br>

    <label>Country:</label><br>
    <input type="text" name="pays" value="<?= htmlspecialchars($student['pays'] ?? '') ?>"><br><br>

    <label>Level:</label><br>
    <select name="niveau">
        <option value="debutant" <?= $student['niveau'] == 'debutant' ? 'selected' : '' ?>>Beginner</option>
        <option value="intermediaire" <?= $student['niveau'] == 'intermediaire' ? 'selected' : '' ?>>Intermediate</option>
        <option value="avance" <?= $student['niveau'] == 'avance' ? 'selected' : '' ?>>Advanced</option>
    </select><br><br>

    <button type="submit">Save Changes</button>
</form>

<br>
<a href="../controllers/StudentController.php?action=index">← Back to list</a>

</body>
</html>