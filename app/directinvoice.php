<?php include 'header.php';

    $orderno        = $_POST['salesorderno'];  

    $result         = $sales->getAllDetailsofSalesOrderbyONo($orderno);
    $row            = mysqli_fetch_array($result);

    $customerid      = $row['customerid'];

    $resultCustomer = $customer->selectcustomerbyid($customerid);
    $rowCustomer    = mysqli_fetch_array($resultCustomer);

    date_default_timezone_set('Asia/Colombo');
    $nowdate           = date('Y-m-d');

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
?>
    
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/ui-darkness/jquery-ui.min.css" rel="stylesheet">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>

<script type="text/javascript"> 
function addMore()
{
    var itemname = new Array();
    var itemcode = new Array(); 
    var sellprice = new Array(); 
	var hidsellprice = new Array();
    var quantity  = new Array(); 
    var hidquan = new Array();
    var showquan = new Array();
    var amount = new Array();
    var showamount = new Array();	
	var discount = new Array();
    var showdiscount = new Array();
    var netvalue = new Array();
	
    num_rows = parseInt(document.getElementById("numrows").value);
    totalrows = num_rows  + 1;
    
    for(i = 2; i < totalrows; i++)
    {
        itemname[i] = document.getElementById("itemname"+i).value;
        itemcode[i] = document.getElementById("itemcode"+i).value;
        sellprice[i] = document.getElementById("sellprice"+i).value;
		hidsellprice[i] = document.getElementById("hidsellprice"+i).value;
        quantity[i] = document.getElementById("quantity"+i).value;
        hidquan[i] = document.getElementById("hidquan"+i).value;
        showquan[i] = document.getElementById("showquan"+i).innerHTML;
        amount[i] = document.getElementById("amount"+i).value;
        showamount[i] = document.getElementById("showamount"+i).value;		
		discount[i] = document.getElementById("discount"+i).value;
        showdiscount[i] = document.getElementById("showdiscount"+i).value;
        netvalue[i] = document.getElementById("netvalue"+i).value;
    }
    document.getElementById("tech").innerHTML = "";
    tech = '<table id="myTable" class=" table order-list">';
    
    for(i = 2; i <= totalrows; i++)
    {
        if(i ==  totalrows)
        {			
            tech += '<tr>';
            
            tech += '<td data-label="Item Name"><input type="text" class="form-control" autocomplete="off" id="itemname' + i + '" onkeyup="autoitem('+ i +')" name="itemname' + i + '"/></td>';        
        
            tech += '<td data-label="Item Code"><input type="text" class="form-control" autocomplete="off" id="itemcode' + i + '" onkeyup="autocode('+ i +')" name="itemcode' + i + '"/></td>';

            tech += '<td data-label="Sell Price"><input type="text" class="form-control"  onkeypress="return numOnly(event);"  style="text-align: right;" id="sellprice' + i + '" name="sellprice' + i + '" value="0" onkeyup="SellToQuantity('+i+');OrderRowDiscount('+i+');finishOrderTotal();DiscountCalculation();NbtCalculation();VatCalculation();"/><input type="hidden" class="form-control" readonly onkeypress="return numOnly(event);"  style="text-align: right;" id="hidsellprice' + i + '" name="hidsellprice' + i + '"/></td>';

            tech += '<td data-label="Quantity"><input type="text" onkeypress="return numOnly(event);" class="form-control" id="quantity' + i + '" name="quantity' + i + '" style="text-align: right;"  onchange="validationQuantity('+i+');SellToQuantity('+i+');OrderRowDiscount('+i+');finishOrderTotal();DiscountCalculation();NbtCalculation();VatCalculation();"/><input type="hidden" name="hidquan' + i + '" id="hidquan' + i + '"><div class="col-lg-12"><br><center><span id="showquan' + i + '" style="color: #0ea2b2;"></span></center></div></td>';

            tech += '<td data-label="Amount (Rs)"><input type="text" onkeypress="return numOnly(event);" class="form-control" style="text-align: right;" id="amount' + i + '" name="amount' + i + '" readonly value="0"/><input type="hidden" name="showamount' + i + '" id="showamount' + i + '" value="0"></td>';
			
			tech += '<td data-label="Discount"><input type="text" class="form-control" id="discount' + i + '" name="discount' + i + '" style="text-align: right;" onkeyup="OrderRowDiscount('+i+');finishOrderTotal();DiscountCalculation();NbtCalculation();VatCalculation();"/><input type="hidden" name="showdiscount' + i + '" id="showdiscount' + i + '" value="0"></td>';
			
			tech += '<td data-label="Net Value"><input type="text" class="form-control" id="netvalue' + i + '" name="netvalue' + i + '" style="text-align: right;" readonly value="0"/></td>';

            tech += '<td data-label="Action"><input type="button" class="ibtnDel btn btn-md btn-danger" value="Delete" onclick="deleteAddRows('+i+');finishOrderTotal();DiscountCalculation();NbtCalculation();VatCalculation();"></td></tr>';
        }
        else    
        {
			tech += '<tr>';
            
            tech += '<td data-label="Item Name"><input type="text" class="form-control" autocomplete="off" id="itemname' + i + '" onkeyup="autoitem('+ i +')" name="itemname' + i + '" value="'+itemname[i]+'"/></td>';        
        
            tech += '<td data-label="Item Code"><input type="text" class="form-control" autocomplete="off" id="itemcode' + i + '" onkeyup="autocode('+ i +')" name="itemcode' + i + '" value="'+itemcode[i]+'"/></td>';

            tech += '<td data-label="Sell Price"><input type="text" class="form-control"  onkeypress="return numOnly(event);"  style="text-align: right;" id="sellprice' + i + '" name="sellprice' + i + '" value="'+sellprice[i]+'" onkeyup="SellToQuantity('+i+');OrderRowDiscount('+i+');finishOrderTotal();DiscountCalculation();NbtCalculation();VatCalculation();"/><input type="hidden" class="form-control" readonly onkeypress="return numOnly(event);"  style="text-align: right;" id="hidsellprice' + i + '" name="hidsellprice' + i + '" value="'+hidsellprice[i]+'"/></td>';

            tech += '<td data-label="Quantity"><input type="text" onkeypress="return numOnly(event);" class="form-control" id="quantity' + i + '" style="text-align: right;" name="quantity' + i + '" value="'+quantity[i]+'" onchange="validationQuantity('+i+');SellToQuantity('+i+');OrderRowDiscount('+i+');finishOrderTotal();DiscountCalculation();NbtCalculation();VatCalculation();"/><input type="hidden" name="hidquan' + i + '" id="hidquan' + i + '" value="'+hidquan[i]+'"><div class="col-lg-12"><br><center><span id="showquan' + i + '" style="color: #0ea2b2;">'+ showquan[i] +'</span></center></div></td>';

            tech += '<td data-label="Amount (Rs)"><input type="text" onkeypress="return numOnly(event);" class="form-control" style="text-align: right;" id="amount' + i + '" name="amount' + i + '" readonly value="'+amount[i]+'"/><input type="hidden" name="showamount' + i + '" id="showamount' + i + '" value="'+showamount[i]+'"></td>';
			
			tech += '<td data-label="Discount"><input type="text" class="form-control" id="discount' + i + '" name="discount' + i + '" style="text-align: right;" value="'+discount[i]+'" onkeyup="OrderRowDiscount('+i+');finishOrderTotal();DiscountCalculation();NbtCalculation();VatCalculation();"/><input type="hidden" name="showdiscount' + i + '" id="showdiscount' + i + '" value="'+showdiscount[i]+'"></td>';
			
			tech += '<td data-label="Net Value"><input type="text" class="form-control" id="netvalue' + i + '" name="netvalue' + i + '" style="text-align: right;" readonly value="'+netvalue[i]+'"/></td>';

            tech += '<td data-label="Action"><input type="button" class="ibtnDel btn btn-md btn-danger" value="Delete" onclick="deleteAddRows('+i+');finishOrderTotal();DiscountCalculation();NbtCalculation();VatCalculation();"></td></tr>';
        }
    }
    
    tech += "</table>";
    document.getElementById("tech").innerHTML = tech;
    document.getElementById("numrows").value = totalrows;
}
   
