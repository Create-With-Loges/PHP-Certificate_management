<?php
session_start();
require_once '../db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitize($conn, $_POST['username']);
    $password = $_POST['password'];
    $name = sanitize($conn, $_POST['name']);
    $roll_number = sanitize($conn, $_POST['roll_number']);
    $class = sanitize($conn, $_POST['class']);
    $department = sanitize($conn, $_POST['department']);

    if (empty($username) || empty($password) || empty($name) || empty($roll_number)) {
        $msg = "<div class='error'>All fields are required.</div>";
    } else {
        $sql = "INSERT INTO users (username, password, name, roll_number, class, department, role) 
                VALUES ('$username', '$password', '$name', '$roll_number', '$class', '$department', 'user')";
        
        if ($conn->query($sql) === TRUE) {
            $msg = "<div class='success'>User added successfully!</div>";
        } else {
            $msg = "<div class='error'>Error: " . $conn->error . "</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User - Admin</title>
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
    <h2>Add New User</h2>
    <?php echo $msg; ?>
    <form method="POST" action="">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>
        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name" required>
        </div>
        <div class="form-group">
            <label>Roll Number</label>
            <input type="text" name="roll_number" required>
        </div>
        <div class="form-group">
            <label>Class</label>
            <input type="text" name="class" required>
        </div>
        <div class="form-group">
            <label>Department</label>
            <input type="text" name="department" required>
        </div>
        <button type="submit">Add User</button>
        <a href="dashboard.php" class="button" style="background-color: #95a5a6; margin-left: 10px;">Back</a>
    </form>
</div>

</body>
</html>
