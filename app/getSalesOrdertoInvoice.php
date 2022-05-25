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

    if(empty($_POST['salesorderno']))
    {
        ?>
        <center><b><i>Please Select Order No</i></b></center>    
        <?php
        exit;
    }
    $orderno        = $_POST['salesorderno'];  

    $result         = $sales->getAllDetailsofSalesOrderbyONo($orderno);
    $row            = mysqli_fetch_array($result);

    $customerid      = $row['customerid'];

    $resultCustomer = $customer->selectcustomerbyid($customerid);
    $rowCustomer    = mysqli_fetch_array($resultCustomer);

    date_default_timezone_set('Asia/Colombo');
    $nowdate           = date('Y-m-d');

?>
<style>
table {
  border: 1px solid #ccc;
  border-collapse: collapse;
  margin: 0;
  padding: 0;
  width: 100%;
  table-layout: fixed;
}
table caption {
  font-size: 1.5em;
  margin: .5em 0 .75em;
}
table tr {
  background: #f8f8f8;
  border: 1px solid #ddd;
  padding: .35em;
}
table th,
table td {
  padding: .625em;
  text-align: center;
}
table th {
  font-size: .85em;
  letter-spacing: .1em;
  text-transform: uppercase;
}
@media screen and (max-width: 600px) {
  table {
    border: 0;
  }
  table caption {
    font-size: 1.3em;
  }
  table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  table tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: .625em;
  }
  table td {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: right;
  }
  table td:before {
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
  table td:last-child {
    border-bottom: 0;
  }
}
</style>  
<script>
function removeid(id)
{
    if(document.getElementById("del"+id).checked)
    {
		document.getElementById("shownetvalue"+id).value = 0;
    }
    else 
    {
		document.getElementById("shownetvalue"+id).value = document.getElementById("netvalue"+id).value;
    }
}

function enableDiscount()
{
    if(document.getElementById("confirmdiscount").checked)
    {
        document.getElementById("totaldiscount").readOnly = false;
    }
    else        
    {
        document.getElementById("totaldiscount").readOnly = true;
        document.getElementById("totaldiscount").value = 0;
		document.getElementById("totaldiscountamount").value = 0;
    }
}

function enableNbt()
{
    if(document.getElementById("confirmnbt").checked)
    {
        document.getElementById("totalnbt").readOnly = true;
    }
    else        
    {
        document.getElementById("totalnbt").readOnly = true;
        document.getElementById("totalnbt").value = 0;
    }
}
    
function enableVat()
{
    if(document.getElementById("confirmvat").checked)
    {
        document.getElementById("totalvat").readOnly = true;
    }
    else        
    {
        document.getElementById("totalvat").readOnly = true;
        document.getElementById("totalvat").value = 0;
    }
}
 
function DiscountCalculation()
{
    var discount = 0;
	
	if(document.getElementById("totaldiscount").value == '')
	{
		discount = 0;
	}
	else
	{
		discount = parseFloat(document.getElementById("totaldiscount").value);
	}
	
    var total = parseFloat(document.getElementById("total").value);
    
    sum = total * discount / 100;
    document.getElementById("totaldiscountamount").value = sum;
	
	enableDiscount();
	inSubTotal();
}
	
function NbtCalculation()
{
	var nbt = 2;
    var total = 0;
    if(document.getElementById("totaldiscount").value == '')
    {
        total = parseFloat(document.getElementById("total").value);
    }
    else
    {
        DiscountCalculation();
        var sumdiscount = parseFloat(document.getElementById("total").value) - parseFloat(document.getElementById("totaldiscountamount").value);
        total = sumdiscount;
    }
     
    
    sum = total * nbt / 100;
    document.getElementById("totalnbt").value = sum;
	
	enableNbt();
	inSubTotal();
} 

function VatCalculation()
{
	var vat = 15;
    var total = 0;
    if(document.getElementById("totaldiscount").value == '')
    {
        total = parseFloat(document.getElementById("total").value);
    }
    else
    {
        DiscountCalculation();
        var sumdiscount = parseFloat(document.getElementById("total").value) - parseFloat(document.getElementById("totaldiscountamount").value);
        total = sumdiscount;
    }
    
    sum = total * vat / 100;
    document.getElementById("totalvat").value = sum;
	
	enableVat();
	inSubTotal();
}
    
