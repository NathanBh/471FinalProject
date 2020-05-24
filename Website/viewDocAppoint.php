<?php

session_start();
if (isset($_SESSION['uname']) && (isset($_SESSION['psw']))) {
  $name = $_SESSION["uname"];
  $password = $_SESSION["psw"];
} else {
  header('Location: index.php');
}

$ID = $_SESSION["uname"];

// Create connection
$con=mysqli_connect("localhost","root","","471");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con,"SELECT *
                              FROM Appointment
                              INNER JOIN ClinicStaff
                              ON Appointment.Doctor = ClinicStaff.Name
                              WHERE confirmation = 'y' AND emID = '$ID'");

echo "<table border='1'>
<tr>
<th>DateTime</th>
<th>ID</th>
<th>Reason</th>
</tr>";

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['DateTime'] . "</td>";
  echo "<td>" . $row['ID'] . "</td>";
  echo "<td>" . $row['Reason'] . "</td>";
  }
echo "</table>";

mysqli_close($con);
?>
<!doctype html>
<html lang="en">
<head>
<body>
<button type="button" onclick="location.href = 'docHome.php';">Return</button>
</body>
</html>