<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
<?php

session_start();
if (isset($_SESSION['uname']) && (isset($_SESSION['psw']))) {
  $name = $_SESSION["uname"];
  $password = $_SESSION["psw"];
} else {
  header('Location: index.php');
}

// Create connection
$con=mysqli_connect("localhost","root","","471");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  if(isset($_GET["job"])){
  if ($_GET["job"] == "delete"){
    $DateTime = $_GET["DateTime"];
    $Doctor = $_GET["Doctor"];
    $result = mysqli_query($con,"DELETE FROM Appointment WHERE datetime = '$DateTime' AND doctor = '$Doctor'");
    }
  }
$result = mysqli_query($con,"SELECT DateTime,Confirmation,Reason,Doctor,Location FROM Appointment WHERE ID = '$name'");

if ($result -> num_rows == 0){
  echo "You have no appointments or requests at this time";
}
echo "<table border='1'>
<tr>
<th>DateTime</th>
<th>Confirmation</th>
<th>Reason</th>
<th>Doctor</th>
<th>Location</th>
</tr>";

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['DateTime'] . "</td>";
  echo "<td>" . $row['Confirmation'] . "</td>";
   echo "<td>" . $row['Reason'] . "</td>";
   echo "<td>" . $row['Doctor'] . "</td>";
   echo "<td>" . $row['Location'] . "</td>";
  // echo "<td><a href='update.php?ID= " . $row['DateTime'] . "'>Update</a></td>";
  echo "<td><a onClick= \"return confirm('Do you want to delete this appointment?')\" href='viewAppts.php?job=delete&amp;DateTime=" . $row['DateTime'] ."&amp;Doctor=". $row['Doctor'] ."'>Cancel</a></td>";
  }
echo "</table>";




mysqli_close($con);
?>

<!doctype html>
<html lang="en">
<head>
<body>
<button type="button" onclick="location.href = 'patientHome.php';">Return</button>
</body>
</html>
