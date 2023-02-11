<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "form";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT id, name, dob, ctc, tech FROM employee";
$result = mysqli_query($conn, $sql);

$employee = array();
if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    $employee[] = $row;
  }
}

mysqli_close($conn);

echo json_encode($employee);
?>
