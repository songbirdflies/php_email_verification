<?php
	session_start();
	require_once('new-connection.php');
	$get_emails_query = "SELECT * FROM users";
	$emails = fetch($get_emails_query);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Email Validation with DB</title>
	<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
	<div class="container">
<?php 
		if (isset($_SESSION['email_success']) && $_SESSION['email_success'] == true)
		{ ?>
		<div class="success">
			<div class="message">
				<p><?= 'The email address you entered (' . $_SESSION['email'] . ') is a VALID email address!'; ?></p>
			</div>
		</div>
		<div class="email_log">
			<h4>Email Addresses Entered:</h4> 			
				<?php foreach($emails as $email) //create form to edit it
				{ ?>
				<ul>	
					<form id="delete-form" action="process.php" method="post">
						<input type="hidden" name="action" value="delete">
						<input type="hidden" name="email" value="<?php echo $email['email']; ?>">
						<li><p> <?php echo $email['email']; ?> - <small><?php echo $email['created_at']; ?></small></p></li>
						<input name="submit" type="submit" value="Delete">		
					</form>	
				</ul>
				<?php	} ?>
		</div>		

	</div>
<?php	} ?>
</body>
</html>