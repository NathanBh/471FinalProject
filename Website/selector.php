<!DOCTYPE html>
<html>
<head>
<style>
div {
  margin-bottom: 10px;
  position: relative;
}

input[type="number"] {
  width: 100px;
}

input + span {
  padding-right: 30px;
}

input:invalid+span:after {
  position: absolute;
  content: '✖';
  padding-left: 5px;
}

input:valid+span:after {
  position: absolute;
  content: '✓';
  padding-left: 5px;
}
</style>
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


// Create connection
$con=mysqli_connect("localhost","root","","471");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  $sql = "SELECT name, email, password, accounttype
            FROM User
            WHERE ID = '$name'";
  $result = $con -> query($sql);
  
  if ($result -> num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Name: " . $row["name"]. " - Email: " . $row["email"]. " " . $row["password"]. "<br>";
    }
} else {
    echo "0 results";
}

mysqli_close($con);
?>

<!--  #############################
      ######### SELECTOR ##########
      #############################
 -->


<form>
  <p class="fallbackLabel">Choose a date and time for your party:</p>
  <div class="fallbackDateTimePicker">
    <div>
      <span>
        <label for="day">Day:</label>
        <select id="day" name="day">
        </select>
      </span>
      <span>
        <label for="month">Month:</label>
        <select id="month" name="month"> 
          <option selected>Choose a Month</option>
        </select>
      </span>
      <span>
        <label for="year">Year:</label>
        <select id="year" name="year">
        </select>
      </span>
    </div>
    <div>
      <span>
        <label for="hour">Hour:</label>
        <select id="hour" name="hour">
          <option selected>Choose a Hour</option>
        </select>
      </span>
      <span>
        <label for="minute">Minute:</label>
        <select id="minute" name="minute">
          <option selected>Choose a Minute</option>
        </select>
      </span>
      <span>
        <label for="location">Location:</label>
        <select id="location" name="location">
          <option selected>Choose a Location</option>
          <option>Place1</option>
          <option>Place2</option>
        </select>
      </span>
      <span>
        <label for="doctor">Doctor:</label>
        <select id="doctor" name="doctor">
          <option selected>Choose a Doctor</option>
        </select>
      </span>
    </div>
  </div>
<input type="submit" value="Submit" id="submit"disabled>
</form>
<script>
    // define variables
var fallbackPicker = document.querySelector('.fallbackDateTimePicker');
var fallbackLabel = document.querySelector('.fallbackLabel');

var yearSelect = document.querySelector('#year');
var monthSelect = document.querySelector('#month');
var daySelect = document.querySelector('#day');
var hourSelect = document.querySelector('#hour');
var minuteSelect = document.querySelector('#minute');
var locationSelect = document.querySelector('#location');
var doctorSelect = document.querySelector('#doctor');

// hide fallback initially


// if it does, run the code inside the if() {} block


  fallbackPicker.style.display = 'block';
  fallbackLabel.style.display = 'block';
  document.getElementById("doctor").hidden = true;
  document.getElementById("day").hidden = true;
  document.getElementById("minute").hidden = true;
  document.getElementById("hour").hidden = true;
  document.getElementById("month").hidden = true;
  document.getElementById("year").hidden = true;

  // populate the days and years dynamically
  // (the months are always the same, therefore hardcoded)
  populateDays(monthSelect.value);
  populateYears();
  populateHours();
  populateMinutes();


function populateDays(month) {
  // delete the current set of <option> elements out of the
  // day <select>, ready for the next set to be injected
  while(daySelect.firstChild){
    daySelect.removeChild(daySelect.firstChild);
  }
  var o = document.createElement('option');
    o.textContent = "Choose a Day";
  daySelect.appendChild(o);
  // Create variable to hold new number of days to inject
  var dayNum;

  // 31 or 30 days?
  if(month === 'January' || month === 'March' || month === 'May' || month === 'July' || month === 'August' || month === 'October' || month === 'December') {
    dayNum = 31;
  } else if(month === 'April' || month === 'June' || month === 'September' || month === 'November') {
    dayNum = 30;
  } else {
  // If month is February, calculate whether it is a leap year or not
    var year = yearSelect.value;
    var isLeap = new Date(year, 1, 29).getMonth() == 1;
    isLeap ? dayNum = 29 : dayNum = 28;
  }

  // inject the right number of new <option> elements into the day <select>
  for(i = 1; i <= dayNum; i++) {
    var option = document.createElement('option');
    option.textContent = i;
    daySelect.appendChild(option);
  }

  // if previous day has already been set, set daySelect's value
  // to that day, to avoid the day jumping back to 1 when you
  // change the year
  if(previousDay) {
    daySelect.value = previousDay;

    // If the previous day was set to a high number, say 31, and then
    // you chose a month with less total days in it (e.g. February),
    // this part of the code ensures that the highest day available
    // is selected, rather than showing a blank daySelect
    if(daySelect.value === "") {
      daySelect.value = previousDay - 1;
    }

    if(daySelect.value === "") {
      daySelect.value = previousDay - 2;
    }

    if(daySelect.value === "") {
      daySelect.value = previousDay - 3;
    }
  }
}

