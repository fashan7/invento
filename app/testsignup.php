<?php
    session_start();

	

	

	if ($_POST) {
        
        include 'ControllerQuery.php';
    $obj = new sqlfunctions();
		
		$name = trim($_POST['user_name']);
		$email = trim($_POST['user_email']);
		$pass = trim($_POST['password']);
		
        $arr = array();
        $arr[0] = mysqli_real_escape_string($obj->bridge, $name);
        $arr[1] = mysqli_real_escape_string($obj->bridge, $email);
        $arr[2] = mysqli_real_escape_string($obj->bridge, $pass);
		$arr[3] = 'id';
        $db = 'test';
        
        
		
		// check for successfull registration
        if ($obj->insertion($db, $arr) == '1') {
			 echo "registered";
        } else {
             echo "Query could not execute !";        }	
	}
	