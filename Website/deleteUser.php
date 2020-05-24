
<?php

$id = $_POST["id"];
$type = $_POST["type"];
echo $id;


// Create connection
$con=mysqli_connect("localhost","root","","471");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  if($type == "p"){
    $sql = "DELETE 
    FROM Patient
    WHERE healthnumber = '$id'";
$result = $con -> query($sql);

if ($result === TRUE) {
  echo "<script>
  alert('Patient Deleted');
  window.location.href='adminHome.php';
  </script>";
} 
  } else if ($type == "s"){
    $sql = "DELETE 
    FROM ClinicStaff
    WHERE emID = '$id'";
$result = $con -> query($sql);
if ($result === TRUE) {
  echo "<script>
  alert('Staff Deleted');
  window.location.href='adminHome.php';
  </script>";

} 

  }
mysqli_close($con);
?>

