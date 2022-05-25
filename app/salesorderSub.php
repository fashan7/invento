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
    include 'ControllerUsers.php';
    include 'ControllerInventory.php';
    include 'ControllerSales.php';

    $obj            = new AccountSettings();
    $object         = new sqlfunctions();
    $stock          = new stockfunctions();
    $customer       = new customerfunctions();
    $usersettings   = new userfunctions();
    $inventory      = new inventoryfunction();
    $sales          = new salesFunction();

    $error = false;

    if(empty($_POST['orderno']))
    {
        $error = true;
        ?>
        <div class="row col-lg-12">
		  <div class="col-lg-3"></div>
		  <div class="col-lg-6">
			<div class="alert alert-danger">
                <strong>Alert !   </strong>Order No Could Not Load<br>
            </div>
          </div>
          <div class="col-lg-3"></div>
		</div>		
        <?php    
    }
	
    if(empty($_POST['orderdate']))
    {
        $error = true;
        ?>
        <div class="row col-lg-12">
		  <div class="col-lg-3"></div>
		  <div class="col-lg-6">
			<div class="alert alert-danger">
                <strong>Alert !   </strong>Fill Order Date <br>
            </div>
          </div>
          <div class="col-lg-3"></div>
		</div>		
        <?php    
    }
    
    if(empty($_POST['customername']))
    {
        $error = true;
        ?>
        <div class="row col-lg-12">
		  <div class="col-lg-3"></div>
		  <div class="col-lg-6">
			<div class="alert alert-danger">
                <strong>Alert !   </strong>Fill Customer Name<br>
            </div>
          </div>
          <div class="col-lg-3"></div>
		</div>		
        <?php    
    }
    
    if(empty($_POST['customercode']))
    {
        $error = true;
        ?>
        <div class="row col-lg-12">
		  <div class="col-lg-3"></div>
		  <div class="col-lg-6">
			<div class="alert alert-danger">
                <strong>Alert !   </strong>Fill Customer Name <br>
            </div>
          </div>
          <div class="col-lg-3"></div>
		</div>		
        <?php    
    }
    
    
    
    if(empty($_POST['warehouse']))
    {
        $error = true;
        ?>
        <div class="row col-lg-12">
		  <div class="col-lg-3"></div>
		  <div class="col-lg-6">
			<div class="alert alert-danger">
                <strong>Alert !   </strong>Select Warehouse<br>
            </div>
          </div>
          <div class="col-lg-3"></div>
		</div>		
        <?php    
    }
    
    $numrows        = mysqli_real_escape_string($obj->bridge, $_POST['numrows']);
    
    for($i = 1; $i <= $numrows; $i++)
    {
        if(empty($_POST['itemname'.$i]))
        {
            $error = true;
            ?>
            <div class="row col-lg-12">
              <div class="col-lg-3"></div>
              <div class="col-lg-6">
                <div class="alert alert-danger">
                    <strong>Alert !   </strong>Fill Item Name<br>
                </div>
              </div>
              <div class="col-lg-3"></div>
            </div>		
            <?php    
        }

        if(empty($_POST['itemcode'.$i]))
        {
            $error = true;
            ?>
            <div class="row col-lg-12">
              <div class="col-lg-3"></div>
              <div class="col-lg-6">
                <div class="alert alert-danger">
                    <strong>Alert !   </strong>Fill Item Code<br>
                </div>
              </div>
              <div class="col-lg-3"></div>
            </div>		
            <?php    
        }
        
        if(empty($_POST['sellprice'.$i]))
        {
            $error = true;
            ?>
            <div class="row col-lg-12">
              <div class="col-lg-3"></div>
              <div class="col-lg-6">
                <div class="alert alert-danger">
                    <strong>Alert !   </strong>Fill Selling Price<br>
                </div>
              </div>
              <div class="col-lg-3"></div>
            </div>		
            <?php    
        }

        if(empty($_POST['quantity'.$i]))
        {
            $error = true;
            ?>
            <div class="row col-lg-12">
              <div class="col-lg-3"></div>
              <div class="col-lg-6">
                <div class="alert alert-danger">
                    <strong>Alert !   </strong>Fill Quantity<br>
                </div>
              </div>
              <div class="col-lg-3"></div>
            </div>		
            <?php    
        }
    }
    
    if(!$error)
    {
        $maxSalesIdResult = $sales->maxSalesid();
        $rowmaxSalesId    = mysqli_fetch_array($maxSalesIdResult);

        if($rowmaxSalesId[0] == '')
        {
            $salesorderid = '0001';
        }
        else
        {
            $incrementorder = $rowmaxSalesId[0] + 1;
            $salesorderid = str_pad($incrementorder, 4, '0', STR_PAD_LEFT);
        }
        
        $orderno          = $salesorderid;

        $orderdate        = $_POST['orderdate'];
        $orderdate        = mysqli_real_escape_string($obj->bridge, $orderdate);

        $customername     = $_POST['customername'];
        $customername     = mysqli_real_escape_string($obj->bridge, $customername);
        
        $customerids     = $_POST['customerid'];
        $customerids       = mysqli_real_escape_string($obj->bridge, $customerids); 
        
        $customercode     = $_POST['customercode'];
        $customercode     = mysqli_real_escape_string($obj->bridge, $customercode);

        $phone            = $_POST['phone'];
        $phone            = mysqli_real_escape_string($obj->bridge, $phone);

        $address          = $_POST['address'];
        $address          = mysqli_real_escape_string($obj->bridge, $address);

        $warehouse        = $_POST['warehouse'];
        $warehouse        = mysqli_real_escape_string($obj->bridge, $warehouse);

        $total                 = mysqli_real_escape_string($obj->bridge, $_POST['total']);
        $totaldiscount         = mysqli_real_escape_string($obj->bridge, $_POST['totaldiscount']);    
        $totaldiscountamount   = mysqli_real_escape_string($obj->bridge, $_POST['totaldiscountamount']);    
        $totalnbt              = mysqli_real_escape_string($obj->bridge, $_POST['totalnbt']);
        $totalvat              = mysqli_real_escape_string($obj->bridge, $_POST['totalvat']);
        $subtotal              = mysqli_real_escape_string($obj->bridge, $_POST['subtotal']);
        
        date_default_timezone_set('Asia/Colombo');
        $time                  = date('H:i:s:A');

        date_default_timezone_set('Asia/Colombo');
        $date                  = date('Y-m-d');
        
        $arr = array();
        $arr[0]     = 'id';
        $arr[1]     = $orderno;
        $arr[2]     = $orderdate;
        $arr[3]     = $loguserbranch;
        $arr[4]     = $loguserid;
        $arr[5]     = $loguserid;
        $arr[6]     = $total;
        $arr[7]     = $totaldiscount;        
        $arr[8]     = $totaldiscountamount;
        $arr[9]     = $totalnbt;
        $arr[10]    = $totalvat;
        $arr[11]    = $subtotal;
        $arr[12]    = 0;
        $arr[13]    = $time;
        $arr[14]    = 'no';
        $arr[15]    = $customerids;
        $arr[16]    = $warehouse;
        $arr[17]    = 'yes';
        $arr[18]    = $date;
        $dbnamesummary     = 'sales_order_summary';
        $object->insertion($dbnamesummary, $arr);
        
        for($i = 1; $i <= $numrows; $i++)
        {
            $itemname       = mysqli_real_escape_string($obj->bridge, $_POST['itemname'.$i]);
            $itemcode       = mysqli_real_escape_string($obj->bridge, $_POST['itemcode'.$i]);        
            $sellprice      = mysqli_real_escape_string($obj->bridge, $_POST['sellprice'.$i]);            
            $quantity       = mysqli_real_escape_string($obj->bridge, $_POST['quantity'.$i]);
            $hidquan        = mysqli_real_escape_string($obj->bridge, $_POST['hidquan'.$i]);
            $showamount     = mysqli_real_escape_string($obj->bridge, $_POST['showamount'.$i]);    
            $discount       = mysqli_real_escape_string($obj->bridge, $_POST['discount'.$i]);    
            $showdiscount   = mysqli_real_escape_string($obj->bridge, $_POST['showdiscount'.$i]);
            $netvalue       = mysqli_real_escape_string($obj->bridge, $_POST['netvalue'.$i]);
            
            $dbnameorder = 'sales_oder';
            $arrr = array();
            $arrr[0] = 'id';
            $arrr[1] = $orderno;
            $arrr[2] = $orderdate;
            $arrr[3] = $customerids;
            $arrr[4] = $customername;
            $arrr[5] = $customercode;
            $arrr[6] = $phone;
            $arrr[7] = $address;
            $arrr[8] = $loguserid;
            $arrr[9] = $warehouse;
            $arrr[10] = $itemname;
            $arrr[11] = $itemcode;
            $arrr[12] = $sellprice;
            $arrr[13] = $quantity;
            $arrr[14] = $showamount;
            $arrr[15] = $discount;
            $arrr[16] = $showdiscount;
            $arrr[17] = $netvalue;
            $arrr[18] = '';
            $arrr[19] = 'yes';
            $arrr[20] = 'no';
            $arrr[21] = $date;
            $arrr[22] = $time;
            $arrr[23] = 'yes';
            $object->insertion($dbnameorder, $arrr);
            
//            $qty = $quantity;
//            if($quantity > $hidquan)
//            {}
//            else
//            {
//                $bilqtu = $qty;
//                $result = $inventory->getDetailsofStockMaster($itemcode);
//                while($row = mysqli_fetch_array($result))
//                {
//                    $grnno          = $row[3];
//                    $grnstatus      = $row[4];
//                    $availableqty   = $row[1];
//                    $idofstockmaster= $row[5];
//                    $dbstockmaster  = 'stock_master';  
//                    $arrstock       = array();
//                    
//                    if($bilqtu > $availableqty)
//                    {
//                        if($availableqty != 0)
//                        {
//                            $resultalocateQty   = $inventory->getallocateQtyStockMaster($itemcode, $idofstockmaster);
//                            $rowalocateQty      = mysqli_fetch_array($resultalocateQty);
//                            $allocatequantity   = $rowalocateQty[0];
//
//                            $newbillqty         = $bilqtu - $availableqty;
//                            $allocatequantity   = $availableqty;
//                            $availableqty       = '0';
//
//                            $newallocateQty     = $allocatequantity + $availableqty;
//
//                            $arrstock[0]        = $availableqty;
//                            $arrstock[1]        = $newallocateQty;
//                            $inventory->updatingStockonStockMaster($dbstockmaster, $arrstock, $itemcode, $grnstatus, $idofstockmaster);
//
//                            $bilqtu             = $newbillqty;
//                        }
//                    }
//                    else
//                    {
//                        $resultalocateQty   = $inventory->getallocateQtyStockMaster($itemcode, $idofstockmaster);
//                        $rowalocateQty      = mysqli_fetch_array($resultalocateQty);
//                        $allocatequantity   = $rowalocateQty[0];
//                        
//                        $newavailable       = $availableqty - $bilqtu;
//                        $newallocateQty     = $allocatequantity + $quantity;
//                        
//                        $arrstock[0]        = $newavailable;
//                        $arrstock[1]        = $newallocateQty;
//                        $inventory->updatingStockonStockMaster($dbstockmaster, $arrstock, $itemcode, $grnstatus, $idofstockmaster);
//                        
//                        $bilqtu             = 0;
//                        $availableqty       = $newavailable;
//                        break;
//                    }                    
//                }
//            }
        }
        ?>
        <div class="row col-lg-12">
            <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="alert alert-success">
                        <strong>Alert !   </strong>Ordered SuccessFully<br>
                    </div>
                </div>
            <div class="col-lg-3"></div>
        </div>		
        <script type="text/javascript">
            setTimeout("location.href = 'salesorder.php';",1000);	// Page Dillay 2 Second
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
            setTimeout("location.href = 'salesorder.php';",1000);	// Page Dillay 2 Second
        </script>
        <?php  
    }
    
	

?>
</html>
