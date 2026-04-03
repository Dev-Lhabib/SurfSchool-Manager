<?php
require_once __DIR__ . '/../../database/db.php';
session_start();
try {
    $db = new Database();
    $pdo = $db->connect();

    // Stats queries
    $stats = [];

    $stmt = $pdo->query("SELECT COUNT(*) as total FROM users");
    $stats['users'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    $stmt = $pdo->query("SELECT COUNT(*) as total FROM students");
    $stats['students'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

} catch (Exception $e) {
    error_log("Dashboard error: " . $e->getMessage());
    $stats = ['users' => 0, 'students' => 0];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - SurfSchool</title>
</head>
<body>

<h2>Admin Dashboard</h2>
<p>Welcome <?= htmlspecialchars($_SESSION['user_nom']) ?> (Admin)</p>

<nav>
  <a href="../controllers/StudentController.php?action=index">Students</a>
</nav>

<hr>

<h3>Statistics:</h3>

<table border="1" cellpadding="12" cellspacing="0">
    <tr>
        <td><strong>Users</strong><br><?= $stats['users'] ?></td>
        <td><strong>Students</strong><br><?= $stats['students'] ?></td>
    </tr>
    <tr>
    </tr>
</table>

<hr>

<h3>Quick Actions:</h3>
<ul>
    <li><a href="../views/add_student.php">+ Add Student</a></li>

</body>
</html>