
<!doctype html>
<html lang="en">
<head>
<body>

<label for="start">Start date:</label>

<input type="date" id="start" name="trip-start"
       value="2019-12-01"
       min="2019-12-02" max="2020-01-31" required
       list="2019-12-03">
<input type="time" name="time" id="time"
        value="09:00"
        min="09:00" max="17:00" required>   

<script>
var today = new Date();
var day = today.getDate();
var month = today.getMonth()+1;
if (month < 10){
month = "0" + month;    
}
if (day < 10){
day = "0" + day;    
}
var date = today.getFullYear()+'-'+(month)+'-'+(day);
document.getElementById("start").value = date;
document.getElementById("start").min = date;
var today2 = new Date();
today2.setDate(today.getDate()+30);
var day2 = today2.getDate();
var month2 = today2.getMonth()+1;
if (month2 < 10){
month2 = "0" + month2;    
}
if (day2 < 10){
day2 = "0" + day2;    
}
var date2 = today2.getFullYear()+'-'+(month2)+'-'+(day2);
document.getElementById("start").max = date2;
</script>
<!-- based off scheduler from https://www.solodev.com/blog/web-design/adding-a-datetime-picker-to-your-forms.stml -->
</body>
</html>