<?php
	include('../db/connect.php');
	if (isset($_POST['login'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		if (empty($_POST['username']) OR empty($_POST['password'])){
			echo "Both fields are required.";
		} else {
			if ($result = $db->query("SELECT username, password FROM managers WHERE username = '$username'")) {
				if (mysqli_num_rows($result) == 1) {
					$row = $result->fetch_array(MYSQLI_NUM);
					$db_password = $row[1];
					if (password_verify($password, $db_password)) {
						session_start();
						$_SESSION['login_user'] = $username;
						echo "<script>window.location.href='../index.php';  </script>\n";
					} else {
						echo "Invalid name or password.";
						}
				} else {
					echo "Invalid name or password.";
				}
			}
		}
	}
?>