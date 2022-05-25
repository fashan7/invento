<?php 
    session_start();	
    $logusername =      $_SESSION['username'];
    $loguserid =        $_SESSION['userid'];
    $loguserbranch =    $_SESSION['branch'];

    include 'ControllerPage.php';
    include 'ControllerQuery.php';
    include 'ControllerStock.php';
    include 'ControllerCustomer.php';
    include 'ControllerUsers.php';
    include 'ControllerInventory.php';

    $obj            = new AccountSettings();
    $object         = new sqlfunctions();
    $stock          = new stockfunctions();
    $customer       = new customerfunctions();
    $usersettings   = new userfunctions();
    $inventory      = new inventoryfunction();
    ?> 
    <form class="form" id="approvalform" name="approvalform" action="inventoryApproved.php" method="post" enctype="multipart/form-data">
    <input type="hidden" id="sectioninv" name="sectioninv" value="<?=$_POST['section']?>">
    <?php
    if(empty($_POST['section']) || empty($_POST['orderno']))
    {
        ?>
            <center><i><b>Please Dont Leave Empty</b></i></center>
        <?php
        exit;
    }
    else if($_POST['section'] == 'po')
    {
        $result1 = $inventory->getPurchaseOrdersbyPO($_POST['orderno']);
        $row1 = mysqli_fetch_array($result1);
        
        $resultsupplier = $customer->selectsupplierbyid($row1['supplier']);
        $rowsupp = mysqli_fetch_array($resultsupplier);
       ?>
       <div class="col-md-1"></div>
       <div class="col-md-10 panel form-element-padding">
            <div class="panel-body">  
                <table id="myTable" class=" table order-list">
                    <thead>
                        <tr>
                            <th scope="col"><i>Purchase Order No</i></th>
                            <th scope="col"><i>Purchase Order Date</i></th>
                            <th scope="col"><i>Supplier Name</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td data-label="PO No">
                                <b><?=$row1['purchase_no'];?></b>
                            </td>
                            <td data-label="PO Date">
                                <b><?=$row1['purchase_date'];?></b>
                            </td>
                            <td data-label="Supplier Name">
                                <b><?=$rowsupp['name']?></b>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table id="myTable" class=" table order-list">
                    <thead>
                        <tr>
                            <th scope="col">Item Name</th>
                            <th scope="col">Item Code</th>                            
                            <th scope="col">Unit Price (Rs)</th>
                            <th scope="col">Selling Price (Rs)</th>
                            <th scope="col">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                         $result = $inventory->getPurchaseOrdersbyPO($_POST['orderno']);
                         $i = 1;
                         while($row = mysqli_fetch_array($result))
                         {                             
                        ?>
                        <tr>
                            <td data-label="Item Name">
                                <input type="text" class="form-control" name="itemname<?=$i?>" id="itemname<?=$i?>" autocomplete="off" value="<?=$row['itemname']?>" readonly>
                                <input type="hidden" name="poID<?=$i?>" id="poID<?=$i?>" value="<?=$row['id']?>">
                                <input type="hidden" name="PO<?=$i?>" id="PO<?=$i?>" value="<?=$row['purchase_no']?>">
                            </td>
                            <td data-label="Item Code">
                                <input type="text" class="form-control" name="itemcode<?=$i?>" id="itemcode<?=$i?>" autocomplete="off" value="<?=$row['itemcode']?>" readonly>
                            </td>
                            <td data-label="Unit Price">
                                <input type="text" class="form-control" name="unitprice<?=$i?>" id="unitprice<?=$i?>" autocomplete="off" value="<?=$row['unitprice']?>" style="text-align: right" readonly>
                            </td>
                            <td data-label="Selling Price">
                                <input type="text" class="form-control" name="sellingprice<?=$i?>" id="sellingprice<?=$i?>" autocomplete="off" value="<?=$row['sellprice']?>" style="text-align: right" readonly>
                            </td>
                            <td data-label="Quantity">
                                <input type="text" class="form-control" name="quantity<?=$i?>" id="quantity<?=$i?>" autocomplete="off" value="<?=$row['quantity']?>" readonly>
                            </td>
                        </tr>
                        <?php
                            $i++;
                         }
                        ?>
                    </tbody>
                </table>
           </div>
        </div>
        <div class="col-md-1">
            <input type="hidden" name="countID" id="countID" value="<?=$i?>">
        </div>
       <?php
    }
    else if($_POST['section'] == 'grn')
    {   
        $result1 = $inventory->selectGrnListSummary($_POST['orderno']);    
        $row1 = mysqli_fetch_array($result1);
        
        $resultsupplier = $customer->selectsupplierbyid($row1['supplier_id']);
        $rowsupp = mysqli_fetch_array($resultsupplier);
        
        
        $resultmasters = $inventory->selectGrnListMasters($_POST['orderno']);  
        $rowmaster  = mysqli_fetch_array($resultmasters);
       ?>
       <div class="col-md-1"></div>
       <div class="col-md-10 panel form-element-padding">
            <div class="panel-body">
				<input type="hidden" name="grnno" id="grnno" value="<?=$_POST['orderno']?>">
                <table id="myTable" class=" table order-list">
                    <thead>
                        <tr>
                            <th scope="col"><i>GRN No</i></th>
                            <th scope="col"><i>GRN Date</i></th>
                            <th scope="col"><i>Supplier Name</i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td data-label="GRN No">
                                <b><?=$_POST['orderno'];?></b>
                            </td>
                            <td data-label="GRN Date">
                                <b><?=$row1['grn_date'];?></b>
                            </td>
                            <td data-label="Supplier Name">
                                <b><?=$rowsupp['name'];?></b>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table id="myTable" class=" table order-list">
                    <thead>
                        <tr>
                            <th scope="col">Item Name</th>
                            <th scope="col">Item Code</th>                            
                            <th scope="col">Unit Price (Rs)</th>
                            <th scope="col">Selling Price (Rs)</th>
                            <th scope="col">GRN Quantity</th>
                            <th scope="col">Amount (Rs)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                         $result = $inventory->selectGrnListSummary($_POST['orderno']);
                         $i = 1;
                         while($row = mysqli_fetch_array($result))
                         {                             
                        ?>
                        <tr>
                            <td data-label="Item Name">
                                <input type="text" class="form-control" name="itemname<?=$i?>" id="itemname<?=$i?>" autocomplete="off" value="<?=$row['item_name']?>" readonly>
                            </td>
                            <td data-label="Item Code">
                                <input type="text" class="form-control" name="itemcode<?=$i?>" id="itemcode<?=$i?>" autocomplete="off" value="<?=$row['item_code']?>" readonly>
                            </td>
                            <td data-label="Unit Price (Rs)">
                                <input type="text" class="form-control" name="unitprice<?=$i?>" id="unitprice<?=$i?>" autocomplete="off" value="<?=$row['unit_price']?>" style="text-align: right" readonly>
                            </td>
                            <td data-label="Selling Price (Rs)">
                                <input type="text" class="form-control" name="sellingprice<?=$i?>" id="sellingprice<?=$i?>" autocomplete="off" value="<?=$row['selling_price']?>" style="text-align: right" readonly>
                            </td>
                            <td data-label="GRN Quantity">
                                <input type="text" class="form-control" name="quantity<?=$i?>" id="quantity<?=$i?>" autocomplete="off" value="<?=$row['grn_quantity']?>" readonly>
                            </td>
                            <td data-label="Amount (Rs)">
                                <input type="text" class="form-control" name="quantity<?=$i?>" id="quantity<?=$i?>" autocomplete="off" value="<?=$row['amount']?>" readonly>
                            </td>
                        </tr>
                        <?php
                            $i++;
                         }
                        ?>
                    </tbody>
                </table>
                
                <table id="myTable" class="table total">
                <tbody class="colspanHead">                    
                    <tr>
                        <tr>
                           <td scope="col" colspan="4">&nbsp;</td>
                           <td scope="col">
                               <b><i>GRN TOTAL (Rs)</i></b>
                           </td>
                           <td scope="col">
                               <input type="text" class="form-control" onkeypress="return numOnly(event);" name="grntotal" id="grntotal" autocomplete="off" style="text-align: right;" readonly value="<?=$rowmaster['grn_total']?>">
                           </td>
                        </tr>
                        <tr>
                           <td scope="col" colspan="4">&nbsp;</td>
                           <td scope="col">
                               <b><i>Discount</i></b>
                           </td>
                           <td scope="col">
                               <input type="text" class="form-control" onkeypress="return numOnly(event);" name="grndiscount" id="grndiscount" autocomplete="off" style="text-align: right;" readonly value="<?=$rowmaster['discount']?>">
                               <input type="hidden" name="discountamount" id="discountamount" value="<?=$rowmaster['discount_amount']?>">
                           </td>
                        </tr>
                        <tr>
                           <td scope="col" colspan="4">&nbsp;</td>
                           <td scope="col">                               
                               <b><i>NBT 2 %</i></b>
                           </td>
                           <td scope="col">
                               <input type="text" class="form-control" onkeypress="return numOnly(event);" name="grnnbt" id="grnnbt" autocomplete="off" style="text-align: right;" readonly value="<?=$rowmaster['nbt_amount'];?>">
                           </td>
                        </tr>
                        <tr>
                           <td scope="col" colspan="4">&nbsp;</td>
                           <td scope="col">                                   
                                <b><i>VAT 15 %</i></b>
                           </td>
                           <td scope="col">
                               <input type="text" class="form-control" onkeypress="return numOnly(event);" name="grnvat" id="grnvat" autocomplete="off" style="text-align: right;" readonly value="<?=$rowmaster['vat_amount'];?>">
                           </td>
                        </tr>
                        <tr>
                           <td scope="col" colspan="4">&nbsp;</td>
                           <td scope="col">
                               <b><i>Sub TOTAL (Rs)</i></b>
                           </td>
                           <td scope="col">
                               <input type="text" class="form-control" onkeypress="return numOnly(event);" name="subtotal" id="subtotal" autocomplete="off" style="text-align: right;" readonly value="<?=$rowmaster['subtotal'];?>">
                           </td>
                        </tr>   
                    </tr>
                </tbody>
            </table>
           </div>
        </div>
        <div class="col-md-1">
            <input type="hidden" name="countID" id="countID" value="<?=$i?>">
            <input type="hidden" name="grnno" id="grnno" value="<?=$_POST['orderno']?>">
        </div>
       <?php
    }
?>
    <div class="panel-body">
        <div class="col-md-9"></div>
            <div class="col-md-3">
                <button type="submit" name="save" id="save" style="margin-top:0px !important;" class="btn-flip btn btn-3d btn-primary">
                    <div class="flip">
                        <div class="side">
                            Approve <span class="fa fa-check"></span>
                        </div>
                        <div class="side back">
                            are you sure?
                        </div>
                    </div>
                    <span class="icon"></span>
                </button>
            </div>
        </div>
    </form>