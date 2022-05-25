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
include 'ControllerQuery.php';
include 'ControllerUsers.php';
    
$obj = new sqlfunctions();    
$usersettings   = new userfunctions();
$error = false;

	
	$fname      = $_POST['fname'];
	$fname      = mysqli_real_escape_string($obj->bridge, $fname);
    
    $sname      = $_POST['sname'];
	$sname      = mysqli_real_escape_string($obj->bridge, $sname);
    
    $telno      = $_POST['telno'];
	$telno      = mysqli_real_escape_string($obj->bridge, $telno);
    
    $dob        = $_POST['dob'];
	$dob        = mysqli_real_escape_string($obj->bridge, $dob);
    
    $nic        = $_POST['nic'];
	$nic        = mysqli_real_escape_string($obj->bridge, $nic);
    
    $email      = $_POST['email'];
	$email      = mysqli_real_escape_string($obj->bridge, $email);
    
    $address    = $_POST['address'];
	$address    = mysqli_real_escape_string($obj->bridge, $address);
    
    $username   = $_POST['username'];
	$username   = mysqli_real_escape_string($obj->bridge, $username);
    
    $userid     = $_POST['userid'];
	$userid     = mysqli_real_escape_string($obj->bridge, $userid);
    
    $usertype   = $_POST['usertype'];
	$usertype   = mysqli_real_escape_string($obj->bridge, $usertype);

	date_default_timezone_set('Asia/Colombo');
    $time = date('H:i:s:A');
    
    date_default_timezone_set('Asia/Colombo');
    $date = date('m-d-Y');


	    $sqlselectuserbynicoremail = $usersettings->selectuserbynicoremail($nic, $email);
		$countselectuserbynicoremail = mysqli_num_rows($sqlselectuserbynicoremail);
		if($countselectuserbynicoremail > 1)
		{
			$error = true;
			?>
            <div class="row col-lg-12">
				<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<div class="alert alert-danger">
    				<strong>Alert !   </strong>Provided NIC No Or Email already Exits.<br>
  				</div>
			</div>
                <div class="col-lg-3"></div>
			</div>	
			<?php
		}
        
        if($nic == '')
        {
          $error = true;
            ?>
            <div class="row col-lg-12">
				<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<div class="alert alert-danger">
    				<strong>Alert !   </strong>Provided A NIC No.<br>
  				</div>
			</div>
                <div class="col-lg-3"></div>
			</div>
            <?php
        }
        
        if($email == '')
        {
          $error = true;
            ?>
            <div class="row col-lg-12">
				<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<div class="alert alert-danger">
    				<strong>Alert !   </strong>Provided A Email.<br>
  				</div>
			</div>
                <div class="col-lg-3"></div>
			</div>
            <?php
        }
	
	

	//////////
	if(!$error)
	{
		if($usersettings->updateuserreg($fname, $sname, $telno, $dob, $nic, $email, $address, $username, $usertype, $userid))
		{
			?>
			<div class="row col-lg-12">
				<div class="col-lg-3"></div>
				<div class="col-lg-6">
					<div class="alert alert-success">
    					<strong>Alert !   </strong>User Updated<br>
  					</div>
				</div>
				<div class="col-lg-3"></div>
			</div>		
			<script type="text/javascript">
				setTimeout("location.href = 'userprivilage.php';",1000);	// Page Dillay 2 Second
			</script>
			<?php	
		}
	}

?>
<script type="text/javascript">
	setTimeout("location.href = 'userprivilage.php';",1000);	// Page Dillay 2 Second
</script>
</html>
