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

    if(empty($_POST['stock_cat']))
    {
        $error = true;
        ?> 
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <div class="alert alert-danger">
                <strong>Alert !   </strong>Please Provide Dont Leave Empty<br>
  		</div>
        </div>
		<div class="col-lg-3"></div>
            <?php
    }
    
    $sqlvalidatedusename = $stock->selectstockcatbyname($_POST['stock_cat']);
    $countvalidatedusename = mysqli_num_rows($sqlvalidatedusename);
	if($countvalidatedusename > 0)
	{
		$error = true;
		?>
        <div class="row col-lg-12">
            <div class="col-lg-3"></div>
			<div class="col-lg-6">
			     <div class="alert alert-danger">
    				<strong>Alert !   </strong>Provided Category already Exits.<br>
  				</div>
			</div>
                <div class="col-lg-3"></div>
		</div>	
		<?php
	}
	$stockcat = mysqli_real_escape_string($obj->bridge, $_POST['stock_cat']);

	
	date_default_timezone_set('Asia/Colombo');
    $time = date('H:i:s:A');
    
    date_default_timezone_set('Asia/Colombo');
    $date = date('m-d-Y');
    
	$arr = array();
	$arr[0] = 'id';
	$arr[1] = $stockcat;
	$arr[2] = $date;
	$arr[3] = 'yes';


	    
	
	

	//////////
	if(!$error)
	{
		$db = 'stock_cat';
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
				setTimeout("location.href = 'stockcatreg.php';",1000);	// Page Dillay 2 Second
			</script>
			<?php	
		}
	}
    else
    {
        ?> 
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <div class="alert alert-danger">
                <strong>Alert !   </strong>Please Fill Correctly the Details<br>
            </div>
        </div>
        <div class="col-lg-3"></div>
        <script type="text/javascript">
                 setTimeout("location.href = 'stockcatreg.php';",1000);	// Page Dillay 2 Second
        </script>
        <?php       
    }

?>
</html>
