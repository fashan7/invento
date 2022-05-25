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

	
	$brandcode = $_POST['brandcode'];
	$brandcode = mysqli_real_escape_string($obj->bridge, $brandcode);
    
    $brandname = $_POST['brandname'];
	$brandname = mysqli_real_escape_string($obj->bridge, $brandname);
    
    $brandcat = $_POST['brandcat'];
	$brandcat = mysqli_real_escape_string($obj->bridge, $brandcat);


	date_default_timezone_set('Asia/Colombo');
    $time = date('H:i:s:A');
    
    date_default_timezone_set('Asia/Colombo');
    $date = date('m-d-Y');
    
	$arr = array();
	$arr[0] = 'id';
	$arr[1] = $brandcode;
	$arr[2] = $brandname;
	$arr[3] = $date;
    $arr[4] = 'yes';
    $arr[5] = $brandcat;


	    $sqlselectstockbrandbyname = $stock->selectstockbrandbyname($brandcode);
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
        
        if($brandcode == '' || $brandname == '')
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
		$db = 'stock_brand';
		if($obj->insertion($db, $arr) == 1)
		{
			?>
			<div class="row col-lg-12">
				<div class="col-lg-3"></div>
				<div class="col-lg-6">
					<div class="alert alert-success">
    					<strong>Alert !   </strong>Category Registerd<br>
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
