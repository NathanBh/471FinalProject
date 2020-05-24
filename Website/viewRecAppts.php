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
  if(isset($_GET["job"])){
    $DateTime = $_GET["DateTime"];
    $Doctor = $_GET["Doctor"];
    if ($_GET["job"] == "confirm"){
      $result = mysqli_query($con,"UPDATE Appointment
       SET Confirmation = 'y' WHERE Datetime = '$DateTime' AND Doctor = '$Doctor'");
      } else if ($_GET["job"] == "deny"){
        $result = mysqli_query($con,"UPDATE Appointment
         SET Confirmation = 'n' WHERE Datetime = '$DateTime' AND Doctor = '$Doctor'");
        }
    }
$result = mysqli_query($con,"SELECT ID,DateTime,Reason,Doctor,Location FROM Appointment WHERE confirmation ='m'");

echo "<table border='1'>
<tr>
<th>HealthNumber</th>
<th>DateTime</th>
<th>Reason</th>
<th>Doctor</th>
<th>Location</th>
</tr>";

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['ID'] . "</td>";
  echo "<td>" . $row['DateTime'] . "</td>";
   echo "<td>" . $row['Reason'] . "</td>";
   echo "<td>" . $row['Doctor'] . "</td>";
   echo "<td>" . $row['Location'] . "</td>";
   echo "<td><a onClick= \"return confirm('Do you want to confirm this appointment?')\" href='viewRecAppts.php?job=confirm&amp;DateTime=" . $row['DateTime'] ."&amp;Doctor=". $row['Doctor'] ."'>Confirm</a></td>";
   echo "<td><a onClick= \"return confirm('Do you want to deny this appointment?')\" href='viewRecAppts.php?job=deny&amp;DateTime=" . $row['DateTime'] ."&amp;Doctor=". $row['Doctor'] ."'>Deny</a></td>";
  
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