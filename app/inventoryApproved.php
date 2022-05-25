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
include 'ControllerInventory.php';
    
$obj = new sqlfunctions();    
$stock = new stockfunctions();
$inventory = new inventoryfunction();
$error = false;

$boo = 0;    
    
if($_POST['sectioninv'] == 'po')
{
    $rowCount = mysqli_real_escape_string($obj->bridge, $_POST['countID']);
    
    for($i = 1; $i < $rowCount; $i++)
    {   
        $porowID = mysqli_real_escape_string($obj->bridge, $_POST['poID'.$i]);
        $purchaseorderid = mysqli_real_escape_string($obj->bridge, $_POST['PO'.$i]);
    
        $result = $inventory->gettoapprovePOD($porowID, $purchaseorderid);
        $row = mysqli_fetch_array($result);
        
        $arr = array();
        $arr[0] = 'order_status';
        
        
        $arrr = array();
        $arrr[0] = 'approved';
        
        if($inventory->updatePOApproval($porowID, $purchaseorderid, $arr, $arrr) == 1)
        {
            $boo = 1;
            $arra = array();
            $arra[0] = $loguserid; $arra[1] = $obj->getTime(); $arra[2] = $obj->getDate(); $arra[3] = 'PO Approved - po is '." ".$purchaseorderid; $arra[4] = 'id';
            $db = 'history';
            $obj->insertion($db, $arra);
        }            
    }
}
else if($_POST['sectioninv'] == 'grn')
{
    $grnno = mysqli_real_escape_string($obj->bridge, $_POST['grnno']);
	
	$resultposummary = $inventory->selectGrnListSummary($grnno);
	while($rowposummary = mysqli_fetch_array($resultposummary))
	{
		$arr     = array();
		$arr[0]  = $rowposummary['item_name'];
		$arr[1]  = $rowposummary['item_code'];
		$arr[2]  = $rowposummary['grn_quantity'];
		$arr[3]  = $rowposummary['grn_quantity'];
		$arr[4]  = '0';
		$arr[5]  = $rowposummary['selling_price'];
		$arr[6]  = $grnno;
		$arr[7]  = $rowposummary['grn_date'];
		$arr[8]  = $rowposummary['warehouse'];
		$arr[9]  = $obj->getTime();
		$arr[10] = $obj->getDate();
		$arr[11] = $loguserbranch;
		$arr[12] = $loguserid;
		$arr[13] = 'grn';
		$arr[14] = '';
		$arr[15] = 'id';
		
		$dbname = "stock_master";
		if($obj->insertion($dbname, $arr) == 1)
		{
			$boo = 1;
		}				
	}
	
	////////////////////////////////////////////////////////////////////////////
	$field = 'grn_no'; $code = $grnno; $dbnamegrn = 'stock_purchase_summary'; 
	$arrf = array(); $arrf[0] = 'grn_staus'; 
	$arrg = array(); $arrg[0] = 'grn';
	$inventory->updatinggrnSum($field, $code, $dbnamegrn, $arrf, $arrg);
	////////////////////////////////////////////////////////////////////////////
	$field1 = 'grn_no'; $code1 = $grnno; $dbnamegrn1 = 'stock_purchase_masters'; 
	$arrf1 = array(); $arrf1[0] = 'grn_status'; 
	$arrg1 = array(); $arrg1[0] = 'grn';
	$inventory->updatinggrnMas($field1, $code1, $dbnamegrn1, $arrf1, $arrg1);
	////////////////////////////////////////////////////////////////////////////
}
if($boo == '1')
{
	?>
    <div class="row col-lg-12">
	    <div class="col-lg-3"></div>
            <div class="col-lg-6">
				<div class="alert alert-success">
                    <strong>Alert !   </strong>Approved SuccessFully<br>
  		        </div>
            </div>
		<div class="col-lg-3"></div>
    </div>		
    <script type="text/javascript">
	    setTimeout("location.href = 'inventryapproval.php';",1000);	// Page Dillay 2 Second
    </script>
	<?php	
}	
else
{
    ?> 
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
        <div class="alert alert-danger">
            <strong>Alert !   </strong>Some Thing Went Wrong (:<br>
        </div>
    </div>
    <div class="col-lg-3"></div>
    <script type="text/javascript">
        setTimeout("location.href = 'inventryapproval.php';",1000);	// Page Dillay 2 Second
    </script>
    <?php  
}
?>
</html>
