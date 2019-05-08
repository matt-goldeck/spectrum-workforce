
<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require "upload_resource.php";
    require "database.php";

    $result = upload_resource($pdo);

    echo $result; // Success or fail message.
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
							<a class="nav-link" href="docsharing.php">Document Upload<span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="docSearch.php">Document Search</a>
					</li>
          <li class="nav-item">
            <a class="nav-link" href="/phpBB3">Forums</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="email" placeholder="Email Address" aria-label="Search">
          <input class="form-control mr-sm-2" type="password" placeholder="Password" aria-label="Search">
          <button class="btn spectrumButton my-2 my-sm-0" type="submit">Login</button>
        </form>
      </div>
    </nav>

    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h2>Upload Documents Here</h2>

          <form action="docsharing.php" method="post" autocomplete="on" enctype="multipart/form-data">
            <div class="form-row">
              <div class="col form-group">
                <label for="fileName">File Name</label>
                <input type="text" name="fileName" id="fileName" placeholder="File Name">
              </div>
            </div>

            <div class="form-row">
              <div class="col form-group">
                <label for="uploadFile">Choose a file to upload</label>
                <input class="form-control-file" type="file" name="uploadFile" id="uploadFile" required>
              </div>
            </div>

            <div class="form-row mb-3">
              <div class="col">
                <button type="submit" class="btn btn-primary spectrumButton" name="submit">Submit</button>
              </div>
            </div>
          </form>
          <p>Acceptible file types include jpg/jpeg, png, gif, pdf, mp3, mp4 and mov.</p>
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
