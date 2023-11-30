<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My favorite things</title>
  <meta name="description" content="Your page description">
  <link rel="stylesheet" href="./css/generalStyle.css">
  <link rel="icon" href="./img/favicon.png" type="image/x-icon">

</head>

<body>
  <?php require('./inc/header.php'); ?>
  <main class="container">
    <section class="form-row row">
      <div class="col-sm-12 col-md-6 col-lg-6 col-container">
        <h2>Don't have an account? Sign up below!</h2>
        <form method="post" action="save-admin.php">
          <p><input class="form-control" name="first_name" type="text" placeholder="First Name" required /></p>
          <p><input class="form-control" name="last_name" type="text" placeholder="Last Name" required /></p>
          <p><input class="form-control" name="username" type="text" placeholder="Username" required /></p>
          <p><input class="form-control" name="password" type="password" placeholder="Password" required /></p>
          <p><input class="form-control" name="confirm" type="password" placeholder="Confirm Password" required /></p>
          <input class="btn btn-light" type="submit" name="submit" value="Register" />
        </form>
      </div>
      <div class="col-sm-12 col-md-6 col-lg-6 col-container">
        <h2>Already have an account? Sign in below!</h2>
        <form method="post" action="./inc/validate.php">
          <p><input class="form-control" name="username" type="text" placeholder="Username" required /></p>
          <p><input class="form-control" name="password" type="password" placeholder="Password" required /></p>
          <input class="btn btn-light" type="submit" value="Login" />
        </form>
      </div>


      <?php
      // Include database file
      include 'database.php';
      // Delete record from table
      if (!empty($_GET['deleteId'])) {
        $deleteId = $_GET['deleteId'];
        $customerObj->deleteRecord($deleteId);
      }
      ?>

      <div class="notlogged col-container">
        <h2>Don't want to login? Click the button below and let's see who is waiting for you!</h2>
        <a href="notloggedview.php" class="btn btn-light">Meet your friends</a>
      </div>
    </section>
  </main>
  <!-- Let's add our footer file. -->
  <?php require('./inc/footer.php'); ?>
</body>

</html>