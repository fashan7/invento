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
<?php 
    include 'ControllerPage.php';
    include 'ControllerQuery.php';
    include 'ControllerStock.php';
    include 'ControllerCustomer.php';
    include 'ControllerUsers.php';
    include 'ControllerSales.php';

    $obj            = new AccountSettings();
    $object         = new sqlfunctions();
    $stock          = new stockfunctions();
    $customer       = new customerfunctions();
    $usersettings   = new userfunctions();
    $sales          = new salesFunction();

    $billno = $_GET['billno'];
    
    
?>

    <div class="panel-body" style="padding-bottom:30px;">
        <div class="form-element">
              <div class="col-md-12 padding-0">                       
                <div class="col-md-12">                
                  <div class="panel form-element-padding">  
                    <div class="panel-body" style="padding-bottom:30px;">
                        <h4>Issue Note For Invoice No. <?=$billno?></h4>
                        <?php
                        $sqlselectbillmasterno = $sales->selectbillmasterno($billno);
                        $countselectbillmasterno = mysqli_num_rows($sqlselectbillmasterno);
                        if($countselectbillmasterno <= 0 )
                        {
                            echo "NO DATA";
                        }
                        else
                        {
                        ?>


                        <table id="myTable" class=" table order-list">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Invoice No</th>
                                        <th scope="col">Item Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Free Issue</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Warehouse</th>
                                        <th scope="col">Shipping Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while($fetchselectbillmasterno = mysqli_fetch_array($sqlselectbillmasterno))
                                    {
                                    ?>
                                    <tr>
                                        <td data-label="#">
                                            <label><?=$i?></label>
                                        </td>
                                        <td data-label="Invoice No">
                                            <label><?=$fetchselectbillmasterno['billno']?></label>
                                        </td>
                                        <td data-label="Item Name">
                                            <?php
                                            $itemid = $fetchselectbillmasterno['itemid'];
                                            $sqlselectstockregbyid = $stock->selectstockregbyid($itemid);
                                            $fetchselectstockregbyid = mysqli_fetch_array($sqlselectstockregbyid);
                                            ?>
                                            <label><?=$fetchselectstockregbyid['name']?></label>
                                        </td>
                                        <td data-label="Quantity">
                                            <label><?=$fetchselectbillmasterno['quantity']?></label>   
                                        </td>
                                        <td data-label="Free Issue">
                                            <label><?=$fetchselectbillmasterno['issue']?></label>   
                                        </td>
                                        <td data-label="Customer">
                                            <?php
                                            $customerid = $fetchselectbillmasterno['customer'];
                                            $sqlselectcustomerbyid = $customer->selectcustomerbyid($customerid);
                                            $fetchselectcustomerbyid = mysqli_fetch_array($sqlselectcustomerbyid);
                                            ?>
                                            <label><?=$fetchselectcustomerbyid['name']?></label>   
                                        </td>
                                        <td data-label="Warehouse">
                                            <?php
                                            $warehouseid = $fetchselectbillmasterno['warehouse'];
                                            $sqlselectwherehouseid = $sales->selectwherehouseid($warehouseid);
                                            $fetchselectwherehouseid = mysqli_fetch_array($sqlselectwherehouseid);
                                            ?>
                                            <label><?=$fetchselectwherehouseid['name']?></label>
                                        </td>
                                        <td data-label="Shipping Address">
                                            <label><?=$fetchselectbillmasterno['delivery']?></label>
                                        </td>
                                    </tr>
                                    <?php
                                     $i++;
                                    }
                                    ?>
                            </tbody>
                        </table> 

                            <?php
                            } 
                            ?>

                    </div>                         
                  </div>                      
                </div>
              </div>
          </div>
      </div>