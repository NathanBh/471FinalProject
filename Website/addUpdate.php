
<?php
session_start();
if (isset($_SESSION['uname']) && (isset($_SESSION['psw']))) {
  $name = $_SESSION["uname"];
  $password = $_SESSION["psw"];
} else {
  header('Location: index.php');
}
$ID = $_POST["ID"];
$newmedication = $_POST["newmedication"];
if(empty($_POST["medication"])){
$medication = $newmedication;
} else if(strpos( $_POST["medication"], $newmedication ) >= 0 ) {
$medication = $_POST["medication"];
} else {
$medication = $_POST["medication"]."," .$newmedication;
}
$height = $_POST["height"];
$weight = $_POST["Weight"];
$refers= $_POST["RefersTo"];
$pappt= $_POST["PastAppointments"];

echo $medication. "<br>". $height. "<br>". $weight. "<br>". $pappt. "<br>";

// Create connection
$con = mysqli_connect("localhost","root","","471");
$sql = "UPDATE PatientLog
        SET Medication = '$medication',
            Height = '$height',
            Weight = '$weight',
            RefersTo = '$refers',
            Pastappointments = '$pappt'
        WHERE ID = '$ID'";

$result = $con -> query($sql);
  
  if ($result -> num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

      if (!mysqli_query($con,$sql))
       {
       die('Error: ' . mysqli_error($con));
       }
       
     echo "Updated Log";
    }
  } else {
    echo "Update failed";
    header("Location: view.php");
  }

mysqli_close($con);
?>

