<?php

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
</tr>";

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['HealthNumber'] . "</td>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td><a href='update.php?ID= " . $row['HealthNumber'] . "'>Update</a></td>";
  echo "</tr>";
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