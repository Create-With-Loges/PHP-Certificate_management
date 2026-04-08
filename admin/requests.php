<?php
session_start();
require_once '../db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

if (isset($_POST['update_status'])) {
    $req_id = intval($_POST['req_id']);
    $status = sanitize($conn, $_POST['status']);
    $conn->query("UPDATE correction_requests SET status='$status' WHERE id=$req_id");
    header("Location: requests.php");
    exit();
}

$sql = "SELECT r.*, c.event_name, u.name, u.roll_number 
        FROM correction_requests r 
        JOIN certificates c ON r.certificate_id = c.id 
        JOIN users u ON r.user_id = u.id 
        ORDER BY r.created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Correction Requests - Admin</title>
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
    <h2>Correction Requests</h2>
    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Event</th>
                <th>Message</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['event_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['message']); ?></td>
                    <td>
                        <?php 
                        $color = 'black';
                        if($row['status']=='pending') $color='orange';
                        if($row['status']=='approved') $color='green';
                        if($row['status']=='rejected') $color='red';
                        ?>
                        <span style="color: <?php echo $color; ?>; font-weight:bold;"><?php echo ucfirst($row['status']); ?></span>
                    </td>
                    <td>
                        <?php if($row['status'] == 'pending'): ?>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="req_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="update_status" value="approved" style="background:green; padding:5px 10px; font-size:12px;">Approve</button>
                            <button type="submit" name="update_status" value="rejected" style="background:red; padding:5px 10px; font-size:12px;">Reject</button>
                        </form>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                        <br>
                        <a href="../view_cert.php?id=<?php echo $row['certificate_id']; ?>" target="_blank" style="font-size:12px;">View Cert</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="5">No requests found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <div style="margin-top: 20px;">
        <a href="dashboard.php" class="button" style="background-color: #95a5a6;">Back to Dashboard</a>
    </div>
</div>

</body>
</html>
