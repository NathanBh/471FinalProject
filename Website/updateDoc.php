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
 
  echo $row['ID'];

 ?>
 
 <form action="addUpdate.php" method="post">
   <input name="ID" type="hidden" value=<?php echo $row['ID'];?>>
   
   Medication: <input type = "text" name = "medication" value = '<?php echo $row['Medication'];
   ?>'><br>

   Height: <input type="text" name="height" value='<?php echo $row['Height'];?>'><br>

   Weight: <input type="text" name="Weight" value='<?php echo $row['Weight'];?>'><br>

   Past Appointments: <input type="text" name="PastAppointments" value='<?php echo $row['PastAppointments'];?>'><br>

   <input type="submit" value="Update">
</form>
  
<?php

}

mysqli_close($con);
?>