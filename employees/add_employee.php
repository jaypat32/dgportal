<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	require('../db/connect.php');
	date_default_timezone_set('America/Chicago');
?>
<!DOCTYPE html>
<html>
	<head>
	<title>Title</title>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<meta http-equiv='content-type' content='text/html; charset=iso-8859-1' />
	<meta name='description' content=''>
	<meta name='keywords' content=''>
	<meta name='author' content=''>
	<link rel='stylesheet' type='text/css' href='../css/header.css'>
	<link rel='stylesheet' type='text/css' href='../css/index.css'>
	<link rel='stylesheet' type='text/css' href='css/add_employee.css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
	<script src="../js/validate.js"></script>
	<script>
	$(document).ready(function(){
		
	});
	</script>
	</head>
	<body>
		<?php include('../php/header.php'); ?>	
			<div id='wrapper'>
			<form action="add_employee.php" class='add_employee' method="POST" enctype="multipart/form-data">
				<h2>Add Employee</h2>
				<table class='add_employee'>
					<tr>
						<td>
							<label for="fname">First Name</label>
						</td>
						<td>
							<input type='text' id="fname" name="fname"/>
						</td>
						<td>
							<div id='fname_validate'></div>
						</td>
					</tr>
					<tr>
						<td>
							<label for="lname">Last Name</label>
						</td>
						<td>
							<input type='text' id="lname" name="lname"/>
						</td>
						<td>
							<div id='lname_validate'></div>
						</td>
					</tr>
					<tr>
						<td>
							<label for="email">Email</label>
						</td>
						<td>
							<input type='text' id="email" name="email"/>
						</td>
						<td>
							<div id='emaile_validate'></div>
						</td>
					</tr>
					<tr>
						<td>
							<label for="email">Email for Todoist</label>
						</td>
						<td>
							<input type='text' id="todoist_email" name="todoist_email"/>
						</td>
					</tr>
					<tr>
						<td colspan='2'><input type="submit" class="submit" name="submit" value="Submit" onclick='return validate();'/></td>
					</tr>
				</table>
			</form>
		<?php
			if (isset($_POST['submit'])) {
				$date = date('Y-m-d H:i:s');
				$fname = mysqli_real_escape_string($db, $_POST['fname']);
				$lname = mysqli_real_escape_string($db, $_POST['lname']);
				$email = mysqli_real_escape_string($db, $_POST['email']);
				$todoist_email = mysqli_real_escape_string($db, $_POST['todoist_email']);
				$name = $fname . " " . $lname;
				$query = "CREATE TABLE IF NOT EXISTS employees (
							id INT(5) ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY
							, name TEXT NOT NULL
							, email TEXT NOT NULL
							, todoist_email TEXT NOT NULL
							, times_summoned INT NOT NULL
							)";
				if ($result = $db->query($query)) {
					$query = "INSERT INTO employees (
							name
							, email
							, todoist_email
							, times_summoned
							) VALUES( 
							'$name'
							, '$email'
							, '$todoist_email'
							, '0'
							)";
					if ($db->query($query)) {
						echo "<p>Successful</p>";
						//echo "<script>window.location.href='../index.php';  </script>\n";
					}
				}
			}

?>
	</div>
	</body>
</html>