<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['bib_id'])) {
  header('Location: http://localhost/Library/login.php');
  exit();
}

// Check if the reservation ID is provided
if (!isset($_GET['reserve_id'])) {
  header('Location: http://localhost/Library/admin-panel.php');
  exit();
}

// Get the reservation ID and book ID
$reserve_id = $_GET['reserve_id'];
$bib_id = $_SESSION['bib_id'];

// Connect to the database
$dbHost = 'localhost';
$dbName = 'library';
$dbUser = 'root';
$dbPass = '';

try {
  $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  // Get the reservation details
  $sql = "SELECT * FROM réservation WHERE reserve_id = '$reserve_id'";
  $result = $conn->query($sql);
  $reservation = $result->fetch(PDO::FETCH_ASSOC);
  
  // Debug output
  var_dump($reservation);
  
  
  // Calculate the return date (current date + 15 days)
  $return_date = date('Y-m-d', time());

  // Set the initial return confirmation status to 0
  $empr_retourConfirm = date('Y-m-d', strtotime('+15 days'));
  
  // Insert the reservation details into the emprunt table
  $sql = "INSERT INTO emprunt (ouvre_id, empr_date, empr_retour, empr_retourConfirm, bib_id, A_id, réservation_id) VALUES ('$reservation[ouvre_id]', '$reservation[reserve_date]', '$return_date', '$empr_retourConfirm', '$bib_id', '$reservation[A_id]', '$reserve_id')";
  $conn->exec($sql);
  
  // Debug output
  var_dump($reservation['ouvre_id'], $reservation['reserve_date'], $return_date, $empr_retourConfirm, $bib_id, $reservation['A_id'], $reserve_id);
  

  
  // Delete the reservation from the réservation table
  $sql = "DELETE FROM réservation WHERE reserve_id = '$reserve_id'";
  $conn->exec($sql);
  
  // Redirect to the admin panel
  header('Location: http://localhost/Library/admin-panel.php');
  exit();
  
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

?>