<?php
session_start();
if (isset($_POST['uname'], $_POST['psw'])) {
  $_SESSION['uname'] = $_POST["uname"];
  $_SESSION['psw'] = $_POST["psw"];
}


// Create connection
$con=mysqli_connect("localhost","root","","471");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con,"SELECT * FROM Patient");

echo "<table border='1'>
<tr>
<th>HealthNumber</th>
<th>Name</th>
<th>Email</th>
<th>View</th>
</tr>";

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['HealthNumber'] . "</td>";
  echo "<td>" . $row['Name'] . "</td>";
   echo "<td>" . $row['Email'] . "</td>";
  // echo "<td>" . $row['Password'] . "</td>";
  echo "<td><a href='updateRec.php?ID= " . $row['HealthNumber'] . "'>Record</a></td>";
  //echo "<td><a onClick= \"return confirm('Do you want to delete this user?')\" href='view.php?job=delete&amp;ID= " . $row['HealthNumber'] . "'>DELETE</a></td>";
  
  echo "</tr>";
  }
echo "</table>";




mysqli_close($con);
?>
<!doctype html>
<html lang="en">
<head>
<body>
<button type="button" onclick="location.href = 'recHome.php';">Return</button>
</body>
</html>