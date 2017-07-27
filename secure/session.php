<?php
	session_start();
	require('../db/connect.php');
	$check_user = $_SESSION['login_user'];
	$check_user_query = "SELECT username FROM managers WHERE username = '$check_user'";
	if ($result = $db->query($check_user_query)) {
		$row = $result->fetch_array(MYSQLI_NUM);
		$login_username = $row[0];
		if (!isset($login_username)) {
			$db->close();
			header("Location: index.php");
		}
	}
?>