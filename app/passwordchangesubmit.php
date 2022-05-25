<?php
session_start();
    $logusername =      $_SESSION['username'];
    $loguserid =        $_SESSION['userid'];
    $loguserbranch =    $_SESSION['branch'];

    if(!$loguserid)
    {
	   header("Location:login.php");
    }
?>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<?php
    include 'ControllerPage.php';
    include 'ControllerQuery.php';
    include 'ControllerStock.php';
    include 'ControllerCustomer.php';
    include 'ControllerUsers.php';

    $obj            = new AccountSettings();
    $object         = new sqlfunctions();
    $stock          = new stockfunctions();
    $customer       = new customerfunctions();
    $usersettings   = new userfunctions();   
$error = false;

	
	$password                = $_POST['password'];
	$password                = mysqli_real_escape_string($obj->bridge, $password); 
    
    $newpassword             = $_POST['newpassword'];
	$newpassword             = mysqli_real_escape_string($obj->bridge, $newpassword);
    
    $confirmnewpassword      = $_POST['confirmnewpassword'];
	$confirmnewpassword      = mysqli_real_escape_string($obj->bridge, $confirmnewpassword);
    

    $enctypepassword = base64_encode($password);
    $result = $usersettings->selectuserbyid($loguserid);
    $count = mysqli_num_rows($result);
    $fetch = mysqli_fetch_array($result);
    
    if ($fetch['password'] != $enctypepassword)
    {
        $error = true;
    ?>
    		<div class="row col-lg-12">
				<div class="col-lg-3"></div>
				<div class="col-lg-6">
					<div class="alert alert-danger">
    					<strong>Alert !   </strong>Your New Password Does Not Match Your Old Password<br>
  					</div>
				</div>
				<div class="col-lg-3"></div>
			</div>		
			<script type="text/javascript">
				setTimeout("location.href = 'userpasswordchange.php';",1000);	// Page Dillay 2 Second
			</script>
    <?php
    }

    if ($confirmnewpassword != $newpassword)
    {
        $error = true;
    ?>
    		<div class="row col-lg-12">
				<div class="col-lg-3"></div>
				<div class="col-lg-6">
					<div class="alert alert-danger">
    					<strong>Alert !   </strong>Your New Password Does Not Match<br>
  					</div>
				</div>
				<div class="col-lg-3"></div>
			</div>		
			<script type="text/javascript">
				setTimeout("location.href = 'userpasswordchange.php';",1000);	// Page Dillay 2 Second
			</script>
    <?php
    }
    $newenctypepassword = base64_encode($newpassword);

    		

	//////////
    
	if(!$error)
	{
		if($usersettings->updateuserpassword($loguserid, $newenctypepassword))
		{
			?>
			<div class="row col-lg-12">
				<div class="col-lg-3"></div>
				<div class="col-lg-6">
					<div class="alert alert-success">
    					<strong>Alert !   </strong>Password Changed<br>
  					</div>
				</div>
				<div class="col-lg-3"></div>
			</div>		
			<script type="text/javascript">
				setTimeout("location.href = 'userpasswordchange.php';",1000);	// Page Dillay 2 Second
			</script>
			<?php	
		}
	}

?>
<script type="text/javascript">
	setTimeout("location.href = 'userpasswordchange.php';",1000);	// Page Dillay 2 Second
</script>
</html>
