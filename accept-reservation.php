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

  // Get admin ID
  $admin_id = $_SESSION['user_id'];

  // Prepare SQL statement to update reservation
  $stmt = $conn->prepare("UPDATE réservation SET bib_id = ?, bib_accepté_par = ? WHERE reserve_id = ?");
  $stmt->bindParam(1, $bib_id, PDO::PARAM_INT);
  $stmt->bindParam(2, $admin_id, PDO::PARAM_INT);
  $stmt->bindParam(3, $reservation_id, PDO::PARAM_INT);

  // Set bib_id to NULL
  $bib_id = NULL;

  // Execute SQL statement
  if ($stmt->execute()) {
    header("Location: admin-panel.php");
    exit();
  } else {
    $error = "Error accepting reservation: " . $conn->error;
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