function deleteAddRows(row)
{
    var itemname = new Array();
    var itemcode = new Array(); 
    var sellprice = new Array(); 
	var hidsellprice = new Array();
    var quantity  = new Array(); 
    var hidquan = new Array();
    var showquan = new Array();
    var amount = new Array();
    var showamount = new Array();	
	var discount = new Array();
    var showdiscount = new Array();
    var netvalue = new Array();
    
    num_rows = parseInt(document.getElementById("numrows").value);
    int_num_rows = num_rows;
    row = parseInt(row);
    
    k = 2;
    m = k;
    
    for(; k <= int_num_rows; k++)
    {
        if(k == row){
            
        }
        else
        {
            itemname[m] = document.getElementById("itemname"+k).value;
			itemcode[m] = document.getElementById("itemcode"+k).value;
			sellprice[m] = document.getElementById("sellprice"+k).value;
			hidsellprice[m] = document.getElementById("hidsellprice"+k).value;
			quantity[m] = document.getElementById("quantity"+k).value;
			hidquan[m] = document.getElementById("hidquan"+k).value;
			showquan[m] = document.getElementById("showquan"+k).innerHTML;
			amount[m] = document.getElementById("amount"+k).value;
			showamount[m] = document.getElementById("showamount"+k).value;		
			discount[m] = document.getElementById("discount"+k).value;
			showdiscount[m] = document.getElementById("showdiscount"+k).value;
			netvalue[m] = document.getElementById("netvalue"+k).value;
            m++;
        }
    }
    document.getElementById("tech").innerHTML = "";
    tech = '<table id="myTable" class=" table order-list">';
    i = 2;
    j = i;
    
    for(; i <= int_num_rows; i++)
    {
        if(i == row){
            
        }
        else
        {
			tech += '<tr>';
            
            tech += '<td data-label="Item Name"><input type="text" class="form-control" autocomplete="off" id="itemname' + j + '" onkeyup="autoitem('+ j +')" name="itemname' + j + '" value="'+itemname[j]+'"/></td>';        
        
            tech += '<td data-label="Item Code"><input type="text" class="form-control" autocomplete="off" id="itemcode' + j + '" onkeyup="autocode('+ j +')" name="itemcode' + j + '" value="'+itemcode[j]+'"/></td>';

            tech += '<td data-label="Sell Price"><input type="text" class="form-control"  onkeypress="return numOnly(event);"  style="text-align: right;" id="sellprice' + j + '" name="sellprice' + j + '" value="'+sellprice[j]+'" onkeyup="SellToQuantity('+j+');OrderRowDiscount('+j+');finishOrderTotal();DiscountCalculation();NbtCalculation();VatCalculation();"/><input type="hidden" class="form-control" readonly onkeypress="return numOnly(event);"  style="text-align: right;" id="hidsellprice' + j + '" name="hidsellprice' + j + '" value="'+hidsellprice[j]+'"/></td>';

            tech += '<td data-label="Quantity"><input type="text" onkeypress="return numOnly(event);" class="form-control" id="quantity' + j + '" name="quantity' + j + '" style="text-align: right;" value="'+quantity[j]+'" onchange="validationQuantity('+j+');SellToQuantity('+j+');OrderRowDiscount('+j+');finishOrderTotal();DiscountCalculation();NbtCalculation();VatCalculation();"/><input type="hidden" name="hidquan' + j + '" id="hidquan' + j + '" value="'+hidquan[j]+'"><div class="col-lg-12"><br><center><span id="showquan' + j + '" style="color: #0ea2b2;">'+ showquan[j] +'</span></center></div></td>';

            tech += '<td data-label="Amount (Rs)"><input type="text" onkeypress="return numOnly(event);" class="form-control" style="text-align: right;" id="amount' + j + '" name="amount' + j + '" readonly value="'+amount[j]+'"/><input type="hidden" name="showamount' + j + '" id="showamount' + j + '" value="'+showamount[j]+'"></td>';
			
			tech += '<td data-label="Discount"><input type="text" class="form-control" id="discount' + j + '" name="discount' + j + '" style="text-align: right;" value="'+discount[j]+'" onkeyup="OrderRowDiscount('+j+');finishOrderTotal();DiscountCalculation();NbtCalculation();VatCalculation();"/><input type="hidden" name="showdiscount' + j + '" id="showdiscount' + j + '" value="'+showdiscount[j]+'"></td>';
			
			tech += '<td data-label="Net Value"><input type="text" class="form-control" id="netvalue' + j + '" name="netvalue' + j + '" style="text-align: right;" readonly value="'+netvalue[j]+'"/></td>';

            tech += '<td data-label="Action"><input type="button" class="ibtnDel btn btn-md btn-danger" value="Delete" onclick="deleteAddRows('+j+');finishOrderTotal();DiscountCalculation();NbtCalculation();VatCalculation();"></td></tr>';
			
            j++;
        }
    }
    tech += "</table>";
    document.getElementById("tech").innerHTML = tech;
    document.getElementById("numrows").value = int_num_rows-1;
}
    
