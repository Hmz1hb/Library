<?php
session_start();

// Connect to the database
$dbHost = 'localhost';
$dbName = 'library';
$dbUser = 'root';
$dbPass = '';

try {
  $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}

// Check if the reservation button was clicked
if (isset($_POST['ouvre_id'])) {
  // Get the ouvre_id from the POST data
  $ouvre_id = $_POST['ouvre_id'];

  // Check if the user has already made 3 reservations
  $stmt = $pdo->prepare("SELECT COUNT(*) FROM réservation WHERE A_id = ?");
  $stmt->execute([$_SESSION['id']]);
  $count = $stmt->fetchColumn();
  if ($count >= 3) {
    // Send a response back to the AJAX request
    $response = array(
      'success' => false,
      'message' => 'You have already made 3 reservations.',
    );
    echo json_encode($response);
  } else {
    // Check if the book is already reserved
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM réservation WHERE ouvre_id = ?");
    $stmt->execute([$ouvre_id]);
    $count = $stmt->fetchColumn();
    if ($count > 0) {
      // Select the minimum ouvre_id of the available books
      $stmt = $pdo->prepare("SELECT MIN(ouvre_id) FROM ouvrage WHERE ouvre_id NOT IN (SELECT ouvre_id FROM réservation) AND ouvre_etat != 'Déchiré' AND ouvre_id = ?");
      $stmt->execute([$ouvre_id]);
      $ouvre_id = $stmt->fetchColumn();

      // If no books are available, send an error response
      if (!$ouvre_id) {
        $response = array(
          'success' => false,
          'message' => 'The book is already reserved and no other copies are available.',
        );
        echo json_encode($response);
        return;
      }
    }

    // Calculate the Date_limite_retrait as current date + 1 day
    $date_limite_retrait = date('Y-m-d', strtotime('+1 day'));
    $reserve_id = $pdo->lastInsertId();
    $ticket_code = $reserve_id . rand(10000, 99999);

    // Insert a new row into the reservation table
    $stmt = $pdo->prepare("INSERT INTO réservation (ouvre_id, A_id, reserve_date, Date_limite_retrait, ticket_code) VALUES (?, ?, NOW(), ?, ?)");
    $stmt->execute([$ouvre_id, $_SESSION['id'], $date_limite_retrait, $ticket_code]);

    // Insert the ticket code into the database
    $stmt = $pdo->prepare("UPDATE réservation SET ticket_code = ? WHERE reserve_id = ?");
    $stmt->execute([$ticket_code, $reserve_id]);

    // Send a response back to the AJAX request
    $response = array(
      'success' => true,
      'message' => 'Reservation successful!',
      'ticket_code' => $ticket_code
    );
    echo json_encode($response);
  }
}
?>