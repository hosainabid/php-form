<?php
// Get ID from URL
$id = $_GET['id'];
  // Connect to database
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

    if (isset($_POST['submit'])) {

        $name = $_POST["name"];
        $dob = $_POST["dob"];
        $ctc = $_POST["ctc"];
        $tech = implode(", ", $_POST["tech"]);
       
    
        $update = "UPDATE `employee` SET name='$name', dob='$dob', ctc='$ctc', tech='$tech' WHERE id=$id";
        if ($conn->query($update) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    
    }



// Fetch record from table 'from.employee' by ID
$sql = "SELECT * FROM `employee` WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Get record data
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $dob = $row['dob'];
    $ctc = $row['ctc'];
    $tech = $row['tech'];
} else {
    echo "0 results";
}
  
  mysqli_close($conn);




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Information Form</title>

    <style>
    body {
        margin: 0;
        padding: 0;
        max-width: 500px;
        margin: auto;
    }
    #employeeForm{
        padding: 20px 0;
      }
    #employeeForm label{
      font-size: 20px;
      font-family: tahoma;
      padding: 0px 15px;
    }

    #employeeForm input{
      font-size: 20px;
      font-family: tahoma;
      padding: 0px 15px;
    }
    #employeeForm input[type="submit"]{
      padding: 10px 20px;
      border-radius: 3px;
      color: #ffffff;
      background: #1abc9c;
      border: 0px solid;
      margin: 20px 15px;
      font-size: 18px;
      font-family: tahoma;
    }
    #employeeForm input[type="checkbox"]{
      font-size: 20px;
      font-family: tahoma;
      padding: 0px 15px;
    }
    </style>
</head>

 
<body>


<div id="employeeForm">
  <form method="POST" id="employeeForm">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $name; ?>" required><br><br>

    <label for="dob">Date of Birth:</label>
    <input type="date" id="dob" name="dob" value="<?php echo $dob; ?>" required><br><br>

    <label for="ctc">Current Salary:</label>
    <input type="text" id="ctc" name="ctc" value="<?php echo $ctc; ?>" required><br><br>

    <label for="tech">Experience Technology:</label>
    <?php
        $tech_arr = explode(', ', $tech);
    ?>
    <input type="checkbox" id="tech1" name="tech[]" <?php echo in_array('PHP', $tech_arr) ? 'checked' : ""; ?> value="PHP">PHP
    <input type="checkbox" id="tech2" name="tech[]" <?php echo in_array('JS', $tech_arr) ? 'checked' : ""; ?> value="JS">JS
    <input type="checkbox" id="tech3" name="tech[]" <?php echo in_array('React', $tech_arr) ? 'checked' : ""; ?> value="React">React<br><br>

    <input name="submit" type="submit" value="Update">
  </form>
</div>


</body>

</html>