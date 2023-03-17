<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TooRead</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js" integrity="sha512-pUhApVQtLbnpLtJn6DuzDD5o2xtmLJnJ7oBoMsBnzOkVkpqofGLGPaBJ6ayD2zQe3lCgCibhJBi4cj5wAxwVKA==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>


    <!-- custom css -->
    <link rel="stylesheet" href="./css/main.css?v=<?php echo time(); ?>">
    <style>
      .collection-img img {
    height: 500px;
    width: 400px;
    object-fit: fill;
}
    </style>
</head>
<?php    
session_start();

// Check if the user is logged in and has fewer than 3 penalties
if (isset($_SESSION['id'])) {
  $userId = $_SESSION['id'];
  $db = new mysqli('localhost', 'root', '', 'library');
  $query = "SELECT A_pénalités FROM `adhérent` WHERE A_id = $userId";
  $result = $db->query($query);
  $row = $result->fetch_assoc();
  $penalties = $row['A_pénalités'];
  if ($penalties >= 3) {
    // Redirect the user to a page indicating that they cannot log in
    header("Location: http://localhost/Library/penalty.php");
    exit;
  }
} else {
  // Redirect the user to the login page
  header("Location: http://localhost/Library/Log-in.php");
  exit;
}

  ?>
<body>
    
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
    <nav class = "navbar navbar-expand-lg navbar-light bg-white py-4 fixed-top">
        <div class = "container">
        <a class = "navbar-brand d-flex justify-content-between align-items-center order-lg-0" href = "land-page.php">
                <i class="fa fa-book" aria-hidden="true"></i>
                <span class = "text-uppercase fw-lighter ms-2">The Reading Room</span>
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
                        <a class = "nav-link text-uppercase text-dark" href = "#header">home</a>
                    </li>
                    <!-- <li class = "nav-item px-2 py-2">
                        <a class = "nav-link text-uppercase text-dark" href = "#collection">collection</a>
                    </li>
                    <li class = "nav-item px-2 py-2">
                        <a class = "nav-link text-uppercase text-dark" href = "#special">specials</a>
                    </li> -->
                    <!-- <li class = "nav-item px-2 py-2">
                        <a class = "nav-link text-uppercase text-dark" href = "#blogs">blogs</a>
                    </li> -->
                    <li class = "nav-item px-2 py-2">
                        <a class = "nav-link text-uppercase text-dark" href = "#about">about us</a>
                    </li>
                    <!-- <li class = "nav-item px-2 py-2 border-0">
                        <a class = "nav-link text-uppercase text-dark" href = "#popular">popular</a>
                    </li> -->
                </ul>
            </div>
        </div>
    </nav>
    <!-- end of navbar -->

    <!-- header -->
    <header id = "header" class = "vh-50 carousel slide" data-bs-ride = "carousel" style = "padding-top: 104px;">
        <div class = "container h-100 d-flex align-items-center carousel-inner">
            <div class = "text-center carousel-item active">
                <!-- <h2 class = "text-capitalize text-white">best collection</h2> -->
                <h1 class = "text-uppercase py-2 fw-bold text-secondary text-light">Our Collection</h1>
                <!-- <a href = "#" class = "btn mt-3 text-uppercase">shop now</a> -->
            </div>
        </div>
    </header>
    <!-- end of header -->

    <!-- collection -->
    <section id = "collection" >
        <div class = "container">

            <div class = "row g-0">
                <div class = "d-flex flex-wrap justify-content-center mt-5 filter-button-group">
                    <button type = "button" class = "btn m-2 text-dark active-filter-btn" data-filter = "*">All</button>
                    <button type = "button" class = "btn m-2 text-dark" data-filter = ".Roman">Roman</button>
                    <button type = "button" class = "btn m-2 text-dark" data-filter = ".livre">Livre</button>
                    <button type = "button" class = "btn m-2 text-dark" data-filter = ".DVD">DVD</button>
                    <button type = "button" class = "btn m-2 text-dark" data-filter = ".mémoire de recherche">mémoire de recherche</button>
                    <button type = "button" class = "btn m-2 text-dark" data-filter = ".magazine">magazine</button>
                </div>
                <input id="search-input" class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
                <div class = "collection-list mt-4 row gx-0 gy-3">
                <?php
                    // Connect to database using PDO
                    $dbHost = 'localhost';
                    $dbName = 'library';
                    $dbUser = 'root';
                    $dbPass = '';
                    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);

                    // Fetch image data from database
