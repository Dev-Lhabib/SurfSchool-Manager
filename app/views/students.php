<!DOCTYPE html>
<html>
<head>
    <title>Students - SurfSchool</title>
</head>
<body>

<h2>Students List</h2>

<?php if (isset($_GET['success'])): ?>
    <p style="color: green;">
        <?php
        if ($_GET['success'] == 'added') echo "Student added successfully!";
        if ($_GET['success'] == 'updated') echo "Student updated successfully!";
        if ($_GET['success'] == 'deleted') echo "Student deleted successfully!";
        ?>
    </p>
<?php endif; ?>

<?php if (isset($_GET['error'])): ?>
    <p style="color: red;">
        <?php
        if ($_GET['error'] == 'notfound') echo "Student not found!";
        if ($_GET['error'] == 'failed') echo "Something went wrong!";
        ?>
    </p>
<?php endif; ?>

<a href="../views/add_student.php">+ Add New Student</a>

<br><br>

<?php if (empty($students)): ?>
    <p>No students found.</p>
<?php else: ?>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Country</th>
                <th>Level</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $s): ?>
            <tr>
                <td><?= $s['id'] ?></td>
                <td><?= htmlspecialchars($s['nom']) ?></td>
                <td><?= htmlspecialchars($s['pays'] ?? '-') ?></td>
                <td><?= $s['niveau'] ?></td>
                <td><?= $s['cree_le'] ?? '-' ?></td>
                <td>
                    <a href="../controllers/StudentController.php?action=edit&id=<?= $s['id'] ?>">Edit</a>
                    |
                    <a href="../controllers/StudentController.php?action=destroy&id=<?= $s['id'] ?>"
                       onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

</body>
</html>