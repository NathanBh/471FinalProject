<html>
<?php
session_start();
if (isset($_SESSION['uname']) && (isset($_SESSION['psw']))) {
  $name = $_SESSION["uname"];
  $password = $_SESSION["psw"];
} else {
  header('Location: index.php');
}
?>
<body>

<form action="addStaff.php" method="post">
   EmID: <input type="text" name="emid"><br>
   Email: <input type="text" name="email"><br>
   Name: <input type="text" name="name"><br>
   Password: <input type="text" name="password"><br>
   JobType: <input type="text" name="jobtype"><br>
   ClinicLocation: <input type="text" name="cliniclocation"><br>
   <input type="submit" value="add">
</form>
<form action="addPatient.php" method="post">
   HealthNumber: <input type="text" name="healthnumber"><br>
   Email: <input type="text" name="email"><br>
   Name: <input type="text" name="name"><br>
   Password: <input type="text" name="password"><br>
   DOB: <input type="text" name="dob"><br>
   Address: <input type="text" name="address"><br>
   PhoneNumber: <input type="text" name="phonenumber"><br>
   Sex: <input type="text" name="sex"><br>
   
   <input type="submit" value="add">
</form>
<form action="deleteUser.php" method="post">
<label for="delete">DeleteUser(ID)</label>
<input type="text" size="30" id="delete" name="id">

  <input type="radio" name="type" value="p"> Patient
  <input type="radio" name="type" value="s"> ClinicStaff<br>
<input type="submit" value="delete">
</form>


</body>
<button type="button" onclick="location.href = 'index.php';">Logout</button>
</html>
