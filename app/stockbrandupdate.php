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
include 'ControllerStock.php';
    
$obj = new sqlfunctions();    
$stock = new stockfunctions();
$error = false;
    
	$stockbrandid    = $_GET['brandid'];
	$brandnameupdate = $_POST['brandnameupdate'];
	$brandnameupdate = mysqli_real_escape_string($obj->bridge, $brandnameupdate);
    
    $brandcodeupdate = $_POST['brandcodeupdate'];
	$brandcodeupdate = mysqli_real_escape_string($obj->bridge, $brandcodeupdate);

	
	date_default_timezone_set('Asia/Colombo');
    $time = date('H:i:s:A');
    
    date_default_timezone_set('Asia/Colombo');
    $date = date('m-d-Y');
	
	
	    $sqlselectstockbrandbyname = $stock->selectstockbrandbyname($brandcodeupdate);
		$countselectstockbrandbyname = mysqli_num_rows($sqlselectstockbrandbyname);
		if($countselectstockbrandbyname > 0)
		{
			$error = true;
			?>
            <div class="row col-lg-12">
				<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<div class="alert alert-danger">
    				<strong>Alert !   </strong>Provided Brand Code Or Name already Exits.<br>
  				</div>
			</div>
                <div class="col-lg-3"></div>
			</div>	
			<?php
		}
        
        if($brandcodeupdate == '' || $brandnameupdate == '')
        {
          $error = true;
            ?>
            <div class="row col-lg-12">
				<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<div class="alert alert-danger">
    				<strong>Alert !   </strong>Provided A Brand Code Or Name.<br>
  				</div>
			</div>
                <div class="col-lg-3"></div>
			</div>
            <?php
        }
    
	//////////
	if(!$error)
	{
		if($stock->updatestockbrand($brandnameupdate, $brandcodeupdate, $stockbrandid))
		{
			?>
			<div class="row col-lg-12">
				<div class="col-lg-3"></div>
				<div class="col-lg-6">
					<div class="alert alert-success">
    					<strong>Alert !   </strong>Brand Updated<br>
  					</div>
				</div>
				<div class="col-lg-3"></div>
			</div>		
			<script type="text/javascript">
				setTimeout("location.href = 'stockbrandreg.php';",1000);	// Page Dillay 2 Second
			</script>
			<?php	
		}
	}

?>
<script type="text/javascript">
	setTimeout("location.href = 'stockbrandreg.php';",1000);	// Page Dillay 2 Second
</script>
</html>
