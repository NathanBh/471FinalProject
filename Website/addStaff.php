
<?php

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$emid = $_POST["emid"];
$jobtype = $_POST["jobtype"];
$cliniclocation = $_POST["cliniclocation"];
if($jobtype != ("p" || "r")){
  echo "<script>
alert('Error invalid Job Type please try again');
window.location.href='adminHome.php';
</script>";
}
echo $name. "<br>". $email. "<br>". $password. "<br>";


// Create connection
$con=mysqli_connect("localhost","root","","471");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $sql = "SELECT Email FROM ClinicStaff WHERE email = '$email'"; 
  $result = $con->query($sql);
  if (!mysqli_query($con,$sql))
   {
   die('Error: ' . mysqli_error($con));
   }
   if ($result->num_rows > 0) {
    echo "<script>
    alert('Error! Email is already in use with an existing account.');
    window.location.href='adminHome.php';
    </script>";
   } else{
  
  $sql = "INSERT INTO ClinicStaff (EmID,Email,Name,Password,JobType,ClinicLocation) VALUES ('". $emid ."','". $email ."','". $name."','". $password."','". $jobtype ."','". $cliniclocation ."')";
 
 if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
  
echo "New Person Added";
   }
mysqli_close($con);
?>

