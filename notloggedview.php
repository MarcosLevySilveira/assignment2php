<?php
  // Include database file
  include 'database.php';
  // Delete record from table
  if(!empty($_GET['deleteId'])) {
    $deleteId = $_GET['deleteId'];
    $customerObj->deleteRecord($deleteId);
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD With PHP</title>
    <meta name="description" content="View page">
    <!--  Add our Google fonts  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&family=Roboto:ital,wght@0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
    <!--  Add our Bootstrap  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!--  Add our custom CSS  -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" href="./css/generalStyle.css">
    <link rel="icon" href="./img/favicon.png" type="image/x-icon">
  </head>
  <body>
  <header>
  <?php require './inc/header.php';?>
  </header>
  <main class="container">
    <?php
      if (isset($_GET['msg1']) == "insert") {
      echo "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert'>×</button>
              Your Registration added successfully
            </div>";
      }
      if (isset($_GET['msg2']) == "update") {
        echo "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert'>×</button>
              Your Registration updated successfully
            </div>";
      }
      if (isset($_GET['msg3']) == "delete") {
       echo "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert'>×</button>
              Record deleted successfully
            </div>";
      }
    ?>
    <section>
      <h2>Meet your new friends!</h2>
      <div class="table-container">
      <table class="table table-hover table-dark table-striped">
        <thead>
        <tr>
         
          <th>Name</th>
          <th>Gender</th>
          <th>Email</th>
          <th>Country</th>
          <th>Birth Date</th>
          <th>Languages I use</th>
          <th>Favorite Song</th>
          <th>Favorite Movie</th>
          <th>Picture</th>
        </tr>
        </thead>
        <tbody>
        <?php
       // 
       
        $customers = $customerObj->displayData();
        if ($customers!=null){
        foreach ($customers as $customer) {
        //  
          ?>
          <tr>
            <td><?php echo $customer['name'] ?></td>
            <td><?php echo $customer['gender'] ?></td>
            <td><?php echo $customer['email'] ?></td>
            <td><?php echo $customer['country'] ?></td>
            <td><?php echo $customer['birthdate'] ?></td>
            <td><?php echo $customer['programmingLanguages'] ?></td>
            <td><?php echo $customer['favoriteSong'] ?></td> 
            <td><?php echo $customer['favoriteMovie'] ?></td>
            <td>
                <img src="<?php echo $customer['profilePicture'] ?>" alt="Profile Picture" width="180" height="100">
              </td>    
          </tr>
        <?php } }?>
        </tbody>
      </table>
        </div>
    </section>
</main>
<footer>
  <?php require './inc/footer.php';?>
</footer>
</body>
</html>