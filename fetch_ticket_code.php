<?php
// Connect to database using PDO
$dbHost = 'localhost';
$dbName = 'library';
$dbUser = 'root';
$dbPass = '';
$conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);

// Get the ouvre_id passed via AJAX
$ouvre_id = $_POST['ouvre_id'];

// Fetch the ticket_code from the database
$sql = "SELECT ticket_code FROM réservation WHERE ouvre_id = :ouvre_id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':ouvre_id', $ouvre_id, PDO::PARAM_INT);
$stmt->execute();
$ticket_code = $stmt->fetchColumn();

// Close database connection
$conn = null;

if ($ticket_code !== false) {
    // Return the ticket_code as a JSON object
    echo json_encode(['success' => true, 'ticket_code' => $ticket_code]);
} else {
    // Return an error message as a JSON object
    echo json_encode(['success' => false, 'message' => 'Failed to fetch ticket code.']);
}
?>
