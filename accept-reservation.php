<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['bib_id'])) {
  header("Location: http://localhost/Library/Log-in.php");
  exit();
}

// Check if reservation ID is set
if (!isset($_GET['reserve_id'])) {
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
  $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

  // Check connection
  if ($conn->connect_error) {
    throw new Exception("Connection failed: " . $conn->connect_error);
  }

  // Get reservation ID
  $reservation_id = $_GET['reserve_id'];
  echo "Reservation ID: " . $reservation_id;

  // Begin transaction
  $conn->begin_transaction();

  // Prepare SQL statement to select reservation data
  $stmt_select = $conn->prepare("SELECT * FROM réservation WHERE reserve_id = ?");
  $stmt_select->bind_param("i", $reservation_id);

  // Execute SQL statement
  $stmt_select->execute();

  // Fetch reservation data
  $reservation_data = $stmt_select->get_result()->fetch_assoc();

  // Prepare SQL statement to insert reservation data into emprunt table
  $stmt_insert = $conn->prepare("INSERT INTO emprunt (ouvre_id, empr_date, empr_retour, empr_retourConfirm, bib_id, A_id, réservation_id) 
  VALUES (?, NOW(), DATE_ADD(NOW(), INTERVAL 15 DAY), NULL, ?, ?, ?)");
  $stmt_insert->bind_param("iiii", $reservation_data['ouvre_id'], $_SESSION['bib_id'], $reservation_data['A_id'], $reservation_id);

  // Execute SQL statement
  $stmt_insert->execute();

  // Commit transaction if all statements executed successfully
  $conn->commit();
  echo "Reservation copied to emprunt table successfully.";

  // Close statements
  $stmt_select->close();
  $stmt_insert->close();

  // Close database connection
  $conn->close();

} catch (Exception $e) {
  // Roll back transaction and output error message if there was an exception
  $conn->rollback();
  $error = 'Error: ' . $e->getMessage();
}

if ($error) {
  echo $error;
}

?>