$sql = "SELECT MIN(ouvrage.ouvre_id) AS ouvre_id, ouvrage.ouvre_titre, ouvrage.ouvre_auteur, ouvrage.ouvre_img, ouvrage.ouvre_etat, ouvrage.ouvre_type, ouvrage.ouvre_editionD, ouvrage.ouvre_achatD, ouvrage.ouvre_pages 
FROM ouvrage 
WHERE ouvrage.ouvre_etat <> 'Déchiré' 
AND ouvrage.ouvre_id NOT IN (
    SELECT emprunt.ouvre_id FROM emprunt 
    UNION 
    SELECT réservation.ouvre_id FROM réservation
) 
GROUP BY ouvrage.ouvre_titre";            

$result = $conn->query($sql);

// Loop through each image and display it on the webpage
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $imgData = $row['ouvre_img'];
    $imgType = finfo_buffer(finfo_open(), $imgData, FILEINFO_MIME_TYPE);
    $imgSrc = 'data:' . $imgType . ';base64,' . base64_encode($imgData);
                        ?>
                                                
                            <div class="col-md-6 col-lg-4 col-xl-3 p-2 <?php echo $row['ouvre_type']; ?> cardss">
                            <div class="collection-img position-relative">
                                <img src="<?php echo $imgSrc; ?>" class="w-100">
                                <span class="position-absolute bg-primary text-white d-flex align-items-center justify-content-center"><?php echo $row['ouvre_etat']; ?></span>
                            </div>
                            <div class="text-center m-2">
                                <p class="text-capitalize my-1 card-title"><?php echo $row['ouvre_titre']; ?></p>
                                <span class="fw-bold"><?php echo $row['ouvre_auteur']; ?></span>
                                <div class="text-center">
                                <a class="btn btn-primary mt-3 reserve-btn" data-bs-toggle="modal" data-bs-target="#exampleModal3" data-bs-title="<?php echo $row['ouvre_id']; ?>">Reserve</a>

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
<!-- reservation modal -->

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

<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to make this reservation?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="confirm-reservation">Yes, reserve</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="res-success" tabindex="-1" aria-labelledby="modal-title-succ" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title-succ"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="text-center">
      <canvas id="qr-code" style="width: 200px; height: 200px;"></canvas>
      <h3>Your Ticket code Is:</h3>
      <span id="ticket-code"></span>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<script>


