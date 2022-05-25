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

        $obj 			= new sqlfunctions();
		$inventory      = new inventoryfunction();
		
       	$resultpurchase = $inventory->getPurchaseOrders();
		$count = mysqli_num_rows($resultpurchase);
		if($count > 0)
		{
			$purchaseno = "100".$count + 1;
		}
		else 
		{
			$purchaseno = "1001";
		}
        
        if(empty($_POST['purchaseno']))
        {
            $error = true;
            ?> 
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="alert alert-info">
                    <strong>Alert !   </strong>Please Provide Purchase No Cannot Erase<br>
  			   </div>
            </div>
		    <div class="col-lg-3"></div>
            <?php
        }
        
        if(empty($_POST['purchasedate']))
        {
            $error = true;
            ?> 
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="alert alert-info">
                    <strong>Alert !   </strong>Please Provide Purchasing Date<br>
  			   </div>
            </div>
		    <div class="col-lg-3"></div>
            <?php
        }
        
        if(empty($_POST['supplierid']))
        {
            $error = true;
            ?> 
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="alert alert-info">
                    <strong>Alert !   </strong>Please Select a Supplier<br>
  			   </div>
            </div>
		    <div class="col-lg-3"></div>
            <?php
        }
        
        if(empty($_POST['itemcat']))
        {
            $error = true;
            ?> 
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="alert alert-info">
                    <strong>Alert !   </strong>Please Select a Category to Put Order<br>
  			   </div>
            </div>
		    <div class="col-lg-3"></div>
            <?php
        }
        
        for($i = 1; $i <= $_POST['nums']; $i++)
        {
            if(empty($_POST['itemname'.$i]))
            {
                $error = true;
                ?> 
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="alert alert-info">
                        <strong>Alert !   </strong>Please Complete the Item Name of <?=$i?> Row<br>
  			       </div>
                </div>
		      <div class="col-lg-3"></div>
              <?php
            }
                        
            if(empty($_POST['itemcode'.$i]))
            {
                $error = true;
                ?> 
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="alert alert-info">
                        <strong>Alert !   </strong>Please Complete the Item Code of <?=$i?> Row<br>
  			       </div>
                </div>
		      <div class="col-lg-3"></div>
              <?php
            }
            
            if(empty($_POST['unitprice'.$i]))
            {
                $error = true;
                ?> 
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="alert alert-info">
                        <strong>Alert !   </strong>Please Complete the Unit Price of <?=$i?> Row<br>
  			       </div>
                </div>
		      <div class="col-lg-3"></div>
              <?php
            }
            
            if(empty($_POST['sellprice'.$i]))
            {
                $error = true;
                ?> 
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="alert alert-info">
                        <strong>Alert !   </strong>Please Complete the Sell Price of <?=$i?> Row<br>
  			       </div>
                </div>
		      <div class="col-lg-3"></div>
              <?php
            }
            
            if(empty($_POST['quantity'.$i]))
            {
                $error = true;
                ?> 
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="alert alert-info">
                        <strong>Alert !   </strong>Please Complete the Quantity of <?=$i?> Row<br>
  			       </div>
                </div>
		      <div class="col-lg-3"></div>
              <?php
            }
        }
    
        
        if(!$error)
        {
            $purchaseno = $purchaseno;
            $purchasedate = $_POST['purchasedate'];
            $supplierid = $_POST['supplierid'];
            $itemcat = $_POST['itemcat'];
        
		    for($i = 1; $i <= $_POST['nums']; $i++)
            {
                $itemname = $_POST['itemname'.$i];
                $itemcode = $_POST['itemcode'.$i];
                $unitprice = $_POST['unitprice'.$i];
                $sellprice = $_POST['sellprice'.$i];
                $quantity = $_POST['quantity'.$i];
                
                $arr = array();
                $arr[0]  = mysqli_real_escape_string($obj->bridge, $purchaseno);
                $arr[1]  = mysqli_real_escape_string($obj->bridge, $purchasedate);
                $arr[2]  = mysqli_real_escape_string($obj->bridge, $supplierid);
                $arr[3]  = mysqli_real_escape_string($obj->bridge, $itemcat);
                $arr[4]  = mysqli_real_escape_string($obj->bridge, $itemname);
                $arr[5]  = mysqli_real_escape_string($obj->bridge, $itemcode);
                $arr[6]  = mysqli_real_escape_string($obj->bridge, $unitprice);
                $arr[7]  = mysqli_real_escape_string($obj->bridge, $sellprice);
                $arr[8]  = mysqli_real_escape_string($obj->bridge, $quantity);
                $arr[9]  = mysqli_real_escape_string($obj->bridge, $quantity);
                $arr[10] = 'yes';
                $arr[11] = 'yes';
                $arr[12] = 'id';
                $db = 'purchase_order';
                $obj->insertion($db, $arr);
            }
            
            $arra = array();
            $arra[0] = $loguserid; $arra[1] = $obj->getTime(); $arra[2] = $obj->getDate(); $arra[3] = 'Purchased An Order - PO is '." ".$purchaseno; $arra[4] = 'id';
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
               setTimeout("location.href = 'purchaseorder.php';",2000);	// Page Dillay 2 Second
            </script> 
        <?php
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
                    setTimeout("location.href = 'purchaseorder.php';",2000);	// Page Dillay 2 Second
                </script>
            <?php     
        }
        ?>
	