<?php  
	session_start();

	require_once('conn.php');
	require_once('function.php');

	if(isset($_POST['tabs_log_username'])){
		$username = clean_string($_POST['tabs_log_username']);
		$password = clean_string(encryptIt($_POST['tabs_log_password']));

		$statement=dbaselink()->prepare("SELECT * From tabs_users Where 
								tabs_username = :username AND 
								tabs_password = :keypassword");
		$statement->execute([ 
			'username' => $username,
			'keypassword' => $password
		]);
								
		$count=$statement->rowCount();
		$row=$statement->fetch(PDO::FETCH_ASSOC);

		if($count > 0){
			if ($row['tabs_user_status'] == 0) {
				
				if($row['tabs_user_type'] == 0){
					$_SESSION['hotkopi_tabs_session_id'] = $row['tabs_user_id'];
					$_SESSION['hotkopi_tabs_session_type'] = $row['tabs_user_type'];
	
					my_notify("Login", $username, "auth");
					header("location: ../accounts/dev_ops/");
	
				}else if($row['tabs_user_type'] == 1){
					$_SESSION['hotkopi_tabs_session_id'] = $row['tabs_user_id'];
					$_SESSION['hotkopi_tabs_session_type'] = $row['tabs_user_type'];
	
					my_notify("Login", $username, "auth");
					header("location: ../accounts/judge/");
	
				}else{
					my_notify("Login Attempt", $username, "attempt");
					session_destroy();
					header("location: ../?note=noexist&email=$username");
				}

			}else{
				my_notify("Login Attempt", $username, "attempt");
				session_destroy();
				header("location: ../?note=suspended&email=$username");
			}

		}else{
			my_notify("Login Attempt", $username, "attempt");
			session_destroy();
			header("location: ../?note=noexist&email=$username");
		}
	}
		
?>