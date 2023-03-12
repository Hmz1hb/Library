<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['id'])) {
  header("Location:http://localhost/Library/Log-in.php");
  exit();
}

// Check if reservation ID is set
if (!isset($_GET['bib_id'])) {
  header("Location: http://localhost/Library/admin-panel.php");
  exit();
}

// Connect to database
$dbHost = 'localhost';
$dbName = 'library';
$dbUser = 'root';
$dbPass = '';

$error = '';

try {
  $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Get reservation ID
  $reservation_id = $_GET['id'];

  // Prepare SQL statement to delete reservation
  $stmt = $conn->prepare("DELETE FROM réservation WHERE reserve_id = ?");
  $stmt->bindParam(1, $reservation_id, PDO::PARAM_INT);

 // Execute SQL statement
 if ($stmt->execute()) {
    header("Location: http://localhost/Library/admin-panel.php");
    exit();
  } else {
    $error = "Error deleting reservation: " . $conn->errorInfo()[2];
  }

  // Close statement
  $stmt = null;

  // Close database connection
  $conn = null;

} catch(PDOException $e) {
  $error = 'Error: ' . $e->getMessage();
}

if ($error) {
  echo $error;
}
?>
