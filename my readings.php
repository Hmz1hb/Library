<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>My reservation</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js" integrity="sha512-pUhApVQtLbnpLtJn6DuzDD5o2xtmLJnJ7oBoMsBnzOkVkpqofGLGPaBJ6ayD2zQe3lCgCibhJBi4cj5wAxwVKA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="./css/main.css?v=<?php echo time(); ?>">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>
  </head>
  <body>
  <?php    session_start();
           // Check if the user is logged in
           if(!isset($_SESSION['id'])) {
            // Redirect the user to the login page
            header("Location:http://localhost/Library/land-page.php");
            exit;
          }
  ?>

  <!-- navbar -->
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

                     // Set the user ID you want to retrieve
                    $user_id = $_SESSION['id'];

                    // Prepare the SQL statement with a named parameter
                    $sql = "SELECT A_nom FROM adhérent WHERE A_id = :user_id";

                    // Bind the user ID to the named parameter
                    $stmt = $conn->prepare($sql);
                    $stmt->bindValue(':user_id', $user_id);

                    // Execute the prepared statement
                    $stmt->execute();

                    // Fetch the result and store it in a variable
                    $result = $stmt->fetch();

                    // Output the user's name
                        ?>
    <nav class = "navbar navbar-expand-lg navbar-light bg-white py-4 fixed-top mb-5">
        <div class = "container">
            <a class = "navbar-brand d-flex justify-content-between align-items-center order-lg-0" href = "land-page.php">
                <i class="fa fa-book" aria-hidden="true"></i>
                <span class = "text-uppercase fw-lighter ms-2">TooRead</span>
            </a>

            <div class = "order-lg-2 nav-btns">
                <!-- <button type = "button" class = "btn position-relative">
                    <i class = "fa fa-shopping-cart"></i>
                    <span class = "position-absolute top-0 start-100 translate-middle badge bg-primary">    </span>
                </button> -->
                <div class="dropdown text-end position-relative ">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $result['A_nom'];?>
          </a>
          <ul class="dropdown-menu text-small">
            <li><a class="dropdown-item" href="./my reservation.php">My Reservations</a></li>
            <li><a class="dropdown-item" href="./my borrows.php">My Borrows</a></li>
            <li><a class="dropdown-item" href="./my readings.php">My Readings</a></li>
            <li><a class="dropdown-item" href="./Profile.php">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
          </ul>
        </div>
            </div>

            <button class = "navbar-toggler border-0" type = "button" data-bs-toggle = "collapse" data-bs-target = "#navMenu">
                <span class = "navbar-toggler-icon"></span>
            </button>

            <div class = "collapse navbar-collapse order-lg-1" id = "navMenu">
                <ul class = "navbar-nav mx-auto text-center">
                    <li class = "nav-item px-2 py-2">
                        <a class = "nav-link text-uppercase text-dark" href = "./land-page.php">home</a>
                    </li>
                    <li class = "nav-item px-2 py-2">
                        <a class = "nav-link text-uppercase text-dark" href = "./land-page.php">about us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<section id = "collection">
