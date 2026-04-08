<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="navbar admin">
    <div class="logo">Admin Dashboard</div>
    <div class="menu">
        <span>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?></span>
        <a href="../logout.php" class="button logout-btn">Logout</a>
    </div>
</div>

<div class="container">
    <h2>User Management</h2>
    <div class="dashboard-grid">
        <div class="card">
            <h3>Manage Users</h3>
            <p>Add or remove users.</p>
            <div class="actions">
                <a href="add_user.php" class="button">Add New User</a>
                <div style="margin-top: 10px;"></div>
                <a href="manage_users.php" class="button" style="background-color: #95a5a6;">View/Delete Users</a>
            </div>
        </div>
    </div>

    <h2 style="margin-top: 50px;">Certificate Management</h2>
    <div class="dashboard-grid">
        <div class="card">
            <h3>Generate Certificate</h3>
            <p>Create and assign certificates.</p>
            <div class="actions">
                <a href="generate_cert.php" class="button">Create Certificate</a>
            </div>
        </div>
        <div class="card">
            <h3>View Certificates</h3>
            <p>List all issued certificates.</p>
            <div class="actions">
                <a href="view_certs.php" class="button">View All</a>
            </div>
        </div>
        <div class="card">
            <h3>Correction Requests</h3>
            <p>Review user requests.</p>
            <div class="actions">
                <a href="requests.php" class="button">View Requests</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
