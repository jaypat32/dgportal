<?php
//ob start and flush keep the headers from being sent before all the code is read.
//restricts access to this page only to logged in users. redirects them to home page if they are not logged in.
	ob_start();
	include('session.php');
	 if (!isset($login_username)) {
		header("location: /index.php");
	 }
	ob_flush();
	include('../db/connect.php');
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
	<link rel='stylesheet' type='text/css' href='index.css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
	</head>
	<body>
		<div id='wrapper'>
			<form action="signup.php" method="POST" enctype="multipart/form-data">
				<h2>Sign Up</h2>
				<ul>
					<li>
						<label for='username'>Username</label>
						<input type='text' id='username' name='username'/>
					</li>
					<li>
						<label for='password'>Password</label>
						<input type='password' id='password' name='password'/>
					</li>
					<li>
						<label for='password_verify'>Verify Password</label>
						<input type='password' id='input' name='password_verify'/>
					</li>
				</ul>
				<input type="submit" class="submit" name="submit" value="Submit"/>
			</form>
		</div>
		<?php
			if (isset($_POST['submit'])) {
				$username = mysqli_real_escape_string($db, $_POST['username']);
				$password = mysqli_real_escape_string($db, $_POST['password']);
				$password_verify = mysqli_real_escape_string($db, $_POST['password_verify']);
				$hashed_password = password_hash($password, PASSWORD_BCRYPT);
				if ($password <> $password_verify) {
					echo "Passwords don't match.";
				} else {
					if (empty($_POST['username']) OR empty($_POST['password']) OR empty($_POST['password_verify'])){	
						echo "All fields are required.";
					} else {
						$query = "CREATE TABLE IF NOT EXISTS managers 
									(id INT(5) ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY, 
									username VARCHAR(64), 
									password VARCHAR(64))";
						if ($db->query($query)) {
							$query = "SELECT username 
										FROM managers 
										WHERE username = '$username'";
							$result = $db->query($query);
							$rows = $result->num_rows;
							if ($rows > 0) {
								echo "Username already in use.";
							} else {
								$query = "INSERT INTO managers (
											username, password
											) VALUES(
											'$username', 
											'$hashed_password'
											)";
								if ($db->query($query)) {
									echo "Successful";
								} else {
									echo "There was an error. Please contact the administrator.";
								}
							}
						}
					}
				}
			}
		?>
	</body>
</html>