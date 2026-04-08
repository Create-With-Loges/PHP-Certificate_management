<?php
session_start();
require_once '../db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'user') {
    header("Location: ../index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM certificates WHERE user_id = $user_id ORDER BY issue_date DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="navbar user">
    <div class="logo">User Dashboard</div>
    <div class="menu">
        <span>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?></span>
        <a href="../logout.php" class="button logout-btn">Logout</a>
    </div>
</div>

<div class="container">
    <h2>My Certificates</h2>
    <div class="dashboard-grid">
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
            <div class="card">
                <h3><?php echo htmlspecialchars($row['event_name']); ?></h3>
                <p><strong>Category:</strong> <?php echo htmlspecialchars($row['category']); ?></p>
                <p><strong>Date:</strong> <?php echo htmlspecialchars($row['issue_date']); ?></p>
                <div class="actions">
                    <a href="../view_cert.php?id=<?php echo $row['id']; ?>" target="_blank" class="button">View / Download</a>
                    <div style="margin-top: 10px;"></div>
                    <a href="request_correction.php?cert_id=<?php echo $row['id']; ?>" class="button" style="background-color: orange; font-size: 14px;">Request Correction</a>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No certificates found.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
