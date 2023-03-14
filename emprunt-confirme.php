<?php
// Connect to database using PDO
$dbHost = 'localhost';
$dbName = 'library';
$dbUser = 'root';
$dbPass = '';

// Connect to the database
try {
    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Check if empr_id parameter is set
if (!isset($_GET['empr_id'])) {
    die("No emprunt ID specified.");
}

// Get empr_id parameter from URL
$emprid = $_GET['empr_id'];

// Prepare the SQL statement to update empr_retourConfirm column with the current date
$sql = "UPDATE emprunt SET empr_retourConfirm = CURRENT_TIMESTAMP WHERE empr_id = :emprid";

// Execute the prepared statement
$stmt = $conn->prepare($sql);
$stmt->bindParam(':emprid', $emprid, PDO::PARAM_INT);
$stmt->execute();

// Redirect back to admin panel
header("Location: admin-panel.php");
exit();
?>
