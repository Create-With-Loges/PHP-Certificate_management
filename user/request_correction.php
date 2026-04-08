<?php
session_start();
require_once '../db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'user') {
    header("Location: ../index.php");
    exit();
}

$msg = "";
$cert_id = isset($_GET['cert_id']) ? intval($_GET['cert_id']) : 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cert_id = intval($_POST['cert_id']);
    $message = sanitize($conn, $_POST['message']);
    $user_id = $_SESSION['user_id'];

    if (empty($message)) {
        $msg = "<div class='error'>Please describe the issue.</div>";
    } else {
        $sql = "INSERT INTO correction_requests (certificate_id, user_id, message) VALUES ($cert_id, $user_id, '$message')";
        if ($conn->query($sql) === TRUE) {
            $msg = "<div class='success'>Request sent successfully!</div>";
        } else {
            $msg = "<div class='error'>Error: " . $conn->error . "</div>";
        }
    }
}

// Get cert details for display
$cert_sql = "SELECT event_name FROM certificates WHERE id = $cert_id AND user_id = " . $_SESSION['user_id'];
$cert_result = $conn->query($cert_sql);
$cert_name = ($cert_result->num_rows > 0) ? $cert_result->fetch_assoc()['event_name'] : "Unknown Certificate";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Correction</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="navbar user">
    <div class="logo">User Dashboard</div>
    <div class="menu">
        <a href="dashboard.php">Dashboard</a>
        <a href="../logout.php" class="button logout-btn">Logout</a>
    </div>
</div>

<div class="container">
    <h2>Request Correction</h2>
    <p>Certificate: <strong><?php echo htmlspecialchars($cert_name); ?></strong></p>
    <?php echo $msg; ?>
    <form method="POST" action="">
        <input type="hidden" name="cert_id" value="<?php echo $cert_id; ?>">
        <div class="form-group">
            <label>Describe the mistake</label>
            <textarea name="message" rows="5" required></textarea>
        </div>
        <button type="submit">Submit Request</button>
        <a href="dashboard.php" class="button" style="background-color: #95a5a6; margin-left: 10px;">Back</a>
    </form>
</div>

</body>
</html>
