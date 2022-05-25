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


    $obj        = new AccountSettings();
    $object     = new sqlfunctions();
    $stock      = new stockfunctions();
    $customer   = new customerfunctions();

    $error = false;

	
	$cname             = $_POST['cname'];
	$cname             = mysqli_real_escape_string($obj->bridge, $cname);
    
    $contactperson     = $_POST['contactperson'];
	$contactperson     = mysqli_real_escape_string($obj->bridge, $contactperson);
    
    $telenmum          = $_POST['telenmum'];
	$telenmum          = mysqli_real_escape_string($obj->bridge, $telenmum);
        
    $fax               = $_POST['fax'];
	$fax               = mysqli_real_escape_string($obj->bridge, $fax);
    
    $address           = $_POST['address'];
	$address           = mysqli_real_escape_string($obj->bridge, $address);
        
    $customerid        = $_POST['customerid'];
	$customerid        = mysqli_real_escape_string($obj->bridge, $customerid);

	date_default_timezone_set('Asia/Colombo');
    $time = date('H:i:s:A');
    
    date_default_timezone_set('Asia/Colombo');
    $date = date('m-d-Y');
	
    if($address == '')
    {
        $error = true;
       ?>
    <div class="row col-lg-12">
				<div class="col-lg-3"></div>
				<div class="col-lg-6">
					<div class="alert alert-danger">
    					<strong>Alert !   </strong>Enter A Address<br>
  					</div>
				</div>
				<div class="col-lg-3"></div>
			</div>		
			<script type="text/javascript">
				setTimeout("location.href = 'suppliereditorview.php';",1000);	// Page Dillay 2 Second
			</script>
        <?php
    }

	//////////
	if(!$error)
	{
		if($customer->updatesupplier($cname, $contactperson, $telenmum, $fax, $address, $customerid))
		{
			?>
			<div class="row col-lg-12">
				<div class="col-lg-3"></div>
				<div class="col-lg-6">
					<div class="alert alert-success">
    					<strong>Alert !   </strong>Supplier Updated<br>
  					</div>
				</div>
				<div class="col-lg-3"></div>
			</div>		
			<script type="text/javascript">
				setTimeout("location.href = 'suppliereditorview.php';",1000);	// Page Dillay 2 Second
			</script>
			<?php	
		}
	}

?>
<script type="text/javascript">
	setTimeout("location.href = 'suppliereditorview.php';",1000);	// Page Dillay 2 Second
</script>
</html>
