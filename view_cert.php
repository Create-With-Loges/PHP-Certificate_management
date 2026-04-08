<?php
require_once 'db.php';

if (!isset($_GET['id'])) {
    die("Certificate ID not specified.");
}

$id = intval($_GET['id']);
$sql = "SELECT c.*, u.name, u.roll_number, u.class, u.department 
        FROM certificates c 
        JOIN users u ON c.user_id = u.id 
        WHERE c.id = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Certificate not found.");
}

$cert = $result->fetch_assoc();
$template_file = "templates/template_" . $cert['template_id'] . ".php";

if (!file_exists($template_file)) {
    die("Template file not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate - <?php echo htmlspecialchars($cert['event_name']); ?></title>
    <link rel="stylesheet" href="templates/cert_style.css">
    <style>
        @media print {
            .no-print { display: none; }
            body { margin: 0; padding: 0; background: white; }
            .certificate-container { box-shadow: none; margin: 0; width: 100%; height: 100vh; page-break-after: always; }
        }
        body {
            background: #555;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .controls {
            margin-bottom: 20px;
            background: white;
            padding: 10px 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>

<div class="controls no-print" style="text-align: center;">
    <button onclick="window.print()" class="button" style="font-size: 1.1rem; padding: 12px 30px; background-color: #2ecc71;">Save as PDF</button>
    <a href="./user/dashboard.php" class="button" style="font-size: 1.1rem; padding: 12px 30px; background-color: #95a5a6; margin-left: 10px;"><button> Back</button></a>
</div>

<?php include $template_file; ?>

</body>
</html>
