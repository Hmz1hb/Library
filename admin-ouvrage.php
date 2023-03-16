<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.72.0">
  <title>Dashboard Template</title>

  <link rel="canonical" href="https://v5.getbootstrap.com/docs/5.0/examples/dashboard/">



  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
    integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
    integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/"
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js" integrity="sha512-pUhApVQtLbnpLtJn6DuzDD5o2xtmLJnJ7oBoMsBnzOkVkpqofGLGPaBJ6ayD2zQe3lCgCibhJBi4cj5wAxwVKA==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    body {
      font-size: .875rem;
    }

    .feather {
      width: 16px;
      height: 16px;
      vertical-align: text-bottom;
    }

    /* Sidebar*/

    .sidebar {
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      z-index: 100;
      /* Behind the navbar */
      padding: 48px 0 0;
      /* Height of navbar */
      box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
    }

    @media (max-width: 767.98px) {
      .sidebar {
        top: 5rem;
      }
    }

    .sidebar-sticky {
      position: relative;
      top: 0;
      height: calc(100vh - 48px);
      padding-top: .5rem;
      overflow-x: hidden;
      overflow-y: auto;
      /* Scrollable contents if viewport is shorter than content. */
    }

    .sidebar .nav-link {
      font-weight: 500;
      color: #333;
    }

    .sidebar .nav-link .feather {
      margin-right: 4px;
      color: #727272;
    }

    .sidebar .nav-link.active {
      color: #007bff;
    }

    .sidebar .nav-link:hover .feather,
    .sidebar .nav-link.active .feather {
      color: inherit;
    }

    .sidebar-heading {
      font-size: .75rem;
      text-transform: uppercase;
    }

    /*Navbar*/
    .navbar-brand {
      padding-top: .75rem;
      padding-bottom: .75rem;
      font-size: 1rem;
      background-color: rgba(0, 0, 0, .25);
      box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
    }

    .navbar .navbar-toggler {
      top: .25rem;
      right: 1rem;
    }

    .navbar .form-control {
      padding: .75rem 1rem;
      border-width: 0;
      border-radius: 0;
    }

    .form-control-dark {
      color: #fff;
      background-color: rgba(255, 255, 255, .1);
      border-color: rgba(255, 255, 255, .1);
    }

    .form-control-dark:focus {
      border-color: transparent;
      box-shadow: 0 0 0 3px rgba(255, 255, 255, .25);
    }
  </style>
</head>

<?php    
  session_start();
           // Check if the user is logged in
           if(!isset($_SESSION['bib_id'])) {
            // Redirect the user to the login page
            header("Location:http://localhost/Library/Log-in.php");
            exit;
          }
  ?>

<body>

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

    // Set the bibliothécaire ID you want to retrieve
    $bib_id = $_SESSION['bib_id'];

    // Prepare the SQL statement with a named parameter
    $sql = "SELECT bib_nom FROM bibliothécaire WHERE bib_id = :bib_id";

    // Bind the bibliothécaire ID to the named parameter
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':bib_id', $bib_id);

    // Execute the prepared statement
    $stmt->execute();

    // Fetch the result and store it in a variable
    $result = $stmt->fetch();

    // Output the bibliothécaire's name
?>


<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Company name</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
      data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <input id="search-input" class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="./logout.php">Sign out</a>
      </li>
    </ul>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="./admin-panel.php">
                <span data-feather="home"></span>
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./admin-reservation.php">
                <span data-feather="file"></span>
                Reservation
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./admin-emprunt.php">
                <span data-feather="shopping-cart"></span>
                Emprunts on cour
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./admin-emprunt-log.php">
                <span data-feather="shopping-cart"></span>
                Emprunts Log
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./admin-adherent.php">
                <span data-feather="users"></span>
                List d'adhérent
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="./admin-ouvrage.php">
                <span data-feather="bar-chart-2"></span>
                Les ouvrage
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./admin-ouvrage-add.php">
                <span data-feather="bar-chart-2"></span>
                Ajouter un ouvrage
              </a>
            </li>
          </ul>

      
        </div>
      </nav>

      <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <div
          class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">List D'ouvrage</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-outline-secondary export-button">Export</button>
          </div>
        </div>
        </div>

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

// Prepare the SQL statement to retrieve book data
$sql = "SELECT ouvre_id, ouvre_titre, ouvre_img, ouvre_auteur, ouvre_etat, ouvre_type, ouvre_editionD, ouvre_achatD, ouvre_pages, bib_id
        FROM ouvrage";

// Execute the prepared statement
$stmt = $conn->prepare($sql);
$stmt->execute();

// Fetch the result set as an associative array
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="table-responsive">
  <table id="book-table" class="table table-striped table-sm">
    <thead>
      <tr>
        <th>ID</th>
        <th>Titre</th>
        <th>Auteur</th>
        <th>Image</th>
        <th>Etat</th>
        <th>Type</th>
        <th>Edition Date</th>
        <th>Achat Date</th>
        <th>Pages</th>
        <th>Bib ID</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($books as $book): ?>
        <tr>
          <td><?php echo $book['ouvre_id']; ?></td>
          <td>
            <?php if ($book['ouvre_img']): ?>
              <img src="data:image/jpeg;base64,<?php echo base64_encode($book['ouvre_img']); ?>" width="100">
            <?php endif; ?>
          </td>
          <td><?php echo $book['ouvre_titre']; ?></td>
          <td><?php echo $book['ouvre_auteur']; ?></td>
          <td><?php echo $book['ouvre_etat']; ?></td>
          <td><?php echo $book['ouvre_type']; ?></td>
          <td><?php echo $book['ouvre_editionD']; ?></td>
          <td><?php echo $book['ouvre_achatD']; ?></td>
          <td><?php echo $book['ouvre_pages']; ?></td>
          <td><?php echo $book['bib_id']; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

      </main>


  <script>

// Select the export button element
var $exportButton = $('.export-button');

// Add an event listener to the export button
$exportButton.on('click', function() {
  // Select the table element
  var $table = $('#book-table');

  // Convert the table to a worksheet
  var worksheet = XLSX.utils.table_to_sheet($table[0]);

  // Loop through each row in the worksheet
  for (var r = 1; worksheet['!range'] && r < worksheet['!range'].e.r; r++) {
    // Get the cell containing the image
    var cell = XLSX.utils.encode_cell({r:r, c:3});

    // Convert the image to a base64 encoded string
    var imgData = worksheet[cell].v;
    var img = new Image();
    img.src = imgData;
    var canvas = document.createElement('canvas');
    canvas.width = img.width;
    canvas.height = img.height;
    var ctx = canvas.getContext('2d');
    ctx.drawImage(img, 0, 0);
    var base64Img = canvas.toDataURL('image/png');

    // Replace the image with the base64 encoded string
    worksheet[cell] = {t:'s', v:base64Img};
  }

  // Convert the worksheet to a workbook
  var workbook = XLSX.utils.book_new();
  XLSX.utils.book_append_sheet(workbook, worksheet, 'Reservation');

  // Export the workbook
  var filename = 'List Ouvragee.xlsx';
  XLSX.writeFile(workbook, filename);
});





</script>



 

  <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.24.1/feather.min.js"
    integrity="sha384-EbSscX4STvYAC/DxHse8z5gEDaNiKAIGW+EpfzYTfQrgIlHywXXrM9SUIZ0BlyfF"
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>


 
</body>

</html>