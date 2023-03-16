<?php
    
session_start();
         // Check if the user is logged in
         if(!isset($_SESSION['bib_id'])) {
          // Redirect the user to the login page
          header("Location:http://localhost/Library/Log-in.php");
          exit;
        }

// establish database connection
$host = "localhost";
$username = "root";
$password = "";
$dbname = "library";

$conn = mysqli_connect($host, $username, $password, $dbname);

// check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// get the bibliothèque ID from the session
$bib_id = $_SESSION['bib_id'];

// get the form data
$ouvre_titre = $_POST['ouvre_titre'];
$ouvre_auteur = $_POST['ouvre_auteur'];
$ouvre_img = file_get_contents($_FILES['ouvre_img']['tmp_name']);
$ouvre_etat = $_POST['ouvre_etat'];
$ouvre_type = $_POST['ouvre_type'];
$ouvre_editionD = $_POST['ouvre_editionD'];
$ouvre_achatD = $_POST['ouvre_achatD'];
$ouvre_pages = $_POST['ouvre_pages'];

// prepare and execute the SQL statement to insert the new ouvrage
// prepare and execute the SQL statement to insert the new ouvrage
$sql = "INSERT INTO ouvrage (ouvre_titre, ouvre_auteur, ouvre_img, ouvre_etat, ouvre_type, ouvre_editionD, ouvre_achatD, ouvre_pages, bib_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssbsssssi", $ouvre_titre, $ouvre_auteur, $ouvre_img, $ouvre_etat, $ouvre_type, $ouvre_editionD, $ouvre_achatD, $ouvre_pages, $bib_id);
mysqli_stmt_send_long_data($stmt, 2, $ouvre_img); // set the image data as a blob
mysqli_stmt_execute($stmt);

// check if the insert was successful
if (mysqli_affected_rows($conn) > 0) {
    echo "New ouvrage added successfully.";
} else {
    echo "Error: " . mysqli_error($conn);
}

// close database connection
mysqli_close($conn);

?>