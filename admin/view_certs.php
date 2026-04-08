<?php
session_start();
require_once '../db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

$filter_category = isset($_GET['category']) ? sanitize($conn, $_GET['category']) : '';

$sql = "SELECT c.*, u.name, u.roll_number, u.class, u.department 
        FROM certificates c 
        JOIN users u ON c.user_id = u.id";

if ($filter_category) {
    $sql .= " WHERE c.category = '$filter_category'";
}

$sql .= " ORDER BY c.issue_date DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Certificates - Admin</title>
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
    <h2>All Certificates</h2>
    
    <div style="margin-bottom: 20px;">
        <strong>Filter by Category: </strong>
        <a href="view_certs.php">All</a> | 
        <a href="view_certs.php?category=Winner">Winner</a> | 
        <a href="view_certs.php?category=Runner">Runner</a> | 
        <a href="view_certs.php?category=Participant">Participant</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Event</th>
                <th>Category</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td>
                        <?php echo htmlspecialchars($row['name']); ?><br>
                        <small><?php echo htmlspecialchars($row['roll_number']); ?></small>
                    </td>
                    <td><?php echo htmlspecialchars($row['event_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['category']); ?></td>
                    <td><?php echo htmlspecialchars($row['issue_date']); ?></td>
                    <td>
                    <a href="view_cert.php?id=<?php echo $row['id']; ?>" target="_blank">View</a>                        <!-- Add edit/delete if needed -->
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="6">No certificates found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <div style="margin-top: 20px;">
        <a href="dashboard.php" class="button" style="background-color: #95a5a6;">Back to Dashboard</a>
    </div>
</div>

</body>
</html>