function numOnly(e) 
{
    var k;
    document.all ? k = e.keyCode : k = e.which;
    return ((k > 47 && k < 58));
}

function clearvalue()
{
    document.getElementById("itemcode1").value = "";
    document.getElementById("itemid1").value = "";
    document.getElementById("itemname1").value = "";
    document.getElementById("unitprice1").value = "";
    document.getElementById("quantity1").value = "";
    document.getElementById("amount1").value = "";    
}
 

function autoCustomername()    
{
    $(function() {
        $('#customerid').val('');
        $('#customercode').val('');
        $('#phone').val('');
        $('#address').val('');
        $("#customername").autocomplete({
            source: "autocompleteforSalesCustomer.php",
            minLength: 1,
            select: function(event, ui) {
                $('#customerid').val(ui.item.customerid);
                $('#customercode').val(ui.item.customercode);
                $('#phone').val(ui.item.phone);
                $('#address').val(ui.item.address);
            }
        });
    });
}
    
function autoCustomerCode()
{
    $(function() {
        $('#customerid').val('');
        $('#customername').val('');
        $('#phone').val('');
        $('#address').val('');
        $("#customercode").autocomplete({
            source: "autocompleteforSalesCustomerCode.php",
            minLength: 1,
            select: function(event, ui) {
                $('#customerid').val(ui.item.customerid);
                $('#customername').val(ui.item.customername);
                $('#phone').val(ui.item.phone);
                $('#address').val(ui.item.address);
            }
        });
    });
}

