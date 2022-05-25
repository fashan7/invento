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
include 'ControllerInventory.php';
    
$obj = new sqlfunctions();    
$inventory  = new inventoryfunction();
$error = false;
    
	$warehouseid    = $_GET['warehouseid'];
	$warehousenameupdate = $_POST['warehousenameupdate'];
	$warehousenameupdate = mysqli_real_escape_string($obj->bridge, $warehousenameupdate);
    
    $warehousecodeupdate = $_POST['warehousecodeupdate'];
	$warehousecodeupdate = mysqli_real_escape_string($obj->bridge, $warehousecodeupdate);

	
	date_default_timezone_set('Asia/Colombo');
    $time = date('H:i:s:A');
    
    date_default_timezone_set('Asia/Colombo');
    $date = date('m-d-Y');
	
	
	    $sqlwarehousebycodeorname = $inventory->warehousebycodeorname($warehousenameupdate, $warehousecodeupdate);
		$countwarehousebycodeorname = mysqli_num_rows($sqlwarehousebycodeorname);
		if($countwarehousebycodeorname > 1)
		{
			$error = true;
			?>
            <div class="row col-lg-12">
				<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<div class="alert alert-danger">
    				<strong>Alert !   </strong>Provided Warehouse Code Or Name already Exits.<br>
  				</div>
			</div>
                <div class="col-lg-3"></div>
			</div>	
			<?php
		}
        
        if($warehousenameupdate == '' || $warehousecodeupdate == '')
        {
          $error = true;
            ?>
            <div class="row col-lg-12">
				<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<div class="alert alert-danger">
    				<strong>Alert !   </strong>Provided A Warehouse Code Or Name.<br>
  				</div>
			</div>
                <div class="col-lg-3"></div>
			</div>
            <?php
        }
    
	//////////
	if(!$error)
	{
		if($inventory->updatewarehouse($warehousenameupdate, $warehousecodeupdate, $warehouseid))
		{
			?>
			<div class="row col-lg-12">
				<div class="col-lg-3"></div>
				<div class="col-lg-6">
					<div class="alert alert-success">
    					<strong>Alert !   </strong>Warehouse Updated<br>
  					</div>
				</div>
				<div class="col-lg-3"></div>
			</div>		
			<script type="text/javascript">
				setTimeout("location.href = 'warehouse.php';",1000);	// Page Dillay 2 Second
			</script>
			<?php	
		}
	}

?>
<script type="text/javascript">
	setTimeout("location.href = 'warehouse.php';",1000);	// Page Dillay 2 Second
</script>
</html>
