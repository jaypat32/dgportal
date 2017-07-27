<?php

	$query = "SELECT 
					id
				, name
				, email
				FROM employees";
	if ($result = $db->query($query)) {
		$rows = $result->num_rows;
		
		echo "<ul>	";
		for ($num = 0; $num < $rows; ++$num) {
			$row = $result->fetch_array(MYSQLI_ASSOC);
			$id = $row['id'];
			$name = $row['name'];
			$email = $row['email'];
			echo "<li><a href='employees/summon.php?emp=".$name."'>" . $name . "</a></li>";
		}
		echo "</ul>";
	}

?>