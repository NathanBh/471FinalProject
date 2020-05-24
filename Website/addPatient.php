
<?php

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$healthnumber = $_POST["healthnumber"];
$sex = $_POST["sex"];
$address = $_POST["address"];
$phonenumber = $_POST["phonenumber"];
$dob = $_POST["dob"];




// Create connection
$con=mysqli_connect("localhost","root","","471");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $sql = "SELECT Email FROM Patient WHERE email = '$email'"; 
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
   } else {
    $sql = "INSERT INTO Patient (HealthNumber,Email,Name,Password,Sex,Address,PhoneNumber,DOB) VALUES ('". $healthnumber ."','". $email ."','". $name."','". $password."','". $sex ."','". $address ."','". $phonenumber ."','". $dob ."')";
 
    if (!mysqli_query($con,$sql))
     {
     die('Error: ' . mysqli_error($con));
     }
     
     echo "<script>
     alert('Success! New Patient added');
     window.location.href='adminHome.php';
     </script>";

   }
  


mysqli_close($con);
?>

