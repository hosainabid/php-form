<?php

  // Connect to database
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "form";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $dob = $_POST["dob"];
  $ctc = $_POST["ctc"];
  $tech = implode(", ", $_POST["tech"]);
  

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
  // Create table 'employee' if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `ctc` float NOT NULL,
  `tech` varchar(255) NOT NULL
)";

  if ($conn->query($sql) === TRUE) {
    // echo "Table 'employee' created successfully";
  } else {
    echo "Error creating table: " . $conn->error;
  }

  $sql = "INSERT INTO employee (name, dob, ctc, tech)
  VALUES ('$name', '$dob', '$ctc', '$tech')";

  if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  $empl = "SELECT * FROM `employee`";
  $result = mysqli_query($conn, $empl);

// Fetch all
  mysqli_fetch_all($result, MYSQLI_ASSOC);

  // Free result set

  mysqli_close($conn);
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Employee Information Form</title>
</head>

 
<body>
<button id="addEmployeeBtn">Add Employee</button>

<div id="employeeForm" style="display:none;">
  <form method="post" id="employeeForm">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="dob">Date of Birth:</label>
    <input type="date" id="dob" name="dob" required><br><br>

    <label for="ctc">Current Salary:</label>
    <input type="text" id="ctc" name="ctc" required><br><br>

    <label for="tech">Experience Technology:</label>
    <input type="checkbox" id="tech1" name="tech[]" value="PHP">PHP
    <input type="checkbox" id="tech2" name="tech[]" value="JS">JS
    <input type="checkbox" id="tech3" name="tech[]" value="React">React<br><br>

    <input type="submit" value="Submit">
  </form>
</div>

    <script>
        document.getElementById("addEmployeeBtn").addEventListener("click", function(){
        document.getElementById("employeeForm").style.display = "block";
        });
    </script>


    <table id="employeeTable">
      <thead>
        <td>Name</td>
        <td>Date of Birth</td>
        <td>CTC</td>
        <td>Technology</td>
        <td>Action</td>
      </thead>
      <?php
       $conn = mysqli_connect($servername, $username, $password, $dbname);

       // Check connection
       if (!$conn) {
         die("Connection failed: " . mysqli_connect_error());
       }
       $sql = "SELECT * FROM `employee`";
       $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
          // Output data of each row
          while($row = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <th><?php echo $row["name"]; ?></th>
                <th><?php echo $row["dob"]; ?></th>
                <th><?php echo $row["ctc"]; ?></th>
                <th><?php echo $row["tech"]; ?></th>
                <th><a href="<?php echo '/form/edit.php?id=' . $row["id"] ?>">Edit</a></th>
              </tr>
             
          <?php
          }
      } else {
          echo "0 results";
      }

      ?>

    </table>
</body>

</html>