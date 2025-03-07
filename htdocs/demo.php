<!DOCTYPE html>
<html>
<body>
<form action = 'data..php' method = 'post'>
<input type = 'text' name = 'name' placeholder = 'Customer
Name...'><br><br>
<input type = 'text' name = 'address' placeholder =
'Address...'><br><br>
<input type = 'text' name = 'number' placeholder = 'Mobile
Number...'><br><br>
<label> Date of Birth: </label>
<input type = 'date' name = 'dob'><br><br>
<input type = 'submit' value = 'Submit'><br>
</form>
</body>
</html>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
echo '<html><body><form>
Customer Name: '.$_POST['name'].'<br>
Address: '.$_POST['address'].'<br>
Mobile Number: '.$_POST['number'].'<br>
Date of Birth: '.$_POST['dob'];
}
?>
