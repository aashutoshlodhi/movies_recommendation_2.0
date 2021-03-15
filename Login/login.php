<?php
	$email = $post["email"];
	$password = $post["password"];

	$con = new mysqli("localhost", "root", "<password_of_rootuser>", "<database>");
	if($con -> connect_error)
	{
		die("Failed to Connect : .$con -> connect_error");
	}
	else
	{
		$stmt = $con -> prepare("select * from <table_name> where email = ?");
		$stmt -> bind_param("s", $email);
		$stmt -> execute();
		$stmt_result = $stmt -> get_result();
		if($stmt_result -> num_rows > 0)
		{
			$data = $stmt_result ->fetch_assoc();
			if($data["password"] === $password)
			{
				echo "<h2>Login successfull</h2>";
			}
			else
			{
				echo "<h2>Invalid Email or Password</h2>";
			}
		}
		else
		{
			echo "<h2>Invalid Email or Password</h2>";
		}
	}
?>