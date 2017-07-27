<?php
	session_start();
	require('db/connect.php');
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
	<link rel='stylesheet' type='text/css' href='css/header.css'>
	<link rel='stylesheet' type='text/css' href='css/index.css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<!--	<script src="js/nav.js"></script>	-->
	<script>
	$(document).ready(function(){
		
	});
	</script>
	</head>
	<body>
		<?php include('php/header.php'); ?>
		<nav>
		
		<?php			
			if (isset($_SESSION['login_user'])) {
				echo "
				<div id='logged_in'>
					<ul>
						<li>
							Hello " . $_SESSION['login_user'] . "
						</li>
						<li>
							<a href='secure/logout.php'>Log Out</a>
						</li>
					</ul>
				</div>
					\n";
			} else {
	?>
			<form action='secure/login.php' method='POST' enctype='multipart/form-data'>
				<ul>
					<li>
						<input type='text' id='username' name='username' placeholder='username'>
					</li>
					<li>
						<input type='password' id='password' name='password' placeholder='password'>
					</li>
					<li>
						<input type='submit' class='submit' name='login' value='Log In'/>
					</li>
				</ul>
			</form>
			<?php 
			
		}
		
?>

		<?php			
		/*check if a user is logged in. if there is, they can access the links/content*/
		if (isset($_SESSION['login_user'])) {
		?>
			<div id='nav_links'>
				
			</div>
		</nav>
		<main>
			<div id='main_top_left'>
				this is a test.
			</div>
			<div id='main_top_right'>
				this is a test.
			</div>
			<div id='main_bottom_left'>
				this is a test.
			</div>
			<div id='main_bottom_right'>
				this is a test.
			</div>
		</main>
		<?php
		/*closing bracket for checking if user is logged in*/
		}
		?>
	</body>
</html>