function FullTotal()
{
    var sum = 0;    
    var loop = document.getElementById("numrows").value;
    
    for(i = 1; i < loop; i++)
    {
        var netvalue = parseFloat(document.getElementById("shownetvalue"+i).value);
        sum += netvalue;  
    }    
    document.getElementById("total").value = sum;
    document.getElementById("subtotal").value = sum;
	
    
	inSubTotal();
}
    
function inSubTotal()
{
	var total = parseFloat(document.getElementById("total").value);
	var discount = parseFloat(document.getElementById("totaldiscountamount").value);
	var nbt = parseFloat(document.getElementById("totalnbt").value);
	var vat = parseFloat(document.getElementById("totalvat").value);
	var sum = (total - discount) + nbt + vat;
	
	if(document.getElementById("total").value == 0)
	{
		document.getElementById("subtotal").value = 0;
		document.getElementById("totaldiscount").value = 0;
		document.getElementById("totaldiscountamount").value = 0;
		document.getElementById("totalnbt").value = 0;
		document.getElementById("totalvat").value = 0;
	}
	else
	{
		document.getElementById("subtotal").value = sum;
	}
}
 
function downpaymentchange()
{
    var paymentmethod = document.getElementById("paymentmethod").value;
    if(paymentmethod == 'easypayment')
    { 
//        document.getElementById("downpaymentdivlbl").style.display = 'block';
//        document.getElementById("downpaymentdivtxt").style.display = 'block';
        document.getElementById("paymentdurationselection").style.display = 'block';
        document.getElementById("paymentdurationlbl").style.display = 'block';
        document.getElementById("nextpaymentlbl").style.display = 'block';
        document.getElementById("nextpaymenttext").style.display = 'block';
        document.getElementById("downpayment").value = 0;
    }
    else 
    { 
//        document.getElementById("downpaymentdivlbl").style.display = 'none';
//        document.getElementById("downpaymentdivtxt").style.display = 'none';
        document.getElementById("paymentdurationselection").style.display = 'none';
        document.getElementById("paymentdurationlbl").style.display = 'none';        
        document.getElementById("nextpaymentlbl").style.display = 'none';
        document.getElementById("nextpaymenttext").style.display = 'none';
    }
}
    
$(document).ready(function(){
    $("#paymentduration").change(function(){
        var paymentduration = $("#paymentduration").val();
//        var downpayment = $("#downpayment").val();
        var subtotal = $("#subtotal").val();
        var nextpaymentdate = $("#nextpaymentdate").val();
        $.post("getpayementschedule.php", {
			paymentduration:paymentduration,
//            downpayment:downpayment,
            subtotal:subtotal,
            nextpaymentdate:nextpaymentdate
		},
			
		function(data,status) {
			$("#easypaymenttable").empty();			
			$("#easypaymenttable").append(data);
		});
    });
});