function autoitem(id) 
{
    $(function() {
        $('#itemcode'+id).val("");
        $('#sellprice'+id).val(0);
		$('#hidsellprice'+id).val(0);
        $('#quantity'+id).val(0);
        $('#hidquan'+id).val(0);
		$('#showquan'+id).text("");
		$('#amount'+id).val(0);
        $('#showamount'+id).val(0);
        $('#discount'+id).val("");
        $('#showdiscount'+id).val(0);
		$('#netvalue'+id).val(0);
        $("#itemname"+id).autocomplete({        
           source: "autocompleteforitemsales.php",
           minLength: 1,
	       select: function(event, ui) {
           
               $('#itemcode'+id).val(ui.item.itemcode);
               $('#sellprice'+id).val(ui.item.sellprice);
			   $('#hidsellprice'+id).val(ui.item.hidsellprice);
			   $('#hidquan'+id).val(ui.item.hidquan);
			   $('#showquan'+id).text("In Stock " + ui.item.showquan);
            }
        });
    });
    
}

function autocode(id)
{
    $(function() {
        $('#itemname'+id).val("");
        $('#sellprice'+id).val(0);
		$('#hidsellprice'+id).val(0);
        $('#quantity'+id).val(0);
        $('#hidquan'+id).val(0);
		$('#showquan'+id).text("");
		$('#amount'+id).val(0);
        $('#showamount'+id).val(0);
        $('#discount'+id).val("");
        $('#showdiscount'+id).val(0);
		$('#netvalue'+id).val(0);
        $("#itemcode"+id).autocomplete({        
           source: "autocompleteforitemcodesales.php",
           minLength: 1,
	       select: function(event, ui) {           
               $('#itemname'+id).val(ui.item.itemname);
               $('#sellprice'+id).val(ui.item.sellprice);
			   $('#hidsellprice'+id).val(ui.item.hidsellprice);
			   $('#hidquan'+id).val(ui.item.hidquan);
			   $('#showquan'+id).text("In Stock " + ui.item.showquan);
            }
        });
    });    
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
	
function validationQuantity(id)
{
	var quantity = parseInt(document.getElementById("quantity"+id).value);
	var hiddenquantity = parseInt(document.getElementById("hidquan"+id).value);
	
	if(quantity > hiddenquantity)
	{
		document.getElementById("quantity"+id).value = hiddenquantity;
	}
	else {}
}
	
function SellToQuantity(id)
{
	var sellprice = parseFloat(document.getElementById("sellprice"+id).value);
	var quantity = parseFloat(document.getElementById("quantity"+id).value);
	
	var sumofquantity = sellprice * quantity;
	
	document.getElementById("amount"+id).value = sumofquantity;
	document.getElementById("showamount"+id).value = sumofquantity;
	document.getElementById("netvalue"+id).value = sumofquantity;
	
	var hiddensellingprice = parseFloat(document.getElementById("hidsellprice"+id).value);
	
	if(document.getElementById("sellprice"+id).value == '')
	{
		document.getElementById("sellprice"+id).value = hiddensellingprice;
		
		var rebootsumofquantity = hiddensellingprice * quantity;
		document.getElementById("amount"+id).value = rebootsumofquantity;
		document.getElementById("showamount"+id).value = rebootsumofquantity;
		document.getElementById("netvalue"+id).value = rebootsumofquantity;
	}
	
	var hiddenquantity = parseFloat(document.getElementById("hidquan"+id).value);
	
	if(document.getElementById("quantity"+id).value == '')
	{
		document.getElementById("quantity"+id).value = hiddenquantity;
		
		var rebootsumofquantity = sellprice * hiddenquantity;
		document.getElementById("amount"+id).value = rebootsumofquantity;
		document.getElementById("showamount"+id).value = rebootsumofquantity;
		document.getElementById("netvalue"+id).value = rebootsumofquantity;
	}
}
	
function OrderRowDiscount(id)
{
	var amount = parseFloat(document.getElementById("amount"+id).value);
	var discount = parseFloat(document.getElementById("discount"+id).value);
	
	var discountsumamount = amount * discount / 100;	
	document.getElementById("showdiscount"+id).value = parseFloat(discountsumamount);
	
	var sumamount = amount - discountsumamount;	
	document.getElementById("netvalue"+id).value = parseFloat(sumamount);
	
	if(document.getElementById("discount"+id).value == '')
	{
		document.getElementById("netvalue"+id).value = amount;
	}
}
	
function finishOrderTotal()
{
	var loop = document.getElementById("numrows").value;
	var tot = 0;
	
	for(i = 1; i <= loop; i++)
	{
		tot += parseFloat(document.getElementById("netvalue"+i).value);
	}
	
	document.getElementById("total").value = parseFloat(tot);
	document.getElementById("subtotal").value = parseFloat(tot);
	SubTotalCalculation();
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
	SubTotalCalculation();
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
    
    var sum = total * nbt / 100;
    document.getElementById("totalnbt").value = sum;
	
	enableNbt();
	SubTotalCalculation();
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
    
    var sum = total * vat / 100;
    document.getElementById("totalvat").value = sum;
	
	enableVat();
	SubTotalCalculation();
}
	
function SubTotalCalculation()
{
	var total = parseFloat(document.getElementById("total").value);
	var discount = parseFloat(document.getElementById("totaldiscountamount").value);
	var nbt = parseFloat(document.getElementById("totalnbt").value);
	var vat = parseFloat(document.getElementById("totalvat").value);
	//alert(grntotal+" "+discount+" "+nbt+" "+vat);
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
        document.getElementById("paymentdurationselection").style.display = 'block';
        document.getElementById("paymentdurationlbl").style.display = 'block';
        document.getElementById("nextpaymentlbl").style.display = 'block';
        document.getElementById("nextpaymenttext").style.display = 'block';
        document.getElementById("downpayment").value = 0;
    }
    else 
    { 
        document.getElementById("paymentdurationselection").style.display = 'none';
        document.getElementById("paymentdurationlbl").style.display = 'none';        
        document.getElementById("nextpaymentlbl").style.display = 'none';
        document.getElementById("nextpaymenttext").style.display = 'none';
    }
}
    
