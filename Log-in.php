<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap Site</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js" defer></script>

  <style>
    .card-registration .select-input.form-control[readonly]:not([disabled]) {
      font-size: 1rem;
      line-height: 2.15;
      padding-left: .75em;
      padding-right: .75em;
    }

    .card-registration .select-arrow {
      top: 13px;
    }

    body {
      background-color: #55595c;
    }
  </style>
</head>

<body>
  <form class="h-100" action="" method="post">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col">
          <div class="card card-registration my-4">
            <div class="row g-0">
              <div class="col-xl-6 d-none d-xl-block">
                <img src="./images/pexels-ivo-rainha-1261180.jpg" alt="Sample photo" class="img-fluid" style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
              </div>
              <div class="col-xl-6">
                <div class="card-body p-md-5 text-black mt-5">
                  <a href="./land-page.php" class="navbar-brand d-flex align-items-center">
                    <img src="./images/Screenshot (8).png" alt="" srcset="" width="100%" class="position-relative top-0 start-50 translate-middle pt-5">
                  </a>
                  <h3 class="mb-5 text-center">Log In</h3>

                  <div class="form-outline mb-4">
                    <input type="email" id="Email_Inp" class="form-control form-control-lg" name="email" required>
                    <label class="form-label" for="Email_Inp">Email</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="Password_Inp" class="form-control form-control-lg" name="password" required>
                    <label class="form-label" for="Password_Inp">Password</label>
                  </div>

                  <div class="d-flex justify-content-end pt-3">
                    <button type="submit" class="btn btn-danger btn-block">Log In</button>
                  </div>


                  <div class="text-center mt-3 small">
                    Don't have an account? <a href="./signup.php">Sign Up</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
  <?php


  if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];


    try {
      $conn = new PDO("mysql:host=localhost;dbname=library;port=3306;charset=UTF8", 'root', '');


      $stmt1 = $conn->query("SELECT * FROM `adhérent` WHERE  `A_email`='$email '");
      $stmt2 = $conn->query("SELECT * FROM `adhérent` WHERE  `A_pass`='$password'");

        $emailLigne=$stmt1->fetch();
        $passLigne=$stmt2->fetch();
      

      if (!$emailLigne) {
        $erroremail = " email incorrect.";
        echo "<div style='background-color: #55595c ;color:red'>" . $erroremail . " </div>";
        
      } elseif (!$passLigne && !password_verify($password, $emailLigne["A_pass"])) {
        $error = " mot de passe incorrect.";
        echo "<div style='background-color: #55595c ;color:red'>" . $error . "</div>";
      } else {
        session_start();
                // $_SESSION['user'] = $emailLigne['Nom_M']." ".$emailLigne['Prenom_M'];
                $_SESSION['id'] = $emailLigne['A_id'];
        echo "in";

        header("Location:http://localhost/Library/member.php");
      }
    } catch (PDOException $e) {
      $errorMessage = "Error:" . $e->getMessage();
    }
  }
  ?>


</body>

</html>