<?php
session_start();
require_once('new-connection.php');


function validateEmail($email)
{
	return (filter_var($email, FILTER_VALIDATE_EMAIL));
}

if (isset($_POST['action']) && $_POST['action'] == 'email-form')
{

	if(empty($_POST['email'])) 
		$_SESSION['error']['email'] = 'Sorry, the email address field cannot be blank';
	else
	{
		$_SESSION['email_success'] = validateEmail($_POST['email']); 

		if(!$_SESSION['email_success'])
			$_SESSION['error']['email'] = 'The email address you entered (' . $_POST['email'] . ') is NOT a valid email address!';
		else
		{
			$insert_email_query = "INSERT INTO users (email, created_at, updated_at) VALUES('". $_POST['email'] ."', NOW(), NOW())";
			$insert_email_result = run_mysql_query($insert_email_query);
			if($insert_email_result > 0) //=== true)
			{
				$_SESSION['email'] = $_POST['email'];
				header('Location: success.php');
				exit();
			}
			else
				$_SESSION['error']['email'] = "Something went wrong. Please check database connection.";
		}

	}

	header('Location: index.php');
	exit();
}

elseif(isset($_POST['action']) && $_POST['action'] == 'delete')
{
	$delete_email_query = 'DELETE FROM users WHERE email ="' . $_POST['email'] . '"'; 
	$delete_email_result = run_mysql_query($delete_email_query);
	if($delete_email_result == true)
	{
		header('Location: success.php');
				exit();
	}
	else
		$_SESSION['error']['email'] = "Something went wrong. Please check database connection.";
}

?>