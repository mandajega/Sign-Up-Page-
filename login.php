<?php
if (isset($_POST['login'])) {
  // Retrieve the form data
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Perform your validation logic here
  // You can query the database to check if the credentials are valid
  // Replace the database connection details with your own
  $servername = "localhost";
  $username = "root";
  $password_db = "";
  $database = "momandme";

  // Create a database connection
  $conn = new mysqli($servername, $username, $password_db, $database);

  // Check for connection errors
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Prepare and execute a query to validate the credentials
  $stmt = $conn->prepare("SELECT * FROM acclogin WHERE email = ? AND password = ?");
  $stmt->bind_param("ss", $email, $password);
  $stmt->execute();
  $result = $stmt->get_result();

  // Check if a row is returned
  if ($result->num_rows == 1) {
    // Credentials are valid
    // Redirect to the user's dashboard or a success page
    header("Location: dashboard.php");
    exit();
  } else {
    // Credentials are invalid
    // Redirect back to the login page with an error message
    header("Location: login.html?error=invalid_credentials");
    exit();
  }

  // Close the database connection
  $stmt->close();
  $conn->close();
}
?>
