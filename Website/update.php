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
 
 <form action="addUpdate.php" id="form" name="form" method="post">
   <input name="ID" type="hidden" value=<?php echo $row['ID'];?>>
   


   Height: <input type="text" name="height" value='<?php echo $row['Height'];?>'><br>

   Weight: <input type="text" name="Weight" value='<?php echo $row['Weight'];?>'><br>

   Refers To: <input type="text" name="RefersTo" value='<?php echo $row['RefersTo'];?>'><br>

   Past Appointment: <input type="text" name="PastAppointments" value='<?php echo $row['PastAppointments'];?>'><br>
   Medication: <input type = "text" name = "medication" readonly value = '<?php echo $row['Medication'];
   ?>'><br>

NewMedication <select name = "newmedication" form="form";><br>
<?php
//https://stackoverflow.com/questions/240470/transfer-variables-between-php-pages

// Create connection
$conn=mysqli_connect("localhost","root","","471");

// Check connection
if (mysqli_connect_errno($conn))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  $sql2 = "SELECT Name
          FROM Medication";
  $result2 = $conn -> query($sql2);
  
  if ($result2 -> num_rows > 0) {
    // output data of each row
    while($row2 = $result2->fetch_assoc()) {
      echo '<option value="' . $row2['Name'] .'">' . $row2['Name'] .'</option>';
    }
  } else {
    echo "0 results";
  }

mysqli_close($conn);
//////////////////////////////
//////////// HTML ////////////
//////////////////////////////
?>
</select>
   <input type="submit" value="Update">
</form>
  
<?php

}

mysqli_close($con);
?>