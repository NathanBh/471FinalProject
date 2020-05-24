
<!doctype html>
<html lang="en">
<head>
<body>
<?php

session_start();
if (isset($_POST['uname'], $_POST['psw'])) {
  $_SESSION['uname'] = $_POST["uname"];
  $_SESSION['psw'] = $_POST["psw"];
}
?>
<button type="button" onclick="location.href = 'viewAppts.php';">View Appointments</button>
<button type="button" onclick="location.href = 'date_test.php';">Request Appointment</button>
<button type="button" onclick="location.href = 'index.php';">Logout</button>


</body>
</html>