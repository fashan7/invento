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

    $customerid = $_GET['customerid'];
    
    
?>
                <div class="form-element">
                  <div class="col-md-12 padding-0">                       
                    <div class="col-md-12">
                      <div class="panel form-element-padding">  
                        <div class="panel-body" style="padding-bottom:30px;">
                            <table id="myTable" class=" table order-list">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Invoice No</th>
                                            <th scope="col">Invoice Date</th>
                                            <th scope="col">Total(Rs)</th>
                                            <th scope="col">Credit Amount(Rs)</th>
                                            <th scope="col">Select</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i =1;
                                        $sqlselectbycustomerid = $sales->selectbycustomerid($customerid);
                                        while($fetchselectbycustomerid = mysqli_fetch_array($sqlselectbycustomerid))
                                        {
                                        ?>
                                        <tr>
                                            <td data-label="#">
                                                <label><?=$i;?></label>
                                            </td>
                                            <td data-label="Invoice No" data-toggle="modal" data-target="#myModal<?=$i;?>">
                                                <label ><?=$fetchselectbycustomerid['billNo'];?></label>
                                            </td>
                                            <td data-label="Invoice Date">
                                                <label><?=$fetchselectbycustomerid['billDate'];?></label>
                                            </td>
                                            <td data-label="Total(Rs)">
                                                <label><?=number_format($fetchselectbycustomerid['subTotal'],2);?></label>
                                            </td>
                                            <td data-label="Credit Amount(Rs)">
                                                <label><?=number_format($fetchselectbycustomerid['paybalense'],2);?></label>
                                                <input type = "hidden" name = "creditamount<?=$i?>" id = "creditamount<?=$i?>" value = "<?=$fetchselectbycustomerid['paybalense']?>">
                                            </td>
                                            <td data-label="Select">
                                                <div class="form-animate-checkbox" style = "margin-left:50%;">
                                                <input type="hidden" name = "billno<?=$i?>" id = "billno<?=$i?>" value = "<?=$fetchselectbycustomerid['billNo'];?>">
                                                <input type="radio" class="checkbox" name = "checkpay" id = "checkpay" onclick = "getpaytext(<?=$i?>);">
                                                </div>
                                            </td>
                                        </tr> 
                                        <div class="container">
                                            <div class="modal fade" id="myModal<?=$i;?>" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Items Purchased For Invoice No. <?=$fetchselectbycustomerid['billNo'];?></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                           
                                                            <?php
                                                            $billno = $fetchselectbycustomerid['billNo'];
                                                            $sqlselectbybillno = $sales->selectbybillno($billno);
                                                            while($fetchselectbybillno = mysqli_fetch_array($sqlselectbybillno))
                                                            {
                                                                $itemid = $fetchselectbybillno['itemid'];
                                                                $sqlselectstockregbyid = $stock->selectstockregbyid($itemid);
                                                                $fetchselectstockregbyid = mysqli_fetch_array($sqlselectstockregbyid);
                                                            ?>
                                                                    
                                                          <p><?=$fetchselectstockregbyid['name'];?> &times; <?=$fetchselectbybillno['quantity'];?> </p>
                                                            <?php
                                                            }
                                                            ?>
                                                                
                                                        </div>
                                                        <div class="modal-footer">
                                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            $i++;
                                        }
                                        ?>
                                        <input type="hidden" name = "rowcount" id = "rowcount" value = "<?=$i?>">

                                </tbody>
                            </table> 
                             <div id = "getpaytextdiv">
                            
                            </div>
                        </div>                         
                      </div>                      
                    </div>
                         
                  </div>
              </div>
