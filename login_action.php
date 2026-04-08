<?php
session_start();
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitize($conn, $_POST['username']);
    $password = $_POST['password']; // Plain text password as per requirements

    if (empty($username) || empty($password)) {
        header("Location: index.php?error=All fields are required");
        exit();
    }

    $sql = "SELECT id, username, password, role, name FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Direct comparison for plain text passwords
        if ($password === $row['password']) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['name'] = $row['name'];

            if ($row['role'] == 'admin') {
                header("Location: admin/dashboard.php");
            } else {
                header("Location: user/dashboard.php");
            }
            exit();
        } else {
            header("Location: index.php?error=Invalid password");
            exit();
        }
    } else {
        header("Location: index.php?error=User not found");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>
