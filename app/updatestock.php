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

	
	$itemname      = $_POST['itemname'];
	$itemname      = mysqli_real_escape_string($obj->bridge, $itemname);
    
    $itemcode      = $_POST['itemcode'];
	$itemcode      = mysqli_real_escape_string($obj->bridge, $itemcode);
    
    $itemcat       = $_POST['itemcat'];
	$itemcat       = mysqli_real_escape_string($obj->bridge, $itemcat);
    
    $itembrand     = $_POST['itembrand'];
	$itembrand     = mysqli_real_escape_string($obj->bridge, $itembrand);
    
    $qty           = $_POST['qty'];
	$qty           = mysqli_real_escape_string($obj->bridge, $qty);
    
    $costprice     = $_POST['costprice'];
	$costprice     = mysqli_real_escape_string($obj->bridge, $costprice);
    
    $sellingprice  = $_POST['sellingprice'];
	$sellingprice  = mysqli_real_escape_string($obj->bridge, $sellingprice);
    
    $itemid        = $_POST['itemid'];
	$itemid        = mysqli_real_escape_string($obj->bridge, $itemid);

	date_default_timezone_set('Asia/Colombo');
    $time = date('H:i:s:A');
    
    date_default_timezone_set('Asia/Colombo');
    $date = date('m-d-Y');


	    $sqlselectstockreg = $stock->selectstockregcheck($itemcode);
		$countselectstockreg = mysqli_num_rows($sqlselectstockreg);
		if($countselectstockreg > 1)
		{
			$error = true;
			?>
            <div class="row col-lg-12">
				<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<div class="alert alert-danger">
    				<strong>Alert !   </strong>Provided Item Code Or Name already Exits.<br>
  				</div>
			</div>
                <div class="col-lg-3"></div>
			</div>	
			<?php
		}
        
        if($itemname == '' || $itemcode == '')
        {
          $error = true;
            ?>
            <div class="row col-lg-12">
				<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<div class="alert alert-danger">
    				<strong>Alert !   </strong>Provided A Item Code Or Name.<br>
  				</div>
			</div>
                <div class="col-lg-3"></div>
			</div>
            <?php
        }
	
	

	//////////
	if(!$error)
	{
		if($stock->updatestock($itemname, $itemcode, $itemcat, $itembrand, $qty, $costprice, $sellingprice, $itemid))
		{
			?>
			<div class="row col-lg-12">
				<div class="col-lg-3"></div>
				<div class="col-lg-6">
					<div class="alert alert-success">
    					<strong>Alert !   </strong>Item Updated<br>
  					</div>
				</div>
				<div class="col-lg-3"></div>
			</div>		
			<script type="text/javascript">
				setTimeout("location.href = 'stockedit.php';",1000);	// Page Dillay 2 Second
			</script>
			<?php	
		}
	}

?>
<script type="text/javascript">
	setTimeout("location.href = 'stockedit.php';",1000);	// Page Dillay 2 Second
</script>
</html>
