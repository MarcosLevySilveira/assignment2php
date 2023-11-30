<?php
class database
{
  private $servername = "localhost";
  private $username = "root";
  private $password = "";
  private $database = "mydb";
  public $con;


  // Database Connection
  public function __construct()
  {
    $this->con = new mysqli($this->servername, $this->username, $this->password, $this->database);
    if (mysqli_connect_error()) {
      die("Failed to connect to MySQL: " . mysqli_connect_error());
    }
  }

  // Insert customer data into customer table
  public function insertData($name, $gender, $email, $country, $profilePicture, $birthdate, $programmingLanguages, $favoriteSong, $favoriteMovie)
  {

    // Convert programmingLanguages array to a comma-separated string
    $programmingLanguagesString = implode(', ', $programmingLanguages);

    $query = "INSERT INTO customers1(name,gender,email,country,profilePicture, birthdate, programmingLanguages, favoriteSong, favoriteMovie) VALUES('$name','$gender','$email','$country','$profilePicture', '$birthdate', '$programmingLanguagesString', '$favoriteSong', '$favoriteMovie')";
    $sql = $this->con->query($query);
    if ($sql == true) {
      if (!headers_sent()) {
        header("Location: view.php?msg1=insert");
        exit(); // Exit to avoid any further output
      } else {
        echo '<script>window.location.href = "view.php?msg1=insert";</script>';
        exit();
      }
    } else {
      echo "Registration failed, try again!";
    }
  }

  // Fetch customer records for show listing
  public function displayData()
  {
    $query = "SELECT * FROM customers1";
    $result = $this->con->query($query);
    if ($result->num_rows > 0) {
      $data = array();
      while ($row = $result->fetch_assoc()) {
        $data[] = $row;
      }
      return $data;
    } else {
      echo "No found records";
    }
  }

  // Fetch single data for edit from customer table
  public function displayRecordById($id)
{
    $query = "SELECT id, name, gender, email, country, profilePicture, birthdate, programmingLanguages, favoriteSong, favoriteMovie FROM customers1 WHERE id = '$id'";
    $result = $this->con->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row;
    }
}

  // Update customer data into customer table
  public function updateRecord($uname, $ugender, $uemail, $ucountry, $targetPath, $ubirthdate, $uprogrammingLanguages, $ufavoriteSong, $ufavoriteMovie, $id)
  {
      // Convert programmingLanguages string to an array
      $uprogrammingLanguagesArray = explode(',', $uprogrammingLanguages);
  
      // Remove leading and trailing whitespaces from each element
      $uprogrammingLanguagesArray = array_map('trim', $uprogrammingLanguagesArray);
  
      // Convert the array back to a comma-separated string
      $uprogrammingLanguagesString = implode(', ', $uprogrammingLanguagesArray);
  
      $query = "UPDATE customers1 SET name = '$uname', gender = '$ugender', email = '$uemail', country = '$ucountry', profilePicture = '$targetPath', 
      birthdate = '$ubirthdate', programmingLanguages = '$uprogrammingLanguagesString', favoriteSong = '$ufavoriteSong', favoriteMovie = '$ufavoriteMovie' WHERE id = '$id'";
      
      $sql = $this->con->query($query);
      if ($sql == true) {
          if (!headers_sent()) {
              header("Location:view.php?msg2=update");
              exit(); // Exit to avoid any further output
          } else {
              echo '<script>window.location.href = "view.php?msg2=update";</script>';
              exit();
          }
      } else {
          echo "Registration update failed. Please try again!";
          exit();
      }
  }

  // Delete customer data from customer table
  public function deleteRecord($id)
  {
    $query = "DELETE FROM customers1 WHERE id = '$id'";
    $sql = $this->con->query($query);
    if ($sql == true) {
      header("Location:view.php?msg3=delete");
    } else {
      echo "Record does not delete try again";
    }
  }

  public function getDb()
  {
    return $this->con;
  }

  public function isNameExists($name)
  {
    $stmt = $this->con->prepare("SELECT COUNT(*) FROM customers1 WHERE name = ?");
    $stmt->bind_param('s', $name);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    return ($count > 0);
  }

}
$customerObj = new database();