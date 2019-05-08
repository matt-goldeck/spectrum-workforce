
<?php
require_once "database.php";
$INDEX_PATH = "index.php";
// Init session
session_start();
// Define and init variables
$emailAddress = $password = "";
$username_err = $password_err = "";
// // Case 1: User already logged in
// if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
//
//   // == Redirect to index ==
//   header("location: ".$INDEX_PATH);
//   exit;
// }
// Case 2: Form submitted; user is trying to log in
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  // == Validate Form Fields ==
  if(empty(trim($_POST['emailAddress']))){
    $email_err = "Enter an email address...";
  }
  else{
    $emailAddress = trim($_POST['emailAddress']);
  }
  if(empty(trim($_POST['Password']))){
    $password_err = "Enter a password...";
  }
  else{
    $password = trim($_POST['Password']);
  }
  // == Perform Credentials Validation ==
  if(empty($email_err) && empty($password_err)){
    $sql = "SELECT id, emailAddress, password, userType FROM users WHERE emailAddress= ?";
    // = Check if emailAddress exists =
    if($stmt = $pdo->prepare($sql)){
      // Execute statement
      if($stmt->execute([$emailAddress])){
        // Store result
        $user_result = $stmt->fetchall();
        // = Check if a single result was returned (User Exists) =
        if(count($user_result) == 1) {
            if(password_verify($password, $user_result[0]['password'])){
              // Password is correct -> begin new session
              session_start();
              // Init new session
              $_SESSION['loggedin'] = true;
              $_SESSION['id'] = $user_result[0]['id'];
              $_SESSION['emailAddress'] = $user_result[0]['emailAddress'];
              $_SESSION['userType'] = $user_result[0]['userType'];

              // // Redirect user to dashboard
              // header("location: ".$INDEX_PATH);
              // exit;
            }
            // Password is incorrect
            else {
              $password_err = "Incorrect Password";
            }
        }
        // Email (user) doesn't exist
        else {
          $email_err = "No User Found With That Email Address";
        }
      }
      // Statement fails to execute
      else {
        echo "SQL Error... Contact an administrator!";
      }
    }
  }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="icon" href="images\puzzle.ico">
    <link rel="stylesheet" href="customStyles.css">
    <title>ETSWPD</title>
  </head>

  <body>
    <!--Navbar  -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="index.php"> <img src="images\SpectrumWorks logo small.png" alt="Spectrum Works Logo"> </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Register</a>
          </li>
					<li class="nav-item">
							<a class="nav-link" href="docsharing.php">Document Upload</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="docSearch.php">Document Search</a>
					</li>
          <li class="nav-item">
            <a class="nav-link" href="/phpBB3">Forums</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="index.php" method="post">
          <input class="form-control mr-sm-2" type="email" name="emailAddress" placeholder="Email Address" aria-label="Search">
          <input class="form-control mr-sm-2" type="password" name="Password" placeholder="Password" aria-label="Search">
          <button class="btn spectrumButton my-2 my-sm-0"  type="submit">Login</button>
        </form>
      </div>
    </nav>

        <!-- Jumbotron  -->
        <div class="jumbotron jumbotron-fluid">
          <div class="container">
            <h1 class="display-4">ETSWDP</h1>
            <p class="lead">The Educational Training System and Workforce Development Platform is a place where Spectrum Works employees and students, as well as community members can collaborate and communicate and work towards creating a better world for people on the autism spectrum.</p>
          </div>
        </div>

        <div class="container">

          <div class="row">
            <div class="col-md-4 my-2">
              <div class="card my-2 spectrumCard" style="width: 18rem; height: 100%;">
                <div class="card-body">
                  <h5 class="card-title">Share</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Upload important documents</h6>
                  <p class="card-text">The resource repository provides a place for sharing imporant documents, like student evaluation forms.</p>
                </div>
              </div>
            </div>

            <div class="col-md-4 my-2">
              <div class="card my-2 spectrumCard" style="width: 18rem; height: 100%;">
                <div class="card-body">
                  <h5 class="card-title">Develop</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Make it better</h6>
                  <p class="card-text">Collaborate with your peers to develop better educational and tracking tools.</p>
                </div>
              </div>
            </div>

            <div class="col-md-4 my-2">
              <div class="card my-2 spectrumCard" style="width: 18rem; height: 100%;">
                <div class="card-body">
                  <h5 class="card-title">Communicate</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Community Hubs</h6>
                  <p class="card-text">Use the community forums to share ideas with other community members.</p>
                </div>
              </div>
            </div>
          </div>

        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      </body>
    </html>
