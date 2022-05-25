<?php
    session_start();	
    $logusername =      $_SESSION['username'];
    $loguserid =        $_SESSION['userid'];
    $loguserbranch =    $_SESSION['branch'];
?>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<?php
 
$error = false;
include 'ControllerQuery.php';
include 'ControllerInventory.php';

$obj = new sqlfunctions();
$inven = new inventoryfunction();
$nowdate = $obj->getDate();
$nowtime = $obj->getTime();

$purchaseorderno =  mysqli_real_escape_string($obj->bridge, $_POST['purchaseorderno']);
$grndate =          mysqli_real_escape_string($obj->bridge, $_POST['grndate']);

$numrows = mysqli_real_escape_string($obj->bridge, $_POST['numrows']);

$resultmaxgrnNo = $inven->getgrnNo();

$countmax = mysqli_num_rows($resultmaxgrnNo);
if($countmax > 0)
{
    $grnno = "100".$countmax + 1;
}
else
{
    $grnno = "1001";
}
    

if($_POST['purchaseorderno'] != 'grn')
{
    if(empty($_POST['posupplierid']))
    {
        $error = true;
        ?> 
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <div class="alert alert-info">
                <strong>Alert !   </strong>Please Select Supplier<br>
            </div>
       </div>
       <div class="col-lg-3"></div>
       <?php
    }
    if(empty($_POST['pobilldate']))
    {
        $error = true;
        ?> 
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <div class="alert alert-info">
                <strong>Alert !   </strong>Please Provide Bill Date<br>
  		   </div>
        </div>
		<div class="col-lg-3"></div>
        <?php
    }
    
    if(empty($_POST['powarehouse']))
    {
        $error = true;
        ?> 
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <div class="alert alert-info">
                <strong>Alert !   </strong>Please Select a Warehouse to Store Stocks<br>
  		   </div>
        </div>
	  <div class="col-lg-3"></div>
        <?php
    }
    
    $boole = 0;
    for($i = 1; $i < $numrows; $i++)
    {
        if(isset($_POST['del'.$i]) != '1')
        {
            if(empty($_POST['unitprice'.$i]))
            {
                $error = true;
                $boole = 1;
                ?> 
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="alert alert-info">
                        <strong>Alert !   </strong>Dont Leave Empty the Unit Price<br>
  			        </div>
                </div>
                <div class="col-lg-3"></div>
                <?php
            }
            if(empty($_POST['sellprice'.$i]))
            {
                $error = true;
                $boole = 1;
                ?> 
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="alert alert-info">
                        <strong>Alert !   </strong>Dont Leave Empty the Selling Price<br>
  			        </div>
                </div>
                <div class="col-lg-3"></div>
                <?php
            }
            if(empty($_POST['poquantity'.$i]))
            {
                $error = true;
                $boole = 1;
                ?> 
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="alert alert-info">
                        <strong>Alert !   </strong>Dont Leave Empty the Quantity<br>
  			        </div>
                </div>
                <div class="col-lg-3"></div>
                <?php
            }   
        }            
    }
        
    if(!$error)
    {
        $posupplierid =     mysqli_real_escape_string($obj->bridge, $_POST['posupplierid']);
        $pobilldate =       mysqli_real_escape_string($obj->bridge, $_POST['pobilldate']);
        $powarehouse =      mysqli_real_escape_string($obj->bridge, $_POST['powarehouse']);
        
        $dbname = 'stock_purchase_summary';
        for($i = 1; $i < $numrows; $i++)
        {
            if(isset($_POST['del'.$i]) != '1')
            {
				
				$itemname =     mysqli_real_escape_string($obj->bridge, $_POST['itemname'.$i]);
				$itemcode =     mysqli_real_escape_string($obj->bridge, $_POST['itemcode'.$i]);
				$unitprice =    mysqli_real_escape_string($obj->bridge, $_POST['unitprice'.$i]);
				$sellprice =    mysqli_real_escape_string($obj->bridge, $_POST['sellprice'.$i]);
				$poquantity =   mysqli_real_escape_string($obj->bridge, $_POST['poquantity'.$i]);
				$grnquantity =  mysqli_real_escape_string($obj->bridge, $_POST['grnquantity'.$i]);
				$amount =       mysqli_real_escape_string($obj->bridge, $_POST['amount'.$i]);

				$arr = array();
				$arr[0] = $purchaseorderno; $arr[1] = $grndate; $arr[2] = $posupplierid; $arr[3] = $pobilldate; $arr[4] = $powarehouse;
				$arr[5] = $itemname; $arr[6] = $itemcode; $arr[7] = $unitprice; $arr[8] = $sellprice; $arr[9] = $poquantity; 
				$arr[10] = $poquantity; $arr[11] = $poquantity; $arr[12] = '0'; $arr[13] = $amount; $arr[14] = 'no'; $arr[15] = $grnno;
				$arr[16] = 'yes'; $arr[17] = $nowtime; $arr[18] = $nowdate; $arr[19] = 'id';
				$obj->insertion($dbname, $arr);

				//////////////////////////////////////////////////////////////////////// -- update of item
				$field = 'code'; $dbupatename = 'item'; 
				$updarr = array(); $updarr[0] = 'costprice'; $updarr[1] = 'sellingprice';
				$updarr1 = array(); $updarr1[0] = $unitprice; $updarr1[1] = $sellprice;
				$obj->updating($field, $itemcode, $dbupatename, $updarr, $updarr1);
				//////////////////////////////////////////////////////////////////////// -- update of purchase order Item Table
				$fields = 'itemcode'; $dbupdateponames = 'purchase_order';
				$arrpuro = array(); $arrpuro[0] = 'unitprice'; $arrpuro[1] = 'sellprice';
				$arrpuro1 = array(); $arrpuro1[0] = $unitprice; $arrpuro1[1] = $sellprice;
				$inven->updatingPOItem($fields, $itemcode, $dbupdateponames, $arrpuro, $arrpuro1);
				//////////////////////////////////////////////////////////////////////// -- update of purchase order status
				$fields = 'purchase_no'; $dbupdatenames = 'purchase_order';
				$arrpur = array(); $arrpur[0] = 'order_status';
				$arrpur1 = array(); $arrpur1[0] = 'grn'; 
				$obj->updating($fields, $purchaseorderno, $dbupdatenames, $arrpur, $arrpur1);            
				///////////////////////////////////////////////////////////////////////// -- end of updation
            }
        }
		  
        $arrr = array();
        $dbnamemasters = 'stock_purchase_masters';
        $grntotal =         mysqli_real_escape_string($obj->bridge, $_POST['grntotal']);
        $grndiscount =      mysqli_real_escape_string($obj->bridge, $_POST['grndiscount']);
        $discountamount =   mysqli_real_escape_string($obj->bridge, $_POST['discountamount']);
        $grnnbt =           mysqli_real_escape_string($obj->bridge, $_POST['grnnbt']);
        $grnvat =           mysqli_real_escape_string($obj->bridge, $_POST['grnvat']);
        $subtotal =         mysqli_real_escape_string($obj->bridge, $_POST['subtotal']);
        
        $arrr[0] = $purchaseorderno; $arrr[1] = $grntotal; $arrr[2] = $grndiscount; $arrr[3] = $discountamount; $arrr[4] = '2'; 
        $arrr[5] = $grnnbt; $arrr[6] = '15'; $arrr[7] = $grnvat; $arrr[8] = $subtotal; $arrr[9] = 'no'; $arrr[10] = $grnno; $arrr[11] = 'yes'; $arrr[12] = 'id';
		
        if ($obj->insertion($dbnamemasters, $arrr) == '1') 
        {
             $arra = array();
             $arra[0] = $loguserid; $arra[1] = $obj->getTime(); $arra[2] = $obj->getDate(); $arra[3] = 'GRN the Purchase Order - GRN is '." ".$grnno; $arra[4] = 'id';
             $db = 'history';
	         $obj->insertion($db, $arra);
            ?> 
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="alert alert-success">
                    <strong>Alert !   </strong>Saved Successfully<br>
                </div>
            </div>
            <div class="col-lg-3"></div>
            <script type="text/javascript">
                setTimeout("location.href = 'goodresivenote.php';",2000);	// Page Dillay 2 Second
            </script>
            <?php
        } 
        else 
        {
            ?> 
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="alert alert-warning">
                    <strong>Alert !   </strong>Some Thing Went Wrong :( Try Again <br>
                </div>
            </div>
            <div class="col-lg-3"></div>
            <script type="text/javascript">
                setTimeout("location.href = 'goodresivenote.php';",2000);	// Page Dillay 2 Second
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
                setTimeout("location.href = 'goodresivenote.php';",2000);	// Page Dillay 2 Second
            </script>
        <?php     
    }
}
else if($_POST['purchaseorderno'] == 'grn')
{
    if(empty($_POST['grnsupplierid']))
    {
        $error = true;
        ?> 
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <div class="alert alert-info">
                <strong>Alert !   </strong>Please Select Supplier<br>
            </div>
       </div>
       <div class="col-lg-3"></div>
       <?php
    }
    if(empty($_POST['grnbilldate']))
    {
        $error = true;
        ?> 
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <div class="alert alert-info">
                <strong>Alert !   </strong>Please Provide Bill Date<br>
  		   </div>
        </div>
		<div class="col-lg-3"></div>
        <?php
    }
    
    if(empty($_POST['grnwarehouse']))
    {
        $error = true;
        ?> 
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <div class="alert alert-info">
                <strong>Alert !   </strong>Please Select a Warehouse to Store Stocks<br>
  		   </div>
        </div>
	  <div class="col-lg-3"></div>
        <?php
    }
    
    $boole = 0;
    for($i = 1; $i <= $numrows; $i++)
    {
        if(empty($_POST['grnitemname'.$i]))
        {
            $error = true;
            $boole = 1;
            ?> 
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="alert alert-info">
                    <strong>Alert !   </strong>Dont Leave Empty the Item Name<br>
  		     </div>
            </div>
            <div class="col-lg-3"></div>
            <?php
        }
        if(empty($_POST['grnitemcode'.$i]))
        {
            $error = true;
            $boole = 1;
            ?> 
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="alert alert-info">
                    <strong>Alert !   </strong>Dont Leave Empty the Item Code<br>
  		     </div>
            </div>
            <div class="col-lg-3"></div>
            <?php
        }
        if(empty($_POST['grnunitprice'.$i]))
        {
            $error = true;
            $boole = 1;
            ?> 
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="alert alert-info">
                    <strong>Alert !   </strong>Dont Leave Empty the Unit Price<br>
  		     </div>
            </div>
            <div class="col-lg-3"></div>
            <?php
        }
        if(empty($_POST['grnsellprice'.$i]))
        {
            $error = true;
            $boole = 1;
            ?> 
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="alert alert-info">
                    <strong>Alert !   </strong>Dont Leave Empty the Selling Price<br>
  		     </div>
            </div>
            <div class="col-lg-3"></div>
            <?php
        }
        if(empty($_POST['grngrnquantity'.$i]))
        {
            $error = true;
            $boole = 1;
            ?> 
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="alert alert-info">
                    <strong>Alert !   </strong>Dont Leave Empty the Quantity<br>
  		     </div>
            </div>
            <div class="col-lg-3"></div>
            <?php
        }             
    }
    
    if(!$error)
    {
        $grnsupplierid =     mysqli_real_escape_string($obj->bridge, $_POST['grnsupplierid']);
        $grnbilldate =       mysqli_real_escape_string($obj->bridge, $_POST['grnbilldate']);
        $grnwarehouse =      mysqli_real_escape_string($obj->bridge, $_POST['grnwarehouse']);
        
        for($i = 1; $i <= $numrows; $i++)
        {
            $grnitemname =       mysqli_real_escape_string($obj->bridge, $_POST['grnitemname'.$i]);
            $grnitemcode =       mysqli_real_escape_string($obj->bridge, $_POST['grnitemcode'.$i]);
            $grnunitprice =      mysqli_real_escape_string($obj->bridge, $_POST['grnunitprice'.$i]);
            $grnsellprice =      mysqli_real_escape_string($obj->bridge, $_POST['grnsellprice'.$i]);
            $grngrnquantity =    mysqli_real_escape_string($obj->bridge, $_POST['grngrnquantity'.$i]);
            $grnamount =         mysqli_real_escape_string($obj->bridge, $_POST['grnamount'.$i]);
            $dbname = 'stock_purchase_summary';
            
            $arr = array();
            $arr[0] = 'withoutpo'; $arr[1] = $grndate; $arr[2] = $grnsupplierid; $arr[3] = $grnbilldate; $arr[4] = $grnwarehouse;
            $arr[5] = $grnitemname; $arr[6] = $grnitemcode; $arr[7] = $grnunitprice; $arr[8] = $grnsellprice; $arr[9] = $grngrnquantity; 
            $arr[10] = $grngrnquantity; $arr[11] = $grngrnquantity; $arr[12] = '0'; $arr[13] = $grnamount; $arr[14] = 'no'; $arr[15] = $grnno;
            $arr[16] = 'yes'; $arr[17] = $nowtime; $arr[18] = $nowdate; $arr[19] = 'id';
            $obj->insertion($dbname, $arr);
            
            //////////////////////////////////////////////////////////////////////// -- update of item
            $field = 'code'; $dbupatename = 'item'; 
            $updarr = array(); $updarr[0] = 'costprice'; $updarr[1] = 'sellingprice';
            $updarr1 = array(); $updarr1[0] = $grnunitprice; $updarr1[1] = $grnsellprice;
            $obj->updating($field, $grnitemcode, $dbupatename, $updarr, $updarr1);
            //////////////////////////////////////////////////////////////////////// -- update of purchase order Item Table
            $fields = 'itemcode'; $dbupdateponames = 'purchase_order';
            $arrpuro = array(); $arrpuro[0] = 'unitprice'; $arrpuro[1] = 'sellprice';
            $arrpuro1 = array(); $arrpuro1[0] = $grnunitprice; $arrpuro1[1] = $grnsellprice;
            $inven->updatingPOItem($fields, $grnitemcode, $dbupdateponames, $arrpuro, $arrpuro1);
            ///////////////////////////////////////////////////////////////////////// -- end of updation
            
        }
        
        $arrr = array();
        $dbnamemasters = 'stock_purchase_masters';
        $grntotal =         mysqli_real_escape_string($obj->bridge, $_POST['grntotal']);
        $grndiscount =      mysqli_real_escape_string($obj->bridge, $_POST['grndiscount']);
        $discountamount =   mysqli_real_escape_string($obj->bridge, $_POST['discountamount']);
        $grnnbt =           mysqli_real_escape_string($obj->bridge, $_POST['grnnbt']);
        $grnvat =           mysqli_real_escape_string($obj->bridge, $_POST['grnvat']);
        $subtotal =         mysqli_real_escape_string($obj->bridge, $_POST['subtotal']);
        
        $arrr[0] = 'withoutpo'; $arrr[1] = $grntotal; $arrr[2] = $grndiscount; $arrr[3] = $discountamount; $arrr[4] = '2'; 
        $arrr[5] = $grnnbt; $arrr[6] = '15'; $arrr[7] = $grnvat; $arrr[8] = $subtotal; $arrr[9] = 'no'; $arrr[10] = $grnno; $arrr[11] = 'yes'; $arrr[12] = 'id';
        
        if ($obj->insertion($dbnamemasters, $arrr) == '1') 
        {
             $arra = array();
             $arra[0] = $loguserid; $arra[1] = $obj->getTime(); $arra[2] = $obj->getDate(); $arra[3] = 'GRN the without Purchase Order - GRN is '." ".$grnno; $arra[4] = 'id';
             $db = 'history';
	         $obj->insertion($db, $arra);
            ?> 
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="alert alert-success">
                    <strong>Alert !   </strong>Saved Successfully<br>
                </div>
            </div>
            <div class="col-lg-3"></div>
            <script type="text/javascript">
                setTimeout("location.href = 'goodresivenote.php';",2000);	// Page Dillay 2 Second
            </script>
            <?php
        } 
        else 
        {
            ?> 
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="alert alert-warning">
                    <strong>Alert !   </strong>Some Thing Went Wrong :( Try Again <br>
                </div>
            </div>
            <div class="col-lg-3"></div>
            <script type="text/javascript">
                setTimeout("location.href = 'goodresivenote.php';",2000);	// Page Dillay 2 Second
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
                setTimeout("location.href = 'goodresivenote.php';",2000);	// Page Dillay 2 Second
            </script>
        <?php     
    }
}