<div class="container-fluid mt-5">
  <div class="row">

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Borrows</h1>
      </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                            <div class="content">
                              <h3>All the books that you have borrowed from the library</h3>

                             <div class = "collection-list mt-4 row gx-0 gy-3">
                <?php
                    // Connect to database using PDO
                    $dbHost = 'localhost';
                    $dbName = 'library';
                    $dbUser = 'root';
                    $dbPass = '';
                    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);

                    $a_id    = $_SESSION['id'];

                    // Fetch image data from database
                    $sql = "SELECT MIN(ouvrage.ouvre_id) AS ouvre_id, ouvrage.ouvre_titre, ouvrage.ouvre_auteur, ouvrage.ouvre_img, ouvrage.ouvre_etat, ouvrage.ouvre_type, ouvrage.ouvre_editionD, ouvrage.ouvre_achatD, ouvrage.ouvre_pages 
                    FROM ouvrage 
                    JOIN emprunt_log ON ouvrage.ouvre_id = emprunt_log.ouvre_id
                    WHERE emprunt_log.A_id = :a_id
                    GROUP BY ouvrage.ouvre_titre";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':a_id', $a_id);
                    
                    // Execute the query and loop through the results
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $imgData = $row['ouvre_img'];
                        $imgType = finfo_buffer(finfo_open(), $imgData, FILEINFO_MIME_TYPE);
                        $imgSrc = 'data:' . $imgType . ';base64,' . base64_encode($imgData);
                        ?>
                                                
                            <div class="col-md-6 col-lg-4 col-xl-3 p-2 <?php echo $row['ouvre_type']; ?>">
                            <div class="collection-img position-relative">
                                <img src="<?php echo $imgSrc; ?>" class="w-100 ">
                                <span class="position-absolute bg-primary text-white d-flex align-items-center justify-content-center"><?php echo $row['ouvre_etat']; ?></span>
                            </div>
                            <div class="text-center m-2">
                                <p class="text-capitalize my-1"><?php echo $row['ouvre_titre']; ?></p>
                                <span class="fw-bold"><?php echo $row['ouvre_auteur']; ?></span>
                                <div class="text-center">
                                <a class="btn btn-primary mt-3 Eticket-btn" data-bs-toggle="modal" data-bs-target="#exampleModal3" data-bs-id="<?php echo $row['ouvre_id']; ?>" data-bs-title="<?php echo $row['ouvre_titre']; ?>">My E-ticket</a>

                                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="<?php echo $row['ouvre_titre']; ?>" data-bs-author="<?php echo $row['ouvre_auteur']; ?>" data-bs-image="<?php echo $imgSrc; ?>" data-bs-etat="<?php echo $row['ouvre_etat']; ?>" data-bs-type="<?php echo $row['ouvre_type']; ?>" data-bs-edition="<?php echo $row['ouvre_editionD']; ?>" data-bs-pages="<?php echo $row['ouvre_pages']; ?>">
                                Details
                                </button>
              
                                </div>
                            </div>
                            </div>
                            <?php
                        }
                        // Close database connection
                        $conn = null;
                        ?>
                </div>

                            </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
 </div>
                                 
<!-- Modal details -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Book Title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="text-center">
            <img src="" class="w-50 mb-3" id="modal-image">
            <p class="mb-0"><strong>Author:</strong> <span id="modal-author"></span></p>
            <p class="mb-0"><strong>Condition:</strong> <span id="modal-etat"></span></p>
            <p class="mb-0"><strong>Type:</strong> <span id="modal-type"></span></p>
            <p class="mb-0"><strong>Edition Date:</strong> <span id="modal-edition"></span></p>
            <p class="mb-0"><strong>Pages Number:</strong> <span id="modal-pages"></span></edition"></span></p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

 <div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="reservationModalLabel">Reservation failed</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="reservationMessage"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- E-ticket Modal -->
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel3">E-ticket for <span class="book-title"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <canvas id="qr-code" class="mb-3"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


    </main>
  </div>
</div>

<script>



$(document).ready(function() {
    $('.Eticket-btn').click(function() {
    // Get the ouvre_id and ouvre_titre attributes of the button
    var ouvre_id = $(this).data('bs-id');
    var ouvre_titre = $(this).data('bs-title');

    // Update the book title in the E-ticket modal
    $('.book-title').text(ouvre_titre);

    // Fetch the ticket code from the database using AJAX
    $.ajax({
        url: 'fetch_ticket_code.php',
        method: 'POST',
        data: {ouvre_id: ouvre_id},
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                // Generate the QR code using qrious
                var qr = new QRious({
                    element: document.getElementById('qr-code'),
                    value: response.ticket_code.toString(),
                    size: 200
                });
            } else {
                alert('Failed to fetch ticket code.');
            }
        },
        error: function() {
            alert('Failed to fetch ticket code.');
        }
    });
});
});



// get modal and its elements
var modal = document.getElementById('exampleModal');
var titleElement = modal.querySelector('.modal-title');
var authorElement = modal.querySelector('#modal-author');
var imageElement = modal.querySelector('#modal-image');
var etatElement = modal.querySelector('#modal-etat');
var typeElement = modal.querySelector('#modal-type');
var editionElement = modal.querySelector('#modal-edition');
var pagesElement = modal.querySelector('#modal-pages');

// add event listener to modal to update content when opened
modal.addEventListener('show.bs.modal', function (event) {
  // get button that triggered modal and its data attributes
  var button = event.relatedTarget;
  var title = button.getAttribute('data-bs-title');
  var author = button.getAttribute('data-bs-author');
  var imageSrc = button.getAttribute('data-bs-image');
  var etat = button.getAttribute('data-bs-etat');
  var type = button.getAttribute('data-bs-type');
  var edition = button.getAttribute('data-bs-edition');
  var pages = button.getAttribute('data-bs-pages');

  // update modal content with book details
  titleElement.textContent = title;
  authorElement.textContent = author;
  imageElement.src = imageSrc;
  etatElement.textContent = etat;
  typeElement.textContent = type;
  editionElement.textContent = edition;
  pagesElement.textContent = pages;
});

</script>
      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
