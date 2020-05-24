<?php

$ID = $_GET["ID"];
// Create connection
$con=mysqli_connect("localhost","root","","471");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con,"SELECT * FROM PatientLog where ID=".$ID);

 while($row = mysqli_fetch_array($result))
  {
 
  //echo $row['ID'];

 ?>
 
 <form action="viewRec.php" method="post">
   ID: <input name="ID" type="text" value=<?php echo $row['ID'];?> readonly>
   
   Medication: <input type = "text" name = "medication" value = '<?php echo $row['Medication'];
   ?>'readonly><br>

   Height: <input type="text" name="height" value='<?php echo $row['Height'];?>'readonly><br>

   Weight: <input type="text" name="Weight" value='<?php echo $row['Weight'];?>'readonly><br>

   Past Appointments: <input type="text" name="PastAppointments" value='<?php echo $row['PastAppointments'];?>'readonly><br>

   <input type="submit" value="Return">
</form>
  
<?php

}

mysqli_close($con);
?>