function populateYears() {
  // get this year as a number
  var date = new Date();
  var year = date.getFullYear();

  // Make this year, and the 100 years before it available in the year <select>
  for(var i = 0; i <= 100; i++) {
    var option = document.createElement('option');
    option.textContent = year-i;
    yearSelect.appendChild(option);
  }
}
function populateMonths() {
  // get this year as a number
  

    var date = new Date();
  var thisMonth = date.getMonth();

var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];


  // Make this year, and the 100 years before it available in the year <select>
    var option = document.createElement('option');
    var option2 = document.createElement('option');
    option.textContent =  months[date.getMonth()];
    option2.textContent =  months[(date.getMonth() + 1) % 12];
    const myNode = document.getElementById("month");
    if(document.getElementById('month').options.length == 1){
      monthSelect.appendChild(option);
    monthSelect.appendChild(option2);
    } else {
      document.getElementById("month").childNodes[0] = option;
      document.getElementById("month").childNodes[1] = option2;

    }

  

}

function populateHours() {
  // populate the hours <select> with the 24 hours of the day
  if(document.getElementById('hour').options.length == 1){
  for(var i = 9; i <= 17; i++) {
    var option = document.createElement('option');
    option.textContent = (i < 10) ? ("0" + i) : i;
    hourSelect.appendChild(option);
  }
} 
}

function populateMinutes() {
  // populate the minutes <select> with the 60 hours of each minute
  var option = document.createElement('option');
    var option2 = document.createElement('option');
    option.textContent =  00;
    option2.textContent =  30;
    const myNode = document.getElementById("minute");
    if(document.getElementById('minute').options.length == 1){
      minuteSelect.appendChild(option);
    minuteSelect.appendChild(option2);
    } else {
      document.getElementById("minute").childNodes[0] = option;
      document.getElementById("minute").childNodes[1] = option2;

    }
}
function populateDoctors() {
  // populate the minutes <select> with the 60 hours of each minute
  var option = document.createElement('option');
    var option2 = document.createElement('option');
    option.textContent =  "Jacob Smith";
    option2.textContent =  "Xie Chang";
    const myNode = document.getElementById("doctor");
    if(document.getElementById('doctor').options.length == 1){
      doctorSelect.appendChild(option);
      doctorSelect.appendChild(option2);
    } else {
      document.getElementById("doctor").childNodes[0] = option;
      document.getElementById("doctor").childNodes[1] = option2;

    }
}

// when the month or year <select> values are changed, rerun populateDays()
// in case the change affected the number of available days
yearSelect.onchange = function() {
  populateDays(monthSelect.value);
}

monthSelect.onchange = function() {
  if(monthSelect.value != "Choose a Month"){
  document.getElementById("day").hidden = false;
  populateDays(monthSelect.value);
  document.getElementById("day").selectedIndex = 0;
  document.getElementById("doctor").selectedIndex = 0;
  document.getElementById("minute").selectedIndex = 0;
  document.getElementById("hour").selectedIndex = 0;
  document.getElementById("year").selectedIndex = 0;
  } else {
    document.getElementById("doctor").hidden = true;
  document.getElementById("day").hidden = true;
  document.getElementById("minute").hidden = true;
  document.getElementById("hour").hidden = true;
  document.getElementById("year").hidden = true;

  }
}
hourSelect.onchange = function() {
  if(hourSelect.value != "Choose a Hour"){
  document.getElementById("minute").hidden = false;
  document.getElementById("minute").selectedIndex = 0;
  document.getElementById("doctor").selectedIndex = 0;
  document.getElementById("year").selectedIndex = 0;
  populateMinutes();
  } else {
    document.getElementById("doctor").hidden = true;
  document.getElementById("minute").hidden = true;
  document.getElementById("year").hidden = true;

  }
}
minuteSelect.onchange = function() {
  if(minuteSelect.value != "Choose a Minute"){
  document.getElementById("doctor").hidden = false;
  populateDoctors();
  document.getElementById("doctor").selectedIndex = 0;
  } else {
    document.getElementById("doctor").hidden = true;
  }
}
locationSelect.onchange = function() {
  if(locationSelect.value != "Choose a Location"){
    document.getElementById("month").hidden = false;
    document.getElementById("month").selectedIndex = 0;
    document.getElementById("doctor").selectedIndex = 0;
  document.getElementById("day").selectedIndex = 0;
  document.getElementById("minute").selectedIndex = 0;
  document.getElementById("hour").selectedIndex = 0;
  document.getElementById("month").selectedIndex = 0;
  document.getElementById("year").selectedIndex = 0;
  populateMonths();
  } else {
  document.getElementById("doctor").hidden = true;
  document.getElementById("day").hidden = true;
  document.getElementById("minute").hidden = true;
  document.getElementById("hour").hidden = true;
  document.getElementById("month").hidden = true;
  document.getElementById("year").hidden = true;
  /*
  <!-- loop idea from https://stackoverflow.com/questions/3955229/remove-all-child-elements-of-a-dom-node-in-javascript -->
  const myNode = document.getElementById("month");
  while (myNode.firstChild) {
    myNode.removeChild(myNode.firstChild);
  }
  */
  }
}
//preserve day selection
var previousDay;

// update what day has been set to previously
// see end of populateDays() for usage
daySelect.onchange = function() {
  if(daySelect.value != "Choose a Day"){
  previousDay = daySelect.value;
  document.getElementById("hour").hidden = false;
  populateHours();
  document.getElementById("hour").selectedIndex = 0;
  document.getElementById("minute").selectedIndex = 0;
  document.getElementById("doctor").selectedIndex = 0;
  } else {
    document.getElementById("doctor").hidden = true;
  document.getElementById("minute").hidden = true;
  document.getElementById("hour").hidden = true;
  }
}
doctorSelect.onchange = function() {
  if(doctorSelect.value != "Choose a Doctor"){
    document.getElementById("submit").disabled = false; 
} else {
  document.getElementById("submit").disabled = true;  
}
}
    </script>

</body>
<!-- https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/datetime-local -->
</html>