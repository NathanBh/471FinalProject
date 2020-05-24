<!DOCTYPE html>
<html>
<head>
<title>Book Appointment</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

</head>
<body>

<!--  #############################
      ######## CONNECTION #########
      #############################
 -->

<?php
//https://stackoverflow.com/questions/240470/transfer-variables-between-php-pages
session_start();
if (isset($_SESSION['uname']) && (isset($_SESSION['psw']))) {
  $name = $_SESSION["uname"];
  $password = $_SESSION["psw"];
} else {
  header('Location: index.php');
}



//////////////////////////////
//////////// HTML ////////////
//////////////////////////////
?>
<form action="addAppointment.php" id="appointment"method="post">
<div class="container">
  <div class="panel panel-primary">
    <div class="panel-heading">Schedule an Appointment</div>
      <div class="panel-body">
         <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                  <label class="control-label">Location</label>
                          <select id="location" name="location" form="appointment" onchange="showDoctor(this.value)">
                              <option selected>Choose a Location</option>
<?php
//https://stackoverflow.com/questions/240470/transfer-variables-between-php-pages

// Create connection
$con=mysqli_connect("localhost","root","","471");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  $sql = "SELECT location
          FROM Clinic";
  $result = $con -> query($sql);
  
  if ($result -> num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo '<option value="' . $row['location'] .'">' . $row['location'] .'</option>';
    }
  } else {
    echo "0 results";
  }

mysqli_close($con);

//////////////////////////////
//////////// HTML ////////////
//////////////////////////////
?>
                        </select>
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                       <label for="doctor">Doctor:</label>
        <select id="doctor" name="doctor" form="appointment">



        </select>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                  <label class="control-label">Reason</label>
                  <input type="text" class="form-control" name="reason" id="reason" form="appointment">
               </div>
            </div>
            <div class='col-md-6'>
               <div class="form-group">
                  <label class="control-label">Appointment Time</label>
                  <div class='input-group date' id='datetimepicker1'>
                     <input type='text' class="form-control" name="date"/>
                     <span class="input-group-addon">
                     <span class="glyphicon glyphicon-calendar"></span>
                     </span>
                  </div>
               </div>
            </div>
        </div>
        <input type="submit" class="btn btn-primary" value="Submit">
      </div>
   </div>
</div>
</form>
<script>
  $(function () {
    var today = new Date();
var day = today.getDate()+1;
var month = today.getMonth()+1;
if (month < 10){
month = "0" + month;    
}
if (day < 10){
day = "0" + day;    
}
var date = (month)+'/'+(day)+'/'+today.getFullYear();
var today2 = new Date(new Date().setFullYear(new Date().getFullYear() + 1));
var day2 = today2.getDate()+1;
var month2 = today2.getMonth()+1;
if (month2 < 10){
month2 = "0" + month2;    
}
if (day2 < 10){
day2 = "0" + day2;    
}

var date2 = (month2)+'/'+(day2)+'/'+today2.getFullYear();
    $('#datetimepicker1').datetimepicker();
    $('#datetimepicker1').data("DateTimePicker").useCurrent();
  $('#datetimepicker1').data("DateTimePicker").minDate(date);
   $('#datetimepicker1').data("DateTimePicker").maxDate(date2+ "16:30");
   $('#datetimepicker1').data("DateTimePicker").enabledHours([9, 10, 11, 12, 13, 14, 15, 16]);
    $('#datetimepicker1').data("DateTimePicker").stepping(30);
 });
 var doctorSelect = document.querySelector('#doctor');
 var locationSelect = document.querySelector('#location');

// showDocter and loaddoctor.php from https://www.w3schools.com/js/js_ajax_database.asp
function showDoctor(str) {
  var xhttp; 
  if (str == "") {
    document.getElementById("location").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("doctor").innerHTML = this.responseText;
    console.log(this.responseText);
    }
  };
  xhttp.open("GET", "loaddoctor.php?q="+str, true);
  xhttp.send();
}
</script>
<button type="button" onclick="location.href = 'patientHome.php';">Return</button>
</body>
<!-- based off scheduler from https://www.solodev.com/blog/web-design/adding-a-datetime-picker-to-your-forms.stml -->