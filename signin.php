<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sign In - My Favorite Things</title>
  <meta name="description" content="Sign in to explore your favorite things">
  <link rel="stylesheet" href="./css/signin.css">
  <link rel="icon" href="./img/favicon.png" type="image/x-icon">
</head>

<body>
  <?php require('./inc/header.php'); ?>

  <main class="container">
    <section class="row signin-row">
      <div class="col align-self-center">
        <h3>Insert your Username and Password to login</h3>
        <form method="post" action="./inc/validate.php">
          <p><input class="form-control" name="username" type="text" placeholder="Username" required /></p>
          <p><input class="form-control" name="password" type="password" placeholder="Password" required /></p>
          <input class="btn btn-light" type="submit" value="Login" />
        </form>
      </div>
    </section>
  </main>

  <?php require('./inc/footer.php'); ?>
</body>

</html>
