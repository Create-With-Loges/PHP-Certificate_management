<?php
session_start();
require_once '../db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM users WHERE id=$id AND role!='admin'");
    header("Location: manage_users.php");
    exit();
}

$sql = "SELECT * FROM users WHERE role='user' ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - Admin</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="navbar admin">
    <div class="logo">Admin Dashboard</div>
    <div class="menu">
        <a href="dashboard.php">Dashboard</a>
        <a href="../logout.php" class="button logout-btn">Logout</a>
    </div>
</div>

<div class="container">
    <h2>Manage Users</h2>
    <a href="add_user.php" class="button">Add New User</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Roll No</th>
                <th>Dept</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['roll_number']); ?></td>
                <td><?php echo htmlspecialchars($row['department']); ?></td>
                <td>
                    <a href="manage_users.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure? This will delete all certificates for this user.');" style="color: red;">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <div style="margin-top: 20px;">
        <a href="dashboard.php" class="button" style="background-color: #95a5a6;">Back to Dashboard</a>
    </div>
</div>

</body>
</html>
