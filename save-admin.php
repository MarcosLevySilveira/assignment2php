<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Registration</title>
    <!-- Add your additional head elements, such as stylesheets or scripts -->
    <link rel="stylesheet" href="./css/saveAdmin.css">
    <link rel="icon" href="./img/favicon.png" type="image/x-icon">
</head>
<body>

<header>
    <!-- Add your header content here -->
    <?php require './inc/header.php';?>
</header>

<main class="centered">
    <?php
    // connection
    require './inc/database.php';
    // variables
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    // validate inputs
    $ok = true;

    if (empty($first_name)) {
        echo '<p>First name required</p>';
        $ok = false;
    }
    if (empty($last_name)) {
        echo '<p>Last name required</p>';
        $ok = false;
    }
    if (empty($username)) {
        echo '<p>Username required</p>';
        $ok = false;
    }
    if ((empty($password)) || ($password != $confirm)) {
        echo '<p>Invalid passwords</p>';
        $ok = false;
    }

    // check if username already exists
    $stmt = $conn->prepare("SELECT COUNT(*) FROM admins WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        echo '<p>Username already exists</p>';
        echo '<button class="btn btn-light" onclick="location.href=\'./index.php\'">Go back to Index</button>';
        $ok = false;
    }

    // decide if we are saving or not
    if ($ok){
        $password = hash('sha512', $password);
        // set up the sql
        $sql = "INSERT INTO admins (first_name, last_name, username, password) 
        VALUES ('$first_name', '$last_name', '$username', '$password');";
        $conn->exec($sql);
        echo '<section class="success-row">';
        echo '<div>';
        echo '<h3>Admin Saved</h3>';
        echo '</div>';
        echo '</section>';
        header("Location: signin.php"); 
    }
    ?>
</main>

<footer>
    <!-- Add your footer content here -->
    <?php require './inc/footer.php';?>
</footer>

</body>
</html>
