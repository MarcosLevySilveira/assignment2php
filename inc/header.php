<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>
  <meta name="description" content="Home page.">
  <!-- add Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
  
  <style>
  body, html {
  height: 100%;
  margin: 0;
  display: flex;
  flex-direction: column;
}

header {
  width: 100%;
  height: 100px;
  background: linear-gradient(225deg, rgba(235, 220, 4, 0.918) 0%, #75c02b 100%);
  display: flex;
  align-items: center;
  justify-content: center;
}

header .container-fluid {
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
}

header h1 {
  font-size: 3.5em;
  color: #f4f4f4;
}

nav {
  display: flex;
}

ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
  display: flex;
}

li {
  margin-right: 15px;
}

a {
  text-decoration: none;
  color: white;
}

/* Hide the list by default */
ul {
  display: none;
}

/* Show the list when the container is hovered */
header .container-fluid:hover ul {
  display: flex;
}</style>
</head>

<body>
  <header>
    <div class="container-fluid">
    <h1> My Favorite Things </h1>
      <nav>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="add.php">Create Profile</a></li>
          <li><a href="view.php">View Profiles</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav>
    </div>
  </header>
</body>
</html>