<?php
// Include database file
include 'database.php';

// Edit customer record
if (!empty($_GET['editId'])) {
  $editId = $_GET['editId'];
  $customer = $customerObj->displayRecordById($editId);
  $programmingLanguagesArray = isset($customer['programming_languages']) ? explode(',', $customer['programming_languages']) : array();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Update your profile</title>
  <meta name="description" content="Update page">
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
            <div class="card-header bg-primary">
              <h4 class="text-white">Update Records</h4>
            </div>
            <div class="card-body bg-light">
              <form method="POST" enctype="multipart/form-data">

                <div class="form-group">
                  <label for="name">Name:</label>
                  <input type="text" class="form-control" name="uname" value="<?php echo $customer['name']; ?>"
                    required="">
                </div>
                <div class="form-group">
                  <label for="gender">Gender:</label>
                  <input type="text" class="form-control" name="ugender" value="<?php echo $customer['gender']; ?>"
                    required="">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" name="uemail" value="<?php echo $customer['email']; ?>"
                    required="">
                </div>
                <div class="form-group">
                  <label for="country">Country:</label>
                  <input type="text" class="form-control" name="ucountry" value="<?php echo $customer['country']; ?>"
                    required="">
                </div>
                <div class="form-group">
                  <label for="profilePicture">Picture:</label>
                  <input type="file" class="form-control" name="uprofilePicture" accept="image/*" required="">
                </div>
                <div class="form-group">
                  <label for="birthdate">Birthdate:</label>
                  <input type="date" class="form-control" name="ubirthdate"
                    value="<?php echo $customer['birthdate']; ?>" required="">
                </div>
                <div class="form-group">
                  <label for="programmingLanguages">Programming Languages I use:</label><br>
                  <?php
                  $programmingLanguagesArray = explode(',', $customer['programmingLanguages']);
                  ?>
                  <label><input type="checkbox" name="uprogrammingLanguages[]" value="java" <?php if (in_array('java', $programmingLanguagesArray))
                    echo 'checked'; ?>> Java</label>
                  <label><input type="checkbox" name="uprogrammingLanguages[]" value="python" <?php if (in_array('python', $programmingLanguagesArray))
                    echo 'checked'; ?>> Python</label>
                  <label><input type="checkbox" name="uprogrammingLanguages[]" value="php" <?php if (in_array('php', $programmingLanguagesArray))
                    echo 'checked'; ?>> PHP</label>
                  <label><input type="checkbox" name="uprogrammingLanguages[]" value="javascript" <?php if (in_array('javascript', $programmingLanguagesArray))
                    echo 'checked'; ?>> JavaScript</label>
                </div>
                <div class="form-group">
                  <label for="ufavoriteSong">Favorite Song:</label>
                  <input type="text" class="form-control" name="ufavoriteSong"
                    value="<?php echo $customer['favoriteSong']; ?>" required="">
                </div>
                <div class="form-group">
                  <label for="ufavoriteMovie">Favorite Movie:</label>
                  <input type="text" class="form-control" name="ufavoriteMovie"
                    value="<?php echo $customer['favoriteMovie']; ?>" required="">
                </div>
                <div class="form-group">
                  <input type="hidden" name="id" value="<?php echo $customer['id']; ?>">
                  <input type="submit" name="update" class="btn btn-light" style="float:right;" value="Update">
                </div>
              </form>
              <?php
              // Update Record in customer table
              if (!empty($_POST)) {
                $uname = $_POST['uname'];
                $ugender = $_POST['ugender'];
                $uemail = $_POST['uemail'];
                $ucountry = $_POST['ucountry'];
                $ubirthdate = $_POST['ubirthdate'];
                $uprogrammingLanguages = isset($_POST['uprogrammingLanguages']) ? implode(',', $_POST['uprogrammingLanguages']) : '';
                $ufavoriteSong = $_POST['ufavoriteSong'];
                $ufavoriteMovie = $_POST['ufavoriteMovie'];
                $uprofilePicture = $_FILES['uprofilePicture'];
                $uploadPath = "uploads/"; // Specify your upload directory
              
                // Check if file was uploaded without errors
                if ($uprofilePicture['error'] == 0) {
                  $filename = basename($uprofilePicture['name']);
                  $targetPath = $uploadPath . $filename;

                  // Move the uploaded file to the destination directory
                  move_uploaded_file($uprofilePicture['tmp_name'], $targetPath);
                } else {
                  echo "Error uploading file.";
                  // You may want to handle errors more gracefully
                }

                $id = $_POST['id'];
                $customerObj->updateRecord($uname, $ugender, $uemail, $ucountry, $targetPath, $ubirthdate, $uprogrammingLanguages, $ufavoriteSong, $ufavoriteMovie, $id);
              }
              ?>
            </div>
          </div>
        </div>
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