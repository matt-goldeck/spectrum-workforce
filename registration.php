<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require "register_user.php";
    register_user();
}
?>

<!DOCTYPE html>
<!-- Incomplete HTML; just a template for the registration form -->
<!-- NOTE: Input name fields added -->

<html>
<div class="container">
      <div class="row my-3">
        <div class="col-sm-12">
          <h2 class="mb-2">Register Here</h2>
          <form class="" action="registration.php" method="post" autocomplete="on">
            <div class="form-row">
              <div class="col">
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name">
              </div>
              <div class="col">
                <label for="midInit">Middle Initial</label>
                <input type="text" class="form-control" id="midInit" name="midInit" placeholder="Middle Initial">
              </div>
              <div class="col">
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name">
              </div>
            </div>

            <div class="form-row my-3">
              <div class="col">
                <label for="emailAddress">Email Address</label>
                <input type="email" class="form-control" id="emailAddress" name="emailAddress" placeholder="user@email.com">
              </div>
              <div class="col">
                <label for="password1">Password</label>
                <input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
              </div>
              <div class="col">
                <label for="password2">Confirm Password</label>
                <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirm Password">
              </div>
            </div>

            <div class="form-row my-3">
              <div class="col">
                <label for="userType">User Type</label>
                <select name ="userType" id="userType" class="custom-select">
                  <option selected>Select a user type</option>
                  <option value="Employee">Spectrum Works Employee</option>
                  <option value="Student">Spectrum Works Student</option>
                  <option value="Individual">Other Individual</option>
                  <option value="Business">Other Business</option>
                </select>
              </div>
            </div>

            <div class="form-row my-3">
              <div class="col">
                <label for="address1">Street Address</label>
                <input type="text" class="form-control" id="address1" name="address1" placeholder="Street Address">
              </div>
              <div class="col">
                <label for="address2">Unit / Apartment Number</label>
                <input type="text" class="form-control" id="address2" name= "address2" placeholder="Unit Number">
              </div>
            </div>

            <div class="form-row my-3">
              <div class="col">
                <label for="city">City</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="City">
              </div>
              <div class="col">
                <label for="state">State</label>
                   <select class="custom-select" id="state" name="state">
                     <option selected>Select your state or territory</option>
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
                     <option value="Wyoming">Wyoming</option></select>
              </div>
              <div class="col">
                <label for="zip">Zip Code</label>
                <input type="number" class="form-control" id="zip" name="zip" placeholder="12345">
              </div>
            </div>

            <div class="form-row my-3">
              <div class="col">
                <label for="phone">Phone Number, Format: 123-456-7890</label>
                <input type="tel" class="form-control" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="Phone Number">
              </div>
              <div class="col">
                <label for="phoneType">Phone Type</label>
                <select class="custom-select" id="phoneType" name="phoneType">
                  <option selected>Select a phone type</option>
                  <option value="Mobile">Mobile</option>
                  <option value="Home">Home</option>
                  <option value="Work">Work</option>
                  <option value="Other">Other</option>
                </select>
              </div>
            </div>

            <div class="form-row my-3">
              <div class="col">
                <button type="submit" class="btn btn-primary spectrumButton" name="submit">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
</html>