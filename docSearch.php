<?php
require "check_session.php";
check_session(false); // Init session
require "database.php"; // Init $pdo connection
require "convert_path.php"; // Means of navigating around website
// == Collect all resources associated with a given user ==
$user_id = $_SESSION['id'];
$sql = "SELECT * FROM resource;";
$stmt=$pdo->prepare($sql);
if($stmt->execute()){
    $user_resources = $stmt->fetchall();
    }
else{
    $error_msg = "Sorry, we failed to find any resources associated with this user...";
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
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Register</a>
          </li>
					<li class="nav-item">
							<a class="nav-link" href="docsharing.php">Document Upload</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="docSearch.php">Document Search<span class="sr-only">(current)</span></a>
					</li>
          <li class="nav-item">
            <a class="nav-link" href="/phpBB3">Forums</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="index.php" method="post">
          <input class="form-control mr-sm-2" type="email" placeholder="Email Address" aria-label="Search">
          <input class="form-control mr-sm-2" type="password" placeholder="Password" aria-label="Search">
          <button class="btn spectrumButton my-2 my-sm-0" type="submit">Login</button>
        </form>
      </div>
    </nav>

    <div class="container">
      <div class="row mb-3">
        <div class="col-sm-12">
          <h3>Browse previously shared documents here.</h3>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <table class="table table-striped">
            <thead class="thead-light">
              <tr>
                  <th scope="col">Resource Name</th>
                  <th scope="col">Download Size</th>
                  <th scope="col">File Type</th>
                  <th scope="col">Created On</th>
                  <th scope="col">Created By</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if($user_resources){
                  foreach($user_resources as $resource){
                      echo "<tr>\n";
                      echo "<th>".$resource['fileName']."</th>\n";
                      echo "<th>".$resource['fileSize']."</th>\n";
                      echo "<th>".$resource['fileType']."</th>\n";
                      echo "<th>".$resource['createdAt']."</th>\n";
                      echo "<th>".$resource['firstName']." ".$resource['lastName']."</th>\n";
                      echo "<th><form method='get' action='".convert_path($resource['filePath'], true)."'><button type='submit'>Download</button></form></th>";
                      echo "</tr>";
                  }
              }
              else{
                  echo "<tr><th>".$error_msg."</th></tr>";
              }
              ?>
            </tbody>
          </table>

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
