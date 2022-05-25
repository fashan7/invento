<?php
session_start();
    $logusername   =     $_SESSION['username'];
    $loguserid     =     $_SESSION['userid'];
    $loguserbranch =     $_SESSION['branch'];

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

    if(empty($_POST['invoiceno']))
    {
        $error = true;
        ?>
        <div class="row col-lg-12">
		  <div class="col-lg-3"></div>
		  <div class="col-lg-6">
			<div class="alert alert-danger">
                <strong>Alert !   </strong>Could Not Load Invoice No <br>
            </div>
          </div>
          <div class="col-lg-3"></div>
		</div>		
        <?php    
    }
    
    if(empty($_POST['invoicedate']))
    {
        $error = true;
        ?>
        <div class="row col-lg-12">
		  <div class="col-lg-3"></div>
		  <div class="col-lg-6">
			<div class="alert alert-danger">
                <strong>Alert !   </strong>Please Fill the Invoice Date<br>
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
    
    for($i = 1; $i < $numrows; $i++)
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
        $maxinvoiceIdResult = $sales->maxInvoiceNo();
        $rowmaxinvoiceId    = mysqli_fetch_array($maxinvoiceIdResult);

        if($rowmaxinvoiceId[0] == '')
        {
            $invoiceno = '0001';
        }
        else
        {
            $incrementorder = $rowmaxinvoiceId[0] + 1;
            $invoiceno = str_pad($incrementorder, 4, '0', STR_PAD_LEFT);
        }
        
        $invoiceno        = $invoiceno;
        
        $invoicedate      = $_POST['invoicedate'];
        $invoicedate      = mysqli_real_escape_string($obj->bridge, $invoicedate);

        $customername     = $_POST['customername'];
        $customername     = mysqli_real_escape_string($obj->bridge, $customername);
        
        $customerids      = $_POST['customerid'];
        $customerids      = mysqli_real_escape_string($obj->bridge, $customerids); 
        
        $customercode     = $_POST['customercode'];
        $customercode     = mysqli_real_escape_string($obj->bridge, $customercode);

        $phone            = $_POST['phone'];
        $phone            = mysqli_real_escape_string($obj->bridge, $phone);

        $address          = $_POST['address'];
        $address          = mysqli_real_escape_string($obj->bridge, $address);

        $warehouse        = $_POST['warehouse'];
        $warehouse        = mysqli_real_escape_string($obj->bridge, $warehouse);

        $salesrep         = $_POST['salesrep'];
        $salesrep         = mysqli_real_escape_string($obj->bridge, $salesrep);
        
        $billref          = $_POST['billref'];
        $billref          = mysqli_real_escape_string($obj->bridge, $billref);
        
        $total                 = mysqli_real_escape_string($obj->bridge, $_POST['total']);
        $totaldiscount         = mysqli_real_escape_string($obj->bridge, $_POST['totaldiscount']);    
        $totaldiscountamount   = mysqli_real_escape_string($obj->bridge, $_POST['totaldiscountamount']);    
        $totalnbt              = mysqli_real_escape_string($obj->bridge, $_POST['totalnbt']);
        $totalvat              = mysqli_real_escape_string($obj->bridge, $_POST['totalvat']);
        $subtotal              = mysqli_real_escape_string($obj->bridge, $_POST['subtotal']);
        
        $paymentmethod         = mysqli_real_escape_string($obj->bridge, $_POST['paymentmethod']);
        $nextpaymentdate       = mysqli_real_escape_string($obj->bridge, $_POST['nextpaymentdate']);
        $paymentduration       = mysqli_real_escape_string($obj->bridge, $_POST['paymentduration']);
        
        
        $paybalance            = $subtotal; // $subtotal - $downpayment
        
        
        date_default_timezone_set('Asia/Colombo');
        $time                  = date('H:i:s:A');

        date_default_timezone_set('Asia/Colombo');
        $date                  = date('Y-m-d');
        
        $datetime = $date." ".$time;
        
        $arr = array();
        $arr[0]     = $invoiceno;
        $arr[1]     = $invoicedate;
        $arr[2]     = $datetime;
        $arr[3]     = $total;
        $arr[4]     = $totaldiscount;
        $arr[5]     = $totaldiscountamount;
        $arr[6]     = $subtotal;
        $arr[7]     = $object->getTime();      
        $arr[8]     = $loguserid;
        $arr[9]     = $customerids;
        $arr[10]    = $paymentmethod; 
        $arr[11]    = $paybalance;
        $arr[12]    = $paymentduration;
        $arr[13]    = $nextpaymentdate;
        $arr[14]    = '0'; 
        $arr[15]    = $totalvat;
        $arr[16]    = $totalnbt;
        $arr[17]    = $salesrep;
        $arr[18]    = 'yes';
        $arr[19]    = 'yes';
        $arr[20]    = 'direct invoice';
        $arr[21]    = $warehouse;
        $arr[22]    = '';
        $arr[23]    = '';
        $arr[24]    = '';
        $arr[25]    = '';
        $arr[26]    = $billref;
        $arr[27]    = '';
        $arr[28]    = '';
        $arr[29]    = $loguserbranch;
        $arr[30]    = 'id';
         
        $dbnamesummary     = 'bill_summary';
        $object->insertion($dbnamesummary, $arr);
        
        $directarr      = array();
        $directarr[0]   = $invoiceno;
        $directarr[1]   = $invoicedate;
        $directarr[2]   = $customerids;
        $directarr[3]   = $billref;
        $directarr[4]   = $salesrep;
        $directarr[5]   = $total;
        $directarr[6]   = $totalnbt;
        $directarr[7]   = $totalvat;
        $directarr[8]   = $subtotal;
        $directarr[9]   = $paymentmethod;
        $directarr[10]  = $nextpaymentdate;
        $directarr[11]  = $subtotal;
        $directarr[12]  = 'no';
        $directarr[13]  = 'yes';
        $directarr[14]  = 'id';
        $directarr[15]  = $warehouse;
        $dbdirectinvoice= 'direct_invoice';
        $object->insertion($dbdirectinvoice, $directarr); //insertion for direct invoice table
        
        $j = 1;
        $subpayment   = $subtotal; // $subtotal - $downpayment
        for($i = 1; $i <= $paymentduration; $i++)
        {
            $minus = $j-1;
            $incrementdate = date('Y-m-d', strtotime('+'.$minus.' month', strtotime($nextpaymentdate)));
            
            $paymentamount      = $subpayment / $paymentduration;
            $dbnameeasypayment  = 'easy_payment';
            $easyArr            = array();
            $easyArr[0]         = $invoiceno;
            $easyArr[1]         = $paymentamount;
            $easyArr[2]         = $incrementdate;            
            $easyArr[3]         = 'not settle';
            $easyArr[4]         = 'yes';
            $easyArr[5]         = 'id';
            $object->insertion($dbnameeasypayment, $easyArr);
            $j++;
        }
        
        echo $numrows;
        for($i = 1; $i <= $numrows; $i++)
        {   
            $itemname       = mysqli_real_escape_string($obj->bridge, $_POST['itemname'.$i]);
            $itemcode       = mysqli_real_escape_string($obj->bridge, $_POST['itemcode'.$i]);        
            $sellprice      = mysqli_real_escape_string($obj->bridge, $_POST['sellprice'.$i]);            
            $quantity       = mysqli_real_escape_string($obj->bridge, $_POST['quantity'.$i]);
            $hidquan        = mysqli_real_escape_string($obj->bridge, $_POST['hidquan'.$i]);
            $amount         = mysqli_real_escape_string($obj->bridge, $_POST['amount'.$i]);    
            $discount       = mysqli_real_escape_string($obj->bridge, $_POST['discount'.$i]);    
            $showdiscount   = mysqli_real_escape_string($obj->bridge, $_POST['showdiscount'.$i]);
            $netvalue       = mysqli_real_escape_string($obj->bridge, $_POST['netvalue'.$i]);

            $resultitem     = $stock->selectstockregbycode($itemcode);
            $rowitem        = mysqli_fetch_array($resultitem);
            $itemid         = $rowitem['id'];

            $dbnameorder = 'bill_master';
            $arrr = array();
            $arrr[0]  = $invoiceno;
            $arrr[1]  = $invoicedate;
            $arrr[2]  = $itemcode;
            $arrr[3]  = $itemid;
            $arrr[4]  = $warehouse;
            $arrr[5]  = $quantity;
            $arrr[6]  = '0';
            $arrr[7]  = '0';
            $arrr[8]  = $sellprice;
            $arrr[9]  = $amount;
            $arrr[10] = $netvalue;
            $arrr[11] = $showdiscount;
            $arrr[12] = $discount;
            $arrr[13] = $customerids;
            $arrr[14] = $paymentmethod; 
            $arrr[15] = 'yes';
            $arrr[16] = 'yes';
            $arrr[17] = $object->getTime();
            $arrr[18] = $salesrep;
            $arrr[19] = '';
            $arrr[20] = '';
            $arrr[21] = '';
            $arrr[22] = '';
            $arrr[23] = '';
            $arrr[24] = '';
            $arrr[25] = $loguserid;
            $arrr[26] = 'id';
            $object->insertion($dbnameorder, $arrr);        
                
            $qty = $quantity;
            if($quantity > $hidquan)
            {}
            else
            {
                $bilqtu = $qty;
                $result = $inventory->getDetailsofStockMaster($itemcode);
                while($row = mysqli_fetch_array($result))
                {
                    $grnno          = $row[3];
                    $grnstatus      = $row[4];
                    $availableqty   = $row[1];
                    $idofstockmaster= $row[5];
                    $dbstockmaster  = 'stock_master';  
                    $arrstock       = array();

                    if($bilqtu > $availableqty)
                    {
                        if($availableqty != 0)
                        {
                            $resultalocateQty   = $inventory->getallocateQtyStockMaster($itemcode, $idofstockmaster);
                            $rowalocateQty      = mysqli_fetch_array($resultalocateQty);
                            $allocatequantity   = $rowalocateQty[0];

                            $newbillqty         = $bilqtu - $availableqty;
                            $allocatequantity   = $availableqty;
                            $availableqty       = '0';

                            $newallocateQty     = $allocatequantity + $availableqty;

                            $arrstock[0]        = $availableqty;
                            $arrstock[1]        = $newallocateQty;
                            $inventory->updatingStockonStockMaster($dbstockmaster, $arrstock, $itemcode, $grnstatus, $idofstockmaster);

                            $bilqtu             = $newbillqty;
                        }
                    }
                    else
                    {
                        $resultalocateQty   = $inventory->getallocateQtyStockMaster($itemcode, $idofstockmaster);
                        $rowalocateQty      = mysqli_fetch_array($resultalocateQty);
                        $allocatequantity   = $rowalocateQty[0];

                        $newavailable       = $availableqty - $bilqtu;
                        $newallocateQty     = $allocatequantity + $quantity;

                        $arrstock[0]        = $newavailable;
                        $arrstock[1]        = $newallocateQty;
                        $inventory->updatingStockonStockMaster($dbstockmaster, $arrstock, $itemcode, $grnstatus, $idofstockmaster);

                        $bilqtu             = 0;
                        $availableqty       = $newavailable;
                        break;
                    }                    
                }
            }  
        }
        ?>
        <div class="row col-lg-12">
            <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="alert alert-success">
                        <strong>Alert !   </strong>Direct Invoice SuccessFully<br>
                    </div>
                </div>
            <div class="col-lg-3"></div>
        </div>		
        <script type="text/javascript">
            setTimeout("location.href = 'directinvoice.php';",1000);	// Page Dillay 2 Second
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
            setTimeout("location.href = 'directinvoice.php';",1000);	// Page Dillay 2 Second
        </script>
        <?php  
    } ?>