function numOnly(e) 
{
    var k;
    document.all ? k = e.keyCode : k = e.which;
    return ((k > 47 && k < 58));
}
</script>
<div class="form-element">
    <div class="col-md-12 padding-0"> 
        <div class="col-md-12">
            <div class="panel form-element-padding">
                <div class="panel-heading">
                    <h4>Sales Order No : <?=$orderno?></h4>
                </div>
                <div class="panel-body" style="padding-bottom:30px;">
                    <div class = "col-md-12">
                        <div class="col-md-4" style = "margin-bottom:20px;">
                            <label class="control-label text-right">Customer Name</label>
                            <input type="text" class="form-control android"  name="customername" id="customername" value="<?=$rowCustomer['name']?>">
                            <input type="hidden" class="form-control android"  name="customerid" id="customerid" value="<?=$customerid?>">
                        </div>                       
                        <div class="col-md-4" style = "margin-bottom:20px;"> 
                            <label>Cust Code</label>
                            <input type="text" class="form-control android" name="customercode" id="customercode" value="<?=$rowCustomer['code']?>">
                        </div>
                        <div class="col-md-4" style = "margin-bottom:20px;"> 
                            <label>Phone</label>
                            <input type="text" class="form-control android" name="phone" id="phone" value="<?=$rowCustomer['phone_no']?>">
                        </div>                                
                    </div>
                    <div class = "col-md-12">
                        <div class="col-md-9" style = "margin-bottom:20px;"> 
                            <label>Address</label>
                            <input type="text" class="form-control android" name="address" id="address" value="<?=$rowCustomer['address']?>">
                        </div>
                        <div class="col-md-3" style = "margin-bottom:20px;"> 
                            <label>Warehouse</label>
                            <select class="form-control " style="margin-bottom:20px;" name="warehouse" id="warehouse">
                                <option value="">-Please Select-</option>
                                <?php
                                $sqlwarehouse = $inventory->warehouse();
                                while($fetchwarehouse = mysqli_fetch_array($sqlwarehouse))
                                {
                                    if($row['warehouseid'] == $fetchwarehouse['id'])
                                    {
                                        ?>
                                        <option value = "<?=$fetchwarehouse['id']?>" selected><?=$fetchwarehouse['name']?></option>
                                        <?php         
                                    }
                                    else
                                    {
                                        ?>
                                        <option value = "<?=$fetchwarehouse['id']?>"><?=$fetchwarehouse['name']?></option>
                                        <?php 
                                    }
                                }
                                ?>   
                            </select>
                        </div>
                    </div>
                    <div class = "col-md-12">
                        <div class="col-md-4" style = "margin-bottom:20px;">
                            <label class="control-label text-right">Sales Rep</label>
                            <select class="form-control " style="margin-bottom:20px;" name="salesrep" id="salesrep">
                                <option value="">-Please Select-</option>
                                <?php 
                                $resultsalesrep = $usersettings->salesRep();
                                while($rowsalesrep = mysqli_fetch_array($resultsalesrep))
                                {
                                    ?>
                                    <option value="<?=$rowsalesrep[0]?>"><?=$rowsalesrep[1]." ".$rowsalesrep[2]?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4" style = "margin-bottom:20px;"> 
                            <label>Bill Reference</label>
                            <input type="text" class="form-control android" name="billref" id="billref" >
                        </div>
                        <div class="col-md-4" style = "margin-bottom:20px;"> 
                        </div>                                
                    </div>
                </div>
                <div class="panel-body" style="padding-bottom:30px;">
                    <table id="myTable" class=" table order-list">
                        <caption>Item Details</caption>
                        <thead>
                            <tr>
                                <th scope="col">Item Name</th>
                                <th scope="col">Item Code</th>
                                <th scope="col">Sell Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Amount (Rs)</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Net Value (Rs)</th>
                                <th scope="col">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $resultsales = $sales->getAllDetailsofSalesOrderbyONo($orderno);
                            $i = 1;
                            $totalam = 0;
                            while($rowsales = mysqli_fetch_array($resultsales))
                            {
                                $itemcode   = $rowsales['itemcode'];
                                $itemResult = $stock->selectstockregbycode($itemcode);
                                $rowItem    = mysqli_fetch_array($itemResult);
                                
                                $resultstock = $inventory->getQuantitybyItemCode($itemcode); //getting available stocks on stock_master
		                        $countstock = mysqli_fetch_array($resultstock);
                            ?>
                            <tr>
                                <td data-label="Item Name">
                                    <input type="text" class="form-control" name="itemname<?=$i?>" id="itemname<?=$i?>" readonly value="<?=$rowItem['name']?>">
                                </td>
                                <td data-label="Item Code">
                                    <input type="text" class="form-control" name="itemcode<?=$i?>" id="itemcode<?=$i?>" readonly value="<?=$rowItem['code']?>">
                                </td>
                                <td data-label="Sell Price">
                                    <input type="text"  class="form-control" name="sellprice<?=$i?>" id="sellprice<?=$i?>" autocomplete="off" style="text-align: right;" readonly value="<?=$rowsales['sellingprice']?>">
                                </td>
                                <td data-label="Quantity">
                                    <input type="text" class="form-control" onkeypress="return numOnly(event);" name="quantity<?=$i?>" id="quantity<?=$i?>" autocomplete="off" style="text-align: right;" readonly value="<?=$rowsales['quantity']?>"><input type="hidden" name="hidquan<?=$i?>" id="hidquan<?=$i?>" value="<?=$countstock[0]?>">
                                    <div class="col-lg-12">
                                        <br><center><span id="showquan<?=$i?>" <?php if($countstock[0] != 0) { ?>style="color: #0ea2b2;"<?php } else { ?>style="color: #b70909;"<?php }?>><?="In Stock ".$countstock[0]?></span></center>
                                    </div>
                                </td>
                                <td data-label="Amount (Rs)">
                                    <input type="text" readonly class="form-control"name="amount<?=$i?>" id="amount<?=$i?>" autocomplete="off" style="text-align: right;" value="<?=$rowsales['amount']?>" readonly>
                                </td>
                                <td data-label="Discount">
                                    <input type="text"  class="form-control" onkeypress="return numOnly(event);" name="discount<?=$i?>" id="discount<?=$i?>" autocomplete="off" style="text-align: right;" readonly value="<?=$rowsales['discount']?>">
								    <input type="hidden" name="showdiscount<?=$i?>" id="showdiscount<?=$i?>" value="<?=$rowsales['discount_amount']?>">
                                </td>
                                <td data-label="Net Value (Rs)">
                                    <input type="text" readonly class="form-control"name="netvalue<?=$i?>" id="netvalue<?=$i?>" autocomplete="off" style="text-align: right;" value="<?php if($countstock[0] !=  '0') { echo $rowsales['netvalue']; } else { echo "0"; }?>">
                                    <input type="hidden" name="shownetvalue<?=$i?>" id="shownetvalue<?=$i?>" value="<?php if($countstock[0] !=  '0') { echo $rowsales['netvalue']; } else { echo "0"; }?>">
                                </td>
                                <td data-label="Remove">
                                    <div class="form-animate-checkbox" style="padding-bottom: 5px;">
                                        <input type="checkbox" class="checkbox" name="del<?=$i?>" id="del<?=$i?>" onclick="removeid(<?=$i?>);FullTotal();DiscountCalculation();NbtCalculation();VatCalculation();">
                                    </div>
                                </td>
                            </tr> 
                            <?php 
                                $net = 0;
                                if($countstock[0] != 0)
                                {
                                   $net += $rowsales['netvalue'];
                                }
                                else
                                {
                                   $net += 0;
                                }
                                $totalam += $net;
                                $i++;
                            } 
                            ?>
                        </tbody>
                    </table>
                    <table id="myTable" class="table total">
						<tbody class="colspanHead">  
				            <tr>                               
				                <td scope="col" colspan="4">&nbsp;</td>
								<td scope="col">
								    <b><i>GROSS TOTAL (Rs)</i></b>
								</td>
								<td scope="col">
								    <input type="text" class="form-control" onkeypress="return numOnly(event);" name="total" id="total" autocomplete="off" style="text-align: right;" readonly value="<?=$totalam?>">
                                    <input type="hidden" name="numrows" id="numrows" value="<?=$i?>">
								</td>
				            </tr>
							<tr>                           
							   <td scope="col" colspan="4">&nbsp;</td>
							   <td scope="col">
								   <div class="form-animate-checkbox" style="padding-bottom: 5px;">
										<input type="checkbox" class="checkbox" name="confirmdiscount" id="confirmdiscount" onclick="enableDiscount();DiscountCalculation();NbtCalculation();VatCalculation();">
									</div>&nbsp;&nbsp;&nbsp;
								   <b><i>Discount</i></b>
							   </td>
							   <td scope="col">
								   <input type="text" class="form-control" onkeypress="return numOnly(event);" name="totaldiscount" id="totaldiscount" autocomplete="off" style="text-align: right;" readonly value="0" onkeyup="DiscountCalculation();NbtCalculation();VatCalculation();">
								   <input type="hidden" name="totaldiscountamount" id="totaldiscountamount" value="0">
							   </td>
							</tr>
							<tr>                                
				                <td scope="col" colspan="4"></td>
							   <td scope="col">
								   <div class="form-animate-checkbox" style="padding-bottom: 5px;">
										<input type="checkbox" class="checkbox" name="confirmnbt" id="confirmnbt" onclick="enableNbt();NbtCalculation();">
									</div>&nbsp;&nbsp;&nbsp;
								   <b><i>NBT 2 %</i></b>
							   </td>
                                <td scope="col">
								    <input type="text" class="form-control" onkeypress="return numOnly(event);" name="totalnbt" id="totalnbt" autocomplete="off" style="text-align: right;" readonly value="0">
								 </td>
				            </tr>
							<tr>				                                              
				                <td scope="col" colspan="4"></td>
								<td scope="col">
								    <div class="form-animate-checkbox" style="padding-bottom: 5px;">
										<input type="checkbox" class="checkbox" name="confirmvat" id="confirmvat" onclick="enableVat();VatCalculation();">
                                    </div>&nbsp;&nbsp;&nbsp;                                    
									<b><i>VAT 15 %</i></b>
								</td>
								<td scope="col">
								    <input type="text" class="form-control" onkeypress="return numOnly(event);" name="totalvat" id="totalvat" autocomplete="off" style="text-align: right;" readonly value="0">
								</td>
				            </tr>
							<tr>
							   <td scope="col" colspan="4">&nbsp;</td>
							   <td scope="col">
								   <b><i>Sub TOTAL (Rs)</i></b>
							   </td>
							   <td scope="col">
								   <input type="text" class="form-control" onkeypress="return numOnly(event);" name="subtotal" id="subtotal" autocomplete="off" style="text-align: right;" readonly value="<?=$totalam?>">
							   </td>
							</tr>
                            <tr>
							   <td scope="col" colspan="2">
								   <b><i>Payment Method</i></b>
							   </td>
                               <td scope="col" colspan="2">
                                   <div id="nextpaymentlbl" style="display: none">
								       <b><i>Next Payment Date</i></b>
								   </div>
                                </td>
                                <td scope="col" colspan="2">
                                    
                                   <div id="paymentdurationlbl" style="display: none">
                                        <b><i>Payment Method</i></b>
                                    </div>
                                </td>
                            </tr>
                            <tr>
							   <td scope="col" colspan="2">
								   <select class="form-control " style="margin-bottom:20px;" name="paymentmethod" id="paymentmethod" onchange="downpaymentchange();">                
                                        <option value="cash">Cash</option>
                                        <option value="credit">Credit</option>
                                        <option value="easypayment">Easy Payment</option>
                                   </select>
							   </td>
                               <td scope="col" colspan="2">
                                   <div id="nextpaymenttext" style="display: none">
                                       <?php 
                                     //  $incrementdate = date('Y-m-d', strtotime('+1 month', strtotime($nowdate)));                                     
                                       ?>
                                       <input type="text" class="form-control android" name="nextpaymentdate" id="nextpaymentdate" value="<?=$nowdate?>">
                                   </div>
                                </td> 
                                <td scope="col" colspan="2">
				                    <div id="paymentdurationselection" style="display: none">
				                        <select class="form-control " style="margin-bottom:20px;" name="paymentduration" id="paymentduration">  
                                            <option value="">-- Please Select Duration --</option>
                                            <?php
                                            $resultduration = $sales->paymentmonths();
                                            while($rowduration = mysqli_fetch_array($resultduration))
                                            {
                                                ?>
                                                <option value="<?=$rowduration[0]?>"><?=$rowduration[0]." Months"?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
				                    </div>
				                </td>
							</tr>
						</tbody>
					</table>
                    <div class="panel-body">
                        <div class="col-md-10">
                            <div id="easypaymenttable"></div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" name="save" id="save" style="margin-top:0px !important;" class="btn-flip btn btn-3d btn-primary">
                                <div class="flip">
                                    <div class="side">
                                        Invoice <span class="fa fa-check"></span>
                                    </div>
                                    <div class="side back">
                                        are you sure?
                                    </div>
                                </div>
                                <span class="icon"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                