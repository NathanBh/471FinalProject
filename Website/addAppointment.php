<?php
session_start();
if (isset($_SESSION['uname']) && (isset($_SESSION['psw']))) {
  $name = $_SESSION["uname"];
  $password = $_SESSION["psw"];
} else {
  header('Location: index.php');
}
$doctor = $_POST["doctor"];
$reason = $_POST["reason"];
$location = $_POST["location"];
$date= $_POST["date"];

//echo $doctor. "<br>". $reason. "<br>". $location. "<br>". $date. "<br>";

// Create connection
$con=mysqli_connect("localhost","root","","471");

  $sql = "SELECT Name
          FROM ClinicStaff
          WHERE Name = '$doctor' AND ClinicLocation = '$location'";
          $con=mysqli_connect("localhost","root","","471");
  $result = $con -> query($sql);
  
  if ($result -> num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $sql2 = "INSERT INTO Appointment (ID,DateTime,Reason,Location,Doctor) VALUES ('$name','$date', '$reason','$location','$doctor');";
 
      if (!mysqli_query($con,$sql2))
       {
      if(mysqli_errno($con) == 1062){
        echo "<script>
        alert('Error! Timeslot unavailable please select a different time.');
        window.location.href='date_test.php';
        </script>";

      }
       die('Error: ' . mysqli_errno($con));
       }
       
       echo "<script>
       alert('New appointment request made! Please visit my appointments to see whether or not a receptionist has confirmed your appointment.');
       window.location.href='patientHome.php';
       </script>";
    }
  } else {
//https://stackoverflow.com/questions/11869662/display-alert-message-and-redirect-after-click-on-accept/11869779
echo "<script>
alert('Selected doctor does not work at desired location please reselect appointment');
window.location.href='date_test.php';
</script>";
  }
mysqli_close($con);
?>