$(document).ready(function(){
    $("#paymentduration").change(function(){
        var paymentduration = $("#paymentduration").val();
        var subtotal = $("#subtotal").val();
        var nextpaymentdate = $("#nextpaymentdate").val();
        $.post("getpayementschedule.php", {
			paymentduration:paymentduration,
            subtotal:subtotal,
            nextpaymentdate:nextpaymentdate
		},
			
		function(data,status) {
			$("#easypaymenttable").empty();			
			$("#easypaymenttable").append(data);
		});
    });
});
</script>
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
<?php include 'sidnav.php';?>
<form class="form" id="directinvoice" name="directinvoice" action="directinvoicesub.php" method="post" enctype="multipart/form-data">
<div class="container-fluid mimin-wrapper">
    <div id="content">
        <div class="panel box-shadow-none content-header">
            <div class="panel-body">
                <div class="col-md-12">
                    <h3 class="animated fadeInLeft">Direct Invoice</h3>
                    <p class="animated fadeInDown">
                      Inventory <span class="fa-angle-right fa"></span> Direct Invoice
                    </p>
                </div>
            </div>
        </div>
        <div class="form-element">
            <div class="col-md-12"> 
                <div class="panel form-element-padding">
                    <div class="panel-heading">
                        <h4>Direct Invoice Form</h4> 
                    </div>
                    <div class="panel-body" style="padding-bottom:30px;">
                        <div class = "col-md-12">
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
                                <label class="control-label text-right" style="padding-bottom:15px;">Invoice No</label>
                                <input type="text" class="form-control android" name="invoiceno" id="invoiceno" value="<?=$invoiceno?>" readonly>
                            </div>                       
                            <div class="col-md-4"> 
                                <label style = "margin-bottom:20px;">Invoice Date</label>
                                <input type="text" class="form-text form-control android" placeholder="MM/DD/YYYY" value="<?=$nowdate?>" name="invoicedate" id="invoicedate">
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                        <div class = "col-md-12"><br></div>
                        <div class="col-md-4" style = "margin-bottom:20px;">
                            <label class="control-label text-right">Customer Name</label>
                            <input type="text" class="form-control android" autocomplete="off"  name="customername" id="customername" onkeyup="autoCustomername();" autocomplete="off">
                            <input type="hidden" class="form-control android"  name="customerid" id="customerid">
                        </div>                       
                        <div class="col-md-4" style = "margin-bottom:20px;"> 
                            <label>Cust Code</label>
                            <input type="text" class="form-control android" autocomplete="off" name="customercode" id="customercode" onkeyup="autoCustomerCode();" autocomplete="off">
                        </div>
                        <div class="col-md-4" style = "margin-bottom:20px;"> 
                            <label>Phone</label>
                            <input type="text" class="form-control android" name="phone" id="phone">
                        </div>                           
                    </div>
                    <div class="panel-body" style="padding-bottom:30px;">
                        <div class="col-md-9" style = "margin-bottom:20px;"> 
                            <label>Address</label>
                            <input type="text" class="form-control android" name="address" id="address">
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
                    <div class="panel-body" style="padding-bottom:30px;">
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
                        <div class="col-md-4" style = "margin-bottom:20px;"></div>  
                    </div>
                </div>
                <div class="panel form-element-padding">
                    <div class="panel-body" style="padding-bottom:30px;">
                        <table id="myTable" class=" table order-list">
                            <caption>Sales Order</caption>
                                <thead>
                                    <tr>
                                        <th scope="col">Item Name <span id = "redstar">*</span></th>
                                        <th scope="col">Item Code</th>
                                        <th scope="col">Sell Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Amount (Rs)</th>
                                        <th scope="col">Discount</th>
                                        <th scope="col">Net Value (Rs)</th>
                                        <th scope="col">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td data-label="Item Name">
                                            <input type="text" class="form-control" name="itemname1" id="itemname1" autocomplete="off" onkeyup="autoitem(1)">
                                        </td>
                                        <td data-label="Item Code">
                                            <input type="text" class="form-control" name="itemcode1" id="itemcode1" autocomplete="off" onkeyup="autocode(1)">
                                        </td>
                                        <td data-label="Sell Price">
                                            <input type="text" onkeypress="return numOnly(event);" class="form-control" name="sellprice1" id="sellprice1" autocomplete="off" style="text-align: right;" onkeyup="SellToQuantity(1);finishOrderTotal();DiscountCalculation();NbtCalculation();VatCalculation();">
                                            <input type="hidden" readonly class="form-control" name="hidsellprice1" id="hidsellprice1" autocomplete="off" style="text-align: right;">
                                        </td>
                                        <td data-label="Quantity">
                                            <input type="text" class="form-control" onkeypress="return numOnly(event);" name="quantity1" id="quantity1" autocomplete="off" style="text-align: right;" onchange="validationQuantity(1);SellToQuantity(1);OrderRowDiscount(1);finishOrderTotal();DiscountCalculation();NbtCalculation();VatCalculation();">
                                            <input type="hidden" name="hidquan1" id="hidquan1">
                                            <div class="col-lg-12">
                                                <br><center><span id="showquan1" style="color: #0ea2b2;"></span></center>
                                            </div>
                                        </td>
                                        <td data-label="Amount (Rs)">
                                            <input type="text" readonly class="form-control"name="amount1" id="amount1" autocomplete="off" style="text-align: right;" value="0">
								            <input type="hidden" name="showamount1" id="showamount1" value="0">
                                        </td>
                                        <td data-label="Discount">
                                            <input type="text"  class="form-control" onkeypress="return numOnly(event);" name="discount1" id="discount1" autocomplete="off" style="text-align: right;" onkeyup="OrderRowDiscount(1);OrderRowDiscount(1);finishOrderTotal();DiscountCalculation();NbtCalculation();VatCalculation();">
                                            <input type="hidden" name="showdiscount1" id="showdiscount1" value="0">
                                        </td>
                                        <td data-label="Net Value (Rs)">
                                            <input type="text" readonly class="form-control"name="netvalue1" id="netvalue1" autocomplete="off" style="text-align: right;" value="0">
                                        </td>
                                        <td data-label="&nbsp;">
                                            <a class="deleteRow"></a>
                                        </td>
                                    </tr> 
                            </tbody>
                        </table> 
						<div id="tech"></div>
                        <div class = "row">
                            <div class="col-md-12" style="margin-top:22px;">
                                <input type="hidden" name="numrows" id="numrows" value="1">
                                <button type="button" name="addmore" id="addmore" class="btn ripple-infinite btn-round btn-success" onclick="addMore()">
                                    <div>
                                        <span>Add Row</span>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>    
                </div>                      
            </div>
        </div>
        <table id="myTable" class="table total">
            <tbody class="colspanHead">  
                <tr>                               
				    <td scope="col" colspan="4">&nbsp;</td>
					<td scope="col">
					    <b><i>GROSS TOTAL (Rs)</i></b>
					</td>
					<td scope="col">
					    <input type="text" class="form-control" onkeypress="return numOnly(event);" name="total" id="total" autocomplete="off" style="text-align: right;" readonly value="0">
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
				    
                        <div class="form-animate-checkbox" style="padding-bottom: 5px;">
                            <input type="hidden" class="checkbox" name="confirmnbt" id="confirmnbt" onclick="enableNbt();NbtCalculation();">
                        </div>&nbsp;&nbsp;&nbsp;
				 
					    <input type="hidden" class="form-control" onkeypress="return numOnly(event);" name="totalnbt" id="totalnbt" autocomplete="off" style="text-align: right;" readonly value="0">
				
				
					    <div class="form-animate-checkbox" style="padding-bottom: 5px;">
							<input type="hidden" class="checkbox" name="confirmvat" id="confirmvat" onclick="enableVat();VatCalculation();">
                        </div>&nbsp;&nbsp;&nbsp;                                    
				    
					    <input type="hidden" class="form-control" onkeypress="return numOnly(event);" name="totalvat" id="totalvat" autocomplete="off" style="text-align: right;" readonly value="0">
					
				<tr>
				    <td scope="col" colspan="4">&nbsp;</td>
					<td scope="col">
					   <b><i>Sub TOTAL (Rs)</i></b>
					</td>
					<td scope="col">
					   <input type="text" class="form-control" onkeypress="return numOnly(event);" name="subtotal" id="subtotal" autocomplete="off" style="text-align: right;" readonly value="0">
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
                            <b><i>Payment Duration</i></b>
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
</form>
  </body>
</html>

