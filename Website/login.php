
<?php

session_start();
if (isset($_POST['uname'], $_POST['psw'])) {
  $_SESSION['uname'] = $_POST["uname"];
  $_SESSION['psw'] = $_POST["psw"];
}

$ID = $_POST["uname"];
$password = $_POST["psw"];

// Create connection
$con=mysqli_connect("localhost","root","","471");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $sql = "SELECT *
          FROM Patient
          WHERE healthnumber = '$ID' AND Password = '$password'";
  $result = $con -> query($sql);
  
  if ($result -> num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        // https://stackoverflow.com/questions/18348168/mysql-check-account-type-to-see-if-admin-on-login
        header("Location: patientHome.php");
    }
  } else {
  $sql = "SELECT *
  FROM ClinicStaff
  WHERE EmID = '$ID'";
$result = $con -> query($sql);
if ($result -> num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      // https://stackoverflow.com/questions/18348168/mysql-check-account-type-to-see-if-admin-on-login
      if($row["JobType"] =="r"){
        $_SESSION['JobType'] = $row['JobType'];
        header("Location: recHome.php");
      }
      if($row["JobType"] =="p"){
        $_SESSION['uname'] = $ID;
        header("Location: docHome.php");
      }
  }
} else {
  $sql = "SELECT *
  FROM Admin
  WHERE master = '$ID'";
$result = $con -> query($sql);
if ($result -> num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      // https://stackoverflow.com/questions/18348168/mysql-check-account-type-to-see-if-admin-on-login     
        $_SESSION['uname'] = $ID;
        header("Location: adminHome.php");
      
  }
}
}
}
echo "<script>
alert('Error invalid entry please try again');
window.location.href='index.php';
</script>";

mysqli_close($con);
?>
<html>
<body>
  <div class="container" style="background-color:#f1f1f1">
    <button type="button" onclick="location.href = 'http://localhost/Test/Website/index.php';" class="returnbtn">Return</button>
  </div>
</body>
</html>

