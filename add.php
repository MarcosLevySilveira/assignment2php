<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  // If not logged in, redirect to the login page
  header('Location: ./index.php');
  exit(); // Make sure to exit after a header redirect
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Create your profile</title>
  <meta name="description" content="Create your profile">
  <link rel="stylesheet" href="./css/forms.css">
  <link rel="icon" href="./img/favicon.png" type="image/x-icon">
</head>

<body>
  <header>
    <?php require('./inc/header.php'); ?>
  </header>
  <main>
    <section class="container">
      <div class="row">
        <div class="col-md-5 mx-auto">
          <div class="card">
            <div class="card-header bg-dark text-white">
              <h2>Input your data:</h2>
            </div>
            <div class="card-body bg-light">
              <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="name">Name:</label>
                  <input type="text" class="form-control" name="name" placeholder="Enter name" required="">
                </div>
                <div class="form-group">
                  <label for="gender">Gender:</label><br>
                  <label><input type="radio" name="gender" value="male" required=""> Male</label>
                  <label><input type="radio" name="gender" value="female" required=""> Female</label>
                  <label><input type="radio" name="gender" value="other" required=""> Other</label>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" name="email" placeholder="Enter email" required="">
                </div>
                <div class="form-group">
                  <label for="country">Country:</label>
                  <input type="text" class="form-control" name="country" placeholder="Enter country" required="">
                </div>
                <div class="form-group">
                  <label for="birthdate">Birthdate:</label>
                  <input type="date" class="form-control" name="birthdate" required="">
                </div>
                <div class="form-group">
                  <label for="programmingLanguages">Programming Languages I use:</label><br>
                  <label><input type="checkbox" name="programmingLanguages[]" value="java"> Java</label>
                  <label><input type="checkbox" name="programmingLanguages[]" value="python"> Python</label>
                  <label><input type="checkbox" name="programmingLanguages[]" value="php"> PHP</label>
                  <label><input type="checkbox" name="programmingLanguages[]" value="javascript"> JavaScript</label>
                </div>
                <div class="form-group">
                  <label for="favoriteSong">Favorite Song:</label>
                  <input type="text" class="form-control" name="favoriteSong" placeholder="Enter favorite song"
                    required="">
                </div>
                <div class="form-group">
                  <label for="favoriteMovie">Favorite Movie:</label>
                  <input type="text" class="form-control" name="favoriteMovie" placeholder="Enter favorite movie"
                    required="">
                </div>
                <div class="form-group">
                  <label for="profilePicture">Picture:</label>
                  <input type="file" class="form-control" name="profilePicture" accept="image/*" required="">
                </div>
                <input type="submit" name="submit" class="btn btn-light" style="float:right;" value="Submit">
              </form>
              <?php
              // Include database file
              require 'database.php';
              // Insert Record in customer table
              if (!empty($_POST)) {
                $name = $_POST['name'];
                $gender = $_POST['gender'];
                $email = $_POST['email'];
                $country = $_POST['country'];
                $birthdate = $_POST['birthdate'];
                $programmingLanguages = isset($_POST['programmingLanguages']) ? $_POST['programmingLanguages'] : [];
                $favoriteSong = $_POST['favoriteSong'];
                $favoriteMovie = $_POST['favoriteMovie'];
                // Handle image upload
                $profilePicture = $_FILES['profilePicture'];
                $uploadPath = "uploads/"; // Specify your upload directory       
                // Check if file was uploaded without errors
                if ($profilePicture['error'] == 0) {
                  $filename = basename($profilePicture['name']);
                  $targetPath = $uploadPath . $filename;
                  // Move the uploaded file to the destination directory
                  move_uploaded_file($profilePicture['tmp_name'], $targetPath);
                } else {
                  echo "Error uploading file.";
                  // You may want to handle errors more gracefully
                }
                // Insert data into the database
                $customerObj->insertData($name, $gender, $email, $country, $targetPath, $birthdate, $programmingLanguages, $favoriteSong, $favoriteMovie);
              }
              ?>
            </div>
          </div>
        </div>
      </div>
      <div class="button go-back-to-view">
        <a href="view.php" class="btn btn-light">Back to View</a>
      </div>
    </section>
  </main>
  <footer>
  <?php
  require './inc/footer.php';
  ?>
  </footer>
</body>

</html>