
<?php
// showDocter and loaddoctor.php from https://www.w3schools.com/js/js_ajax_database.asp
$mysqli = new mysqli("localhost", "root", "", "471");
if($mysqli->connect_error) {
  exit('Could not connect');
}

$sql = "SELECT Name
FROM ClinicStaff
WHERE JobType = 'p' AND ClinicLocation = ?"; 

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $_GET['q']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($name);
$stmt->fetch();
$stmt->close();

echo '<option value="' . $name .'">' . $name .'</option>';
?>