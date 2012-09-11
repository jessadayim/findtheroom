	<?php
	session_start();
	
	//include('dbcon.php');
	//echo $_SESSION['random_number'];
	
	if(@strtolower($_POST['name']) == strtolower($_SESSION['random_number']))
	{
		
		// insert your name , email and text message to your table in db
		
		echo 1;// submitted 
		exit();
		
	}
	else
	{
		echo 0; // invalid code
		exit();
	}
	?>
