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
if(isset($_POST['btn-update']))
{
    
	$usertypeid = $_GET['usertypeid'];
	$usertypeupdate = $_POST['usertypeupdate'];
	$usertypeupdate = mysqli_real_escape_string($obj->bridge, $usertypeupdate);

	
	date_default_timezone_set('Asia/Colombo');
    $time = date('H:i:s:A');
    
    date_default_timezone_set('Asia/Colombo');
    $date = date('m-d-Y');



	    $sqlselectusertypebyname = $usersettings->selectusertypebyname($usertypeupdate);
		$countselectusertypebyname = mysqli_num_rows($sqlselectusertypebyname);
		if($countselectusertypebyname > 0)
		{
			$error = true;
			?>
            <div class="row col-lg-12">
				<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<div class="alert alert-danger">
    				<strong>Alert !   </strong>Provided User Type already Exits.<br>
  				</div>
			</div>
                <div class="col-lg-3"></div>
			</div>	
			<?php
		}
	
	

	//////////
	if(!$error)
	{
		if($usersettings->updateusertype($usertypeupdate, $usertypeid) == 1)
		{
			?>
			<div class="row col-lg-12">
				<div class="col-lg-3"></div>
				<div class="col-lg-6">
					<div class="alert alert-success">
    					<strong>Alert !   </strong>User Type Updated<br>
  					</div>
				</div>
				<div class="col-lg-3"></div>
			</div>		
			<script type="text/javascript">
				setTimeout("location.href = 'usertype.php';",1000);	// Page Dillay 2 Second
			</script>
			<?php	
		}
	}
}
?>
<script type="text/javascript">
	setTimeout("location.href = 'usertype.php';",1000);	// Page Dillay 2 Second
</script>
</html>
