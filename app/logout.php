<?php
	session_start();
	unset($_SESSION['username']);
	unset($_SESSION['userid']);
    unset($_SESSION['branch']);
        
	if(session_destroy())
	{
		header("Location: login.php");
	}
?>