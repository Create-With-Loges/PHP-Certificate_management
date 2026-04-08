<?php
session_start();
require_once '../db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

$msg = "";

// Fetch users for dropdown
$users_result = $conn->query("SELECT id, name, roll_number FROM users WHERE role='user' ORDER BY name");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = intval($_POST['user_id']);
    $event_name = sanitize($conn, $_POST['event_name']);
    $event_description = sanitize($conn, $_POST['event_description']);
    $category = sanitize($conn, $_POST['category']);
    $template_id = intval($_POST['template_id']);
    $issue_date = date('Y-m-d');

    if (empty($user_id) || empty($event_name) || empty($category) || empty($template_id)) {
        $msg = "<div class='error'>All fields are required.</div>";
    } else {
        // Check for duplicates
        $check_sql = "SELECT id FROM certificates WHERE user_id = $user_id AND event_name = '$event_name'";
        $check_result = $conn->query($check_sql);

        if ($check_result->num_rows > 0) {
            $msg = "<div class='error'>Error: Certificate for this user and event already exists.</div>";
        } else {
            $sql = "INSERT INTO certificates (user_id, event_name, event_description, category, template_id, issue_date) 
                    VALUES ($user_id, '$event_name', '$event_description', '$category', $template_id, '$issue_date')";
            
            if ($conn->query($sql) === TRUE) {
                $msg = "<div class='success'>Certificate generated successfully!</div>";
            } else {
                $msg = "<div class='error'>Error: " . $conn->error . "</div>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Certificate - Admin</title>
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
    <h2>Generate Certificate</h2>
    <?php echo $msg; ?>
    <form method="POST" action="">
        <div class="form-group">
            <label>Select User</label>
            <select name="user_id" required>
                <option value="">-- Select User --</option>
                <?php while($user = $users_result->fetch_assoc()): ?>
                    <option value="<?php echo $user['id']; ?>">
                        <?php echo htmlspecialchars($user['name'] . " (" . $user['roll_number'] . ")"); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Event Name</label>
            <input type="text" name="event_name" required>
        </div>
        <div class="form-group">
            <label>Event Description</label>
            <textarea name="event_description" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label>Category</label>
            <select name="category" required>
                <option value="Winner">Winner</option>
                <option value="Runner">Runner</option>
                <option value="Participant">Participant</option>
            </select>
        </div>
        <div class="form-group">
            <label>Template Design</label>
            <select name="template_id" required>
                <option value="1">Template 1 (Winner Style)</option>
                <option value="2">Template 2 (Runner Style)</option>
                <option value="3">Template 3 (Participant Style)</option>
                <option value="4">Template 4 (Abstract Variation 1)</option>
                <option value="5">Template 5 (Abstract Variation 2)</option>
            </select>
        </div>
        <button type="submit">Generate & Send</button>
        <a href="dashboard.php" class="button" style="background-color: #95a5a6; margin-left: 10px;">Back</a>
    </form>
</div>

</body>
</html>