$(document).ready(function() {
  $('.reserve-btn').click(function() {
    var ouvre_id = $(this).data('bs-title');
    $('#confirm-reservation').attr('data-ouvre-id', ouvre_id);
    $('#exampleModal3').modal('show');
  });
  
  $('#confirm-reservation').click(function() {
  var ouvre_id = $(this).data('ouvre-id');
  var selected_date = $('#date-select').val();
  $.ajax({
    type: 'POST',
    url: 'process_reservation.php',
    data: {ouvre_id: ouvre_id, selected_date: selected_date},
    dataType: 'json',
    success: function(response) {
  if (response.success) {
    // If the selected date is available, proceed with the reservation
    $('#modal-title-succ').text('Reservation successful!');
    $('.suc-rep').html(response.message);
    
    // Remove leading zeros from ticket code and generate the QR code
    var ticket_code = parseInt(response.ticket_code, 10).toString();
    var qr = new QRious({
      element: document.getElementById('qr-code'),
      value: ticket_code,
      size: 200,
      backgroundAlpha: 0,
      foregroundAlpha: 1,
      level: 'H'
    });

     // Set the text content of #ticket-code to display the ticket code
     document.querySelector('#ticket-code').textContent = ticket_code;
    
    $('#res-success').modal('show');
    $('#res-success').on('hidden.bs.modal', function () {
      location.reload();
    });
  } else {
    // If the selected date is not available, show an error message
    $('#reservationMessage').text(response.message);
    $('#reservationModal').modal('show');
  }
},
    error: function(response) {
      console.log(response);
      $('#modal-title-fail').text('Reservation failed!');
      $('.modal-body-fail').html(response.responseText);
      $('#reservationModal').modal('show');
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

const searchInput = document.querySelector('#search-input');
const cards = document.querySelectorAll('.cardss');

searchInput.addEventListener('keyup', function() {
    const searchTerm = this.value.toLowerCase();
    cards.forEach(card => {
        const titleElement = card.querySelector('.card-title');
        const titleText = titleElement.textContent.toLowerCase();
        if (titleText.includes(searchTerm)) {
          card.style.opacity = '1';
          card.style.maxHeight = '1000px';
        } else {
          card.style.opacity = '0';
          card.style.maxHeight = '0';
        }
    });
});
</script>
    </section>
    <!-- end of collection -->
    <!-- blogs -->
    <section id = "offers" class = "py-5">
        <div class = "container">
            <div class = "row d-flex align-items-center justify-content-center text-center justify-content-lg-start text-lg-start">
                <div class = "offers-content">
                    <span class = "text-white">15 Day Reservation</span>
                    <h2 class = "mt-2 mb-4 text-white">Explore, Learn, Enjoy!</h2>
                    <a href = "#collection" class = "btn">Start Reading</a>
                </div>
            </div>
        </div>
    </section>
    <!-- end of blogs -->

    <!-- about us -->
    <section id = "about" class = "py-5">
        <div class = "container">
            <div class = "row gy-lg-5 align-items-center">
                <div class = "col-lg-6 order-lg-1 text-center text-lg-start">
                    <div class = "title pt-3 pb-5">
                        <h2 class = "position-relative d-inline-block ms-4">About Us</h2>
                    </div>
                    <p class = "lead text-secondary">Books are a wonderful gateway to knowledge, imagination, and new perspectives. They provide a world of information, ideas, and entertainment, all within the pages of a single bound volume. Reading books can help us develop our language skills, open our minds to diverse cultures and perspectives, and expand our horizons. So, let us treasure these vessels of knowledge, and make books an integral part of our lives..</p>
                </div>
                <div class = "col-lg-6 order-lg-0">
                    <img src = "images/pexels-ivo-rainha-1261180.jpg" alt = "" class = "img-fluid">
                </div>
            </div>
        </div>
    </section>
    <!-- end of about us -->


    <!-- footer -->
    <footer class = "bg-dark py-5">
        <div class = "container">
            <div class = "row text-white g-4">
                <div class = "col-md-6 col-lg-3">
                    <a class = "text-uppercase text-decoration-none brand text-white" href = "index.html">Attire</a>
                    <p class = "text-secondary mt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum mollitia quisquam veniam odit cupiditate, ullam aut voluptas velit dolor ipsam?</p>
                </div>

                <div class = "col-md-6 col-lg-3">
                    <h5 class = "fw-light">Links</h5>
                    <ul class = "list-unstyled">
                        <li class = "my-3">
                            <a href = "#" class = " text-decoration-none text-secondary">
                                <i class = "fas fa-chevron-right me-1"></i> Home
                            </a>
                        </li>
                        <li class = "my-3">
                            <a href = "#" class = " text-decoration-none text-secondary">
                                <i class = "fas fa-chevron-right me-1"></i> Collection
                            </a>
                        </li>
                        <li class = "my-3">
                            <a href = "#" class = " text-decoration-none text-secondary">
                                <i class = "fas fa-chevron-right me-1"></i> Blogs
                            </a>
                        </li>
                        <li class = "my-3">
                            <a href = "#" class = " text-decoration-none text-secondary">
                                <i class = "fas fa-chevron-right me-1"></i> About Us
                            </a>
                        </li>
                    </ul>
                </div>

                <div class = "col-md-6 col-lg-3">
                    <h5 class = "fw-light mb-3">Contact Us</h5>
                    <div class = "d-flex justify-content-start align-items-start my-2 text-secondary">
                        <span class = "me-3">
                            <i class = "fas fa-map-marked-alt"></i>
                        </span>
                        <span class = "fw-light">
                            Albert Street, New York, AS 756, United States of America
                        </span>
                    </div>
                    <div class = "d-flex justify-content-start align-items-start my-2 text-secondary">
                        <span class = "me-3">
                            <i class = "fas fa-envelope"></i>
                        </span>
                        <span class = "fw-light">
                            attire.support@gmail.com
                        </span>
                    </div>
                    <div class = "d-flex justify-content-start align-items-start my-2 text-secondary">
                        <span class = "me-3">
                            <i class = "fas fa-phone-alt"></i>
                        </span>
                        <span class = "fw-light">
                            +9786 6776 236
                        </span>
                    </div>
                </div>

                <div class = "col-md-6 col-lg-3">
                    <h5 class = "fw-light mb-3">Follow Us</h5>
                    <div>
                        <ul class = "list-unstyled d-flex">
                            <li>
                                <a href = "#" class = "text-white text-decoration-none text-secondary fs-4 me-4">
                                    <i class = "fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a href = "#" class = "text-white text-decoration-none text-secondary fs-4 me-4">
                                    <i class = "fab fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href = "#" class = "text-white text-decoration-none text-secondary fs-4 me-4">
                                    <i class = "fab fa-instagram"></i>
                                </a>
                            </li>
                            <li>
                                <a href = "#" class = "text-white text-decoration-none text-secondary fs-4 me-4">
                                    <i class = "fab fa-pinterest"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end of footer -->



    <!-- jquery -->
    <script src = "js/jquery-3.6.0.js"></script>
    <!-- isotope js -->
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>
    <!-- custom js -->
    <script src = "js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>