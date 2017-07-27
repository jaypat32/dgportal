<?php
	require("../PHPMailer/class.phpmailer.php");	 //for emailing with PHPMailer	 

	$employee = $_GET['emp'];
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	require('../db/connect.php');
	date_default_timezone_set('America/Chicago');
	
	$query = "SELECT 
					id
				, name
				, email
				, todoist_email
				FROM employees
				WHERE name = '$employee'";
	if ($result = $db->query($query)) {
			$row = $result->fetch_array(MYSQLI_ASSOC);
			$id = $row['id'];
			$name = $row['name'];
			$email = $row['email'];
			$todoist_email = $row['todoist_email'];
		}
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
	<link rel='stylesheet' type='text/css' href='css/summon.css'>
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
			<h1>
				<?php echo $employee; ?>
			</h1>
			<ul class='summon_options'>
				<li>
					<a href='summon.php?emp=<?php echo urlencode($employee)."&page=email"; ?>'>Send Email</a>
				</li>
				<li>
					<a href='summon.php?emp=<?php echo urlencode($employee)."&page=schedule"; ?>'>Schedule Service Call</a>
				</li>
			</ul>
			
			<?php
			
				if (isset($_GET['page'])) {
					if ($_GET['page'] == 'email') {
						echo "
						<div id='email'>
						<form action='summon.php?emp=".urlencode($employee)."&page=email' method='POST' enctype='multipart/form-data'>
						<table>
							<tr>
								<td>
									<input type='text' name='subject' id='subject'>
								</td>
							</tr>
							<tr>
								<td>
									<textarea name='body' id='body'></textarea>
								</td>
							</tr>
							<tr>
								<td colspan='2'><input type='submit' class='submit' name='send' value='Send' onclick='return validate();'/></td>
							</tr>
						</table>
						</form>
						</div>
					";
					
					if (isset($_POST['send'])) {
						$subject = $_POST['subject'];
						$body = $_POST['body'];
						echo $todoist_email;
						echo "<br>";
						$header = "From: noreply@example.com\r\n"; 
						$header .= "MIME-Version: 1.0\r\n"; 
						$header .= "Content-Type: text/plain; charset=utf-8\r\n";
						$header .= "Content-Transfer-Encoding: base64";
						$header .= "X-Priority: 1\r\n"; 
						
						if (chunk_split(base64_encode(mail($todoist_email, $subject, $body, $header)))) {
							$mail = new PHPMailer();
							$mail->CharSet = 'UTF-8';
							$mail->SetLanguage("en", 'PHPMailer/language/');
							$mail->IsSMTP();                                      // set mailer to use SMTP
							$mail->SMTPAuth = true;     // turn on SMTP authentication
							$mail->SMTPSecure = 'ssl';
							$mail->Port = 465; //587 or 465 or 26
							$mail->Host = 'smtp.gmail.com';  // specify main and backup server
							$mail->Username = 'jaydigitalguru@gmail.com';  // SMTP username
							$mail->Password = 'Sugarbeet32'; // SMTP password
							$mail->setFrom('test@test.com', 'DG Employee Portal');
							$mail->AddAddress($email, $employee);
							$mail->SMTPDebug = 0;
							$mail->WordWrap = 50;   // set word wrap to 50 characters
							$mail->IsHTML(true);    // set email format to HTML
							$body = $subject . "<br><br>" . $body;
							$mail->Subject = $subject;
							$mail->Body = $body;
							$mail->Send();
							echo "Your message was sent. Thank you.";
						} else {
							echo "nope";
						}

						
					}
				}
			}							
			
			?>
		</div>
	</body>
</html>