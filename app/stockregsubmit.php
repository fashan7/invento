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
$numrows     = $_POST['numrows']+1;

for($i = 1; $i < $numrows; $i++)
{
	$itemname      = $_POST['itemname'.$i];
	$itemname      = mysqli_real_escape_string($obj->bridge, $itemname);
    
    $itemcode      = $_POST['itemcode'.$i];
	$itemcode      = mysqli_real_escape_string($obj->bridge, $itemcode);
    
    $itemcat       = $_POST['catid'.$i];
	$itemcat       = mysqli_real_escape_string($obj->bridge, $itemcat);
    
    $itembrand     = $_POST['brandid'.$i];
	$itembrand     = mysqli_real_escape_string($obj->bridge, $itembrand);
    
    
    $costprice     = $_POST['costprice'.$i];
	$costprice     = mysqli_real_escape_string($obj->bridge, $costprice);
    
    $sellingprice  = $_POST['sellingprice'.$i];
	$sellingprice  = mysqli_real_escape_string($obj->bridge, $sellingprice);
    

     if($itemname == '' || $itemcode == '' || $itemcat == '' || $itembrand == '' || $costprice == '' || $sellingprice == '')
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
    
    
    
	date_default_timezone_set('Asia/Colombo');
    $time = date('H:i:s:A');
    
    date_default_timezone_set('Asia/Colombo');
    $date = date('m-d-Y');
    
	$arr = array();
	$arr[0] = 'id';
	$arr[1] = $itemname;
	$arr[2] = $itemcode;
	$arr[3] = $itemcat;
    $arr[4] = $itembrand;
    $arr[5] = '';
    $arr[6] = $costprice;
    $arr[7] = $sellingprice;
    $arr[8] = $date;
    $arr[9] = 'yes';


	    $sqlselectstockreg = $stock->selectstockregcheck($itemcode);
		$countselectstockreg = mysqli_num_rows($sqlselectstockreg);
		if($countselectstockreg > 0)
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
		$db = 'item';
		if($obj->insertion($db, $arr) == 1)
		{
			?>
			<div class="row col-lg-12">
				<div class="col-lg-3"></div>
				<div class="col-lg-6">
					<div class="alert alert-success">
    					<strong>Alert !   </strong>Item Registerd<br>
  					</div>
				</div>
				<div class="col-lg-3"></div>
			</div>		
		<?php	
		}
	}
}

?>
<script type="text/javascript">
	setTimeout("location.href = 'stockreg.php';",1000);	// Page Dillay 2 Second
</script>
</html>
