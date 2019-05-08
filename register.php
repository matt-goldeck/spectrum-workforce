
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require "register_user.php";
    register_user();
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
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="register.php">Register<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
							<a class="nav-link" href="docsharing.php">Document Upload</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="docSearch.php">Document Search</a>
					</li>
          <li>
            <a class="nav-link" href="/phpBB3">Forums</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Username" aria-label="Search">
          <input class="form-control mr-sm-2" type="password" placeholder="Password" aria-label="Search">
          <button class="btn spectrumButton my-2 my-sm-0" type="submit">Login</button>
        </form>
      </div>
    </nav>

    <!-- Registration Form  -->
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h2 class="mb-2">Register Here</h2>

          <form action="register.php" method="post" autocomplete="on">

            <div class="form-row">
              <div class="col form-group">
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" required>
              </div>

              <div class="col form-group">
                <label for="midInit">Middle Initial</label>
                <input type="text" class="form-control" id="midInit" name="midInit" placeholder="Middle Initial">
              </div>

              <div class="col form-group">
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" required>
              </div>
            </div>

            <div class="form-row">
              <div class="col form-group">
                <label for="emailAddress">Email Address</label>
                <input type="email" class="form-control" name="emailAddress" id="emailAddress" placeholder="user@mail.com" required>
              </div>

              <div class="col form-group">
                <label for="password1">Password</label>
                <input type="password" class="form-control" name="password1" id="password1" placeholder="Password" required>
              </div>

              <div class="col form-group">
                <label for="password2">Confirm Password</label>
                <input type="password" class="form-control" name="password2" id="password2" placeholder="Confirm Password" required>
              </div>
            </div>

            <div class="form-row">
              <div class="col form-group">
                <label for="userType">User Type</label>
                <select class="custom-select" name="userType" id="userType" required>
                  <option disabled selected>Select a user type</option>
                  <option value="Employee">Spectrum Works Employee</option>
                  <option value="Student">Spectrum Works Student</option>
                  <option value="Individual">Other Individual</option>
                  <option value="Business">Other Business</option>
                </select>
              </div>
            </div>

            <div class="form-row">
              <div class="col form-group">
                <label for="address1">Street Address</label>
                <input type="text" class="form-control" name="address1" id="address1" placeholder="Street Address" required>
              </div>

              <div class="col form-group">
                <label for="address2">Unit / Apartment Number</label>
                <input type="text" class="form-control" name="address2" id="address2" placeholder="Unit Number">
              </div>
            </div>

            <div class="form-row">
              <div class="col form-group">
                <label for="city">City</label>
                <input type="text" class="form-control" name="city" id="city" placeholder="City">
              </div>

              <div class="col form-group">
                <label for="state">State</label>
                <select class="custom-select" id="state" name="state" required>
                  <option disabled selected>Select your state or territory</option>
                  <option value="Alabama">Alabama</option>
                  <option value="Alaska">Alaska</option>
                  <option value="Arizona">Arizona</option>
                  <option value="Arkansas">Arkansas</option>
                  <option value="California">California</option>
                  <option value="Colorado">Colorado</option>
                  <option value="Connecticut">Connecticut</option>
                  <option value="Delaware">Delaware</option>
                  <option value="District of Columbia">District of Columbia</option>
                  <option value="Florida">Florida</option>
                  <option value="Georgia">Georgia</option>
                  <option value="Guam">Guam</option>
                  <option value="Hawaii">Hawaii</option>
                  <option value="Idaho">Idaho</option>
                  <option value="Illinois">Illinois</option>
                  <option value="Indiana">Indiana</option>
                  <option value="Iowa">Iowa</option>
                  <option value="Kansas">Kansas</option>
                  <option value="Kentucky">Kentucky</option>
                  <option value="Louisiana">Louisiana</option>
                  <option value="Maine">Maine</option>
                  <option value="Maryland">Maryland</option>
                  <option value="Massachusetts">Massachusetts</option>
                  <option value="Michigan">Michigan</option>
                  <option value="Minnesota">Minnesota</option>
                  <option value="Mississippi">Mississippi</option>
                  <option value="Missouri">Missouri</option>
                  <option value="Montana">Montana</option>
                  <option value="Nebraska">Nebraska</option>
                  <option value="Nevada">Nevada</option>
                  <option value="New Hampshire">New Hampshire</option>
                  <option value="New Jersey">New Jersey</option>
                  <option value="New Mexico">New Mexico</option>
                  <option value="New York">New York</option>
                  <option value="North Carolina">North Carolina</option>
                  <option value="North Dakota">North Dakota</option>
                  <option value="Northern Marianas Islands">Northern Marianas Islands</option>
                  <option value="Ohio">Ohio</option>
                  <option value="Oklahoma">Oklahoma</option>
                  <option value="Oregon">Oregon</option>
                  <option value="Pennsylvania">Pennsylvania</option>
                  <option value="Puerto Rico">Puerto Rico</option>
                  <option value="Rhode Island">Rhode Island</option>
                  <option value="South Carolina">South Carolina</option>
                  <option value="South Dakota">South Dakota</option>
                  <option value="Tennessee">Tennessee</option>
                  <option value="Texas">Texas</option>
                  <option value="Utah">Utah</option>
                  <option value="Vermont">Vermont</option>
                  <option value="Virginia">Virginia</option>
                  <option value="Virgin Islands">Virgin Islands</option>
                  <option value="Washington">Washington</option>
                  <option value="West Virginia">West Virginia</option>
                  <option value="Wisconsin">Wisconsin</option>
                  <option value="Wyoming">Wyoming</option>
                </select>
              </div>

              <div class="col form-group">
                <label for="zip">Zip Code</label>
                <input type="number" class="form-control" name="zip" id="zip" placeholder="12345" required>
              </div>
            </div>

            <div class="form-row">
              <div class="col form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" class="custom-select" name="phone" id="phone" placeholder="(555) 123-4567" required>
              </div>

              <div class="col form-group">
                <label for="phoneType">Phone Type</label>
                <select class="custom-select" name="phoneType" id="phoneType" required>
                  <option value="Mobile">Mobile</option>
                  <option value="Home">Home</option>
                  <option value="Work">Work</option>
                  <option value="Other">Other</option>
                </select>
              </div>
            </div>

            <div class="form-row">
              <div class="col">
                <button type="submit" class="btn btn-primary spectrumButton" name="submit">Submit</button>
              </div>
            </div>
          </form>
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
