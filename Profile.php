<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js" integrity="sha512-pUhApVQtLbnpLtJn6DuzDD5o2xtmLJnJ7oBoMsBnzOkVkpqofGLGPaBJ6ayD2zQe3lCgCibhJBi4cj5wAxwVKA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="./css/main.css?v=<?php echo time(); ?>">

    <?php    session_start();
           // Check if the user is logged in
           if(!isset($_SESSION['id'])) {
            // Redirect the user to the login page
            header("Location:http://localhost/Library/land-page.php");
            exit;
          }
  ?>


    <style>
      /* .bd-placeholder-img {
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
      } */
    </style>
  </head>
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
                        <a class = "nav-link text-uppercase text-dark" href = "./land-page.php">about us</a>
                    </li>
                    <!-- <li class = "nav-item px-2 py-2 border-0">
                        <a class = "nav-link text-uppercase text-dark" href = "#popular">popular</a>
                    </li> -->
                </ul>
            </div>
        </div>
    </nav>

<section id = "collection">
<div class="container-fluid mt-5">
  <div class="row">
  <!-- <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./Profile.php">
              <span data-feather="home" class="align-text-bottom"></span>
              My Profile
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./Member-Listings.php">
              <span data-feather="file" class="align-text-bottom"></span>
              My Listings
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./New announcement.php">
              <span data-feather="file" class="align-text-bottom"></span>
              New Listing
            </a>
          </li>
        </ul>
      </div>
    </nav> -->

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Profile</h1>
      </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                            <div class="content">
                            <?php
                                  $servername = "localhost";
                                  $username = "root";
                                  $password = "";
                                  $dbname = "library";

                                  try {
                                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                      // User input
                                      $A_nom = filter_var($_POST['A_nom'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                                      $A_adresse = filter_var($_POST['A_adresse'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                                      $A_email = filter_var($_POST['A_email'], FILTER_SANITIZE_EMAIL);
                                      $A_phone = filter_var($_POST['A_phone'], FILTER_SANITIZE_NUMBER_INT);
                                      $old_password = filter_var($_POST['old_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                                      $new_password = filter_var($_POST['new_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                                      // Get the user's information from the database
                                      $query = "SELECT * FROM adhérent WHERE A_id = :id";
                                      $stmt = $conn->prepare($query);
                                      $stmt->bindParam(':id', $_SESSION['id']);
                                      $stmt->execute();
                                      $result = $stmt->fetch(PDO::FETCH_ASSOC);

                                      // Verify old password and update the user's password if new password is set
                                      if ($new_password !== '') {
                                        if (password_verify($old_password, $result['A_pass'])) {
                                          $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                                          $query = "UPDATE adhérent SET A_pass = :new_password_hash WHERE A_id = :id";
                                          $stmt = $conn->prepare($query);
                                          $stmt->bindParam(':id', $_SESSION['id']);
                                          $stmt->bindParam(':new_password_hash', $new_password_hash);
                                          $stmt->execute();
                                          $password_success_message = 'Your password has been updated.';
                                        } else {
                                          $password_error_message = 'Invalid old password.';
                                        }
                                      }

                                          // Update the user's information in the database
                                         $query = "UPDATE adhérent SET A_nom = :A_nom, A_adresse = :A_adresse, A_email = :A_email, A_phone = :A_phone WHERE A_id = :id";
                                         
                                        //  $stmt = $conn->prepare($query);
                                        //  $stmt->bindParam(':id', $_SESSION['id']);
                                        //  $stmt->bindParam(':A_nom', isset($A_nom) ? $result['A_nom'] : $A_nom);
                                        //  $stmt->bindParam(':A_adresse', isset($A_adresse) ? $result['A_adresse'] : $A_adresse);
                                        //  $stmt->bindParam(':A_email', isset($A_email) ? $result['A_email'] : $A_email);
                                        //  $stmt->bindParam(':A_phone', isset($A_phone) ? $result['A_phone'] : $A_phone);

                                          $AAA = empty($A_nom) ? $result['A_nom'] : $A_nom;
                                          $BBB = empty($A_adresse) ? $result['A_adresse'] : $A_adresse;
                                          $CCC = empty($A_email) ? $result['A_email'] : $A_email ;
                                          $DDD = empty($A_phone) ? $result['A_phone'] : $A_phone ;
                                          $stmt = $conn->prepare($query);
                                          $stmt->bindParam(':id', $_SESSION['id']);
                                          $stmt->bindParam(':A_nom', $AAA );
                                          $stmt->bindParam(':A_adresse', $BBB );
                                          $stmt->bindParam(':A_email', $CCC );
                                          $stmt->bindParam(':A_phone', $DDD );

                                           // Update the user's information in the database
                                          //  $query = "UPDATE adhérent SET A_nom = :A_nom, A_adresse = :A_adresse, A_email = :A_email, A_phone = :A_phone WHERE A_id = :id";
                                          //  $stmt = $conn->prepare($query);
                                          //  $stmt->bindParam(':id', $_SESSION['id']);
                                          //  $stmt->bindParam(':A_nom', $A_nom);
                                          //  $stmt->bindParam(':A_adresse', $A_adresse);
                                          //  $stmt->bindParam(':A_email', $A_email);
                                          //  $stmt->bindParam(':A_phone', $A_phone);
     
                                           if ($stmt->execute()) {
                                             $profile_success_message = 'Your profile has been updated.';
                                           } else {
                                             $profile_error_message = 'Error updating profile.';
                                           }
                                        }

                                        // $query = "UPDATE adhérent SET ";
                                        // $params = array();

                                        // if (!empty($A_nom)) {
                                        //   $query .= "A_nom = :A_nom, ";
                                        //   $params[':A_nom'] = $A_nom;
                                        // }

                                        // if (!empty($A_adresse)) {
                                        //   $query .= "A_adresse = :A_adresse, ";
                                        //   $params[':A_adresse'] = $A_adresse;
                                        // }

                                        // if (!empty($A_email)) {
                                        //   $query .= "A_email = :A_email, ";
                                        //   $params[':A_email'] = $A_email;
                                        // }

                                        // if (!empty($A_phone)) {
                                        //   $query .= "A_phone = :A_phone, ";
                                        //   $params[':A_phone'] = $A_phone;
                                        // }

                                        // $query = rtrim($query, ', ') . " WHERE A_id = :id";
                                        // $params[':id'] = $_SESSION['id'];

                                        // $stmt = $conn->prepare($query);
                                        // if ($stmt->execute($params)) {
                                        //   $profile_success_message = 'Your profile has been updated.';
                                        // } else {
                                        //   $profile_error_message = 'Error updating profile.';
                                        // }


                                    // Get the user's information from the database
                                    $query = "SELECT * FROM adhérent WHERE A_id = :id";
                                    $stmt = $conn->prepare($query);
                                    $stmt->bindParam(':id', $_SESSION['id']);
                                    $stmt->execute();
                                    $user_info = $stmt->fetch(PDO::FETCH_ASSOC);
                                  } catch(PDOException $e) {
                                    echo "Connection failed: " . $e->getMessage();
                                  }

                                  // Close the database connection
                                  $conn = null;
                                  ?>
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <input type="text" name="A_nom" class="form-control border-input" placeholder="<?php echo $user_info['A_nom']; ?>" value="" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" name="A_email" class="form-control border-input" placeholder="<?php echo $user_info['A_email']; ?>" value="" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone number</label>
                                                <input type="tel" name="A_phone" class="form-control border-input" placeholder="<?php echo $user_info['A_phone']; ?>" value="" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-12">
                                      <label for="validationCustom03" class="form-label">Details</label>
                                      <textarea name="A_adresse" placeholder="<?php echo $user_info['A_adresse']; ?>" type="text" class="form-control" id="validationCustom03" disabled></textarea>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Old Password</label>
                                                <input type="password" name="old_password" class="form-control border-input" placeholder="" value="" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>New Password</label>
                                                <input type="password" name="new_password" class="form-control border-input" placeholder="" value="" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-5">
                                        <button type="button" id="update-btn" class="btn btn-secondary btn-fill btn-wd">Update Profile</button>
                                        <button type="submit" id="save-btn" class="btn btn-secondary btn-fill btn-wd" style="display: none;">Update Profile</button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Delete Account</button>
                                        </button>

                                    </div>
                                </form>
                            

                            </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
 </div>
</section>
      <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       Your account will be deleted, are you sure you want to delete this account?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="delete-btn" class="btn btn-danger btn-fill btn-wd"> <a href="./delete-account.php" style="text-decoration : none; color: #fff; ">Delete Profile</a></button>
      </div>
    </div>
  </div>
</div>
    </main>
  </div>
</div>
      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
      <script>
        
 // Get the input fields and update button
const inputs = document.querySelectorAll('input, textarea');
const updateBtn = document.getElementById('update-btn');
const saveBtn = document.getElementById('save-btn');

// Disable the input fields by default
inputs.forEach(input => {
  input.disabled = true;
});

// Enable the input fields when the user clicks the update button
updateBtn.addEventListener('click', () => {
  inputs.forEach(input => {
    input.disabled = false;
  });
  updateBtn.style.display = 'none';
  saveBtn.style.display = 'inline-block';
});


</script>
</body>
</html>
