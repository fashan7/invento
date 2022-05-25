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
 
    $date = $object->getDate();
    $grnsum = 0;
?>
<style>
  .error 
  {
    color: #ff0000;
  }
  </style>
<script type="text/javascript">    
function numOnly(e) 
{
    var k;
    document.all ? k = e.keyCode : k = e.which;
    return ((k > 47 && k < 58));
}
	
function removeid(id)
{
    if(document.getElementById("del"+id).checked)
    {
        document.getElementById("unitprice"+id).readOnly = true;
        document.getElementById("sellprice"+id).readOnly = true;
        document.getElementById("grnquantity"+id).readOnly = true;
		document.getElementById("showamount"+id).value = 0;
    }
    else 
    {
        document.getElementById("unitprice"+id).readOnly = false;
        document.getElementById("sellprice"+id).readOnly = false;
        document.getElementById("grnquantity"+id).readOnly = false;
		document.getElementById("showamount"+id).value = document.getElementById("amount"+id).value;
    }
}
    
    
function enableDiscount()
{
    if(document.getElementById("confirmdiscount").checked)
    {
        document.getElementById("grndiscount").readOnly = false;
    }
    else        
    {
        document.getElementById("grndiscount").readOnly = true;
        document.getElementById("grndiscount").value = 0;
		document.getElementById("discountamount").value = 0;
    }
}

function enableNbt()
{
    if(document.getElementById("confirmnbt").checked)
    {
        document.getElementById("grnnbt").readOnly = true;
    }
    else        
    {
        document.getElementById("grnnbt").readOnly = true;
        document.getElementById("grnnbt").value = 0;
    }
}
    
function enableVat()
{
    if(document.getElementById("confirmvat").checked)
    {
        document.getElementById("grnvat").readOnly = true;
    }
    else        
    {
        document.getElementById("grnvat").readOnly = true;
        document.getElementById("grnvat").value = 0;
    }
}
    
function autoitem(id) //grnitemname grnitemcode grnunitprice grnsellprice grngrnquantity grnamount
{
    $(function() {
        $('#grnitemcode'+id).val("");
        $('#grnunitprice'+id).val(0);
        $('#grnsellprice'+id).val(0);
        $('#grngrnquantity'+id).val(0);
        $('#grnamount'+id).val(0);
		$('#hidgrnunitprice'+id).val(0);
        $("#grnitemname"+id).autocomplete({        
            source: "autocompletegrnitem.php",
            minLength: 1,
	       select: function(event, ui) {
           
               $('#grnitemcode'+id).val(ui.item.grnitemcode);
               $('#grnunitprice'+id).val(ui.item.grnunitprice);
               $('#grnsellprice'+id).val(ui.item.grnsellprice);
			   $('#hidgrnunitprice'+id).val(ui.item.hidgrnunitprice);
            }
        });
    });
    
}

function autocode(id)
{
    $(function() {
        $('#grnitemname'+id).val("");
        $('#grnunitprice'+id).val(0);
        $('#grnsellprice'+id).val(0);
        $('#grngrnquantity'+id).val(0);
        $('#grnamount'+id).val(0);
		$('#hidgrnunitprice'+id).val(0);
        $("#grnitemcode"+id).autocomplete({        
            source: "autocompletegrnitemcode.php",
            minLength: 1,
	       select: function(event, ui) {           
               $('#grnitemname'+id).val(ui.item.grnitemname);
               $('#grnunitprice'+id).val(ui.item.grnunitprice);
               $('#grnsellprice'+id).val(ui.item.grnsellprice); 
			   $('#hidgrnunitprice'+id).val(ui.item.hidgrnunitprice);
            }
        });
    });
    
}

function validationgrnQuan(id)
{
	var grnquan = parseInt(document.getElementById("grnquantity"+id).value);	
	var quantity = parseInt(document.getElementById("poquantity"+id).value);
	
	if(grnquan > quantity)
	{
		document.getElementById("grnquantity"+id).value = document.getElementById("poquantity"+id).value;
	}
	else{}
}
	
function poUnitToQuantity(id)
{
    var unitprice = parseFloat(document.getElementById("unitprice"+id).value);
    var quantity = parseFloat(document.getElementById("grnquantity"+id).value);
    
    var amount = unitprice * quantity;
    
    var oldunitvalues = parseFloat(document.getElementById("hidunitprice"+id).value);
    var oldquantity = parseFloat(document.getElementById("hidgrnquantity"+id).value);
    
    
    document.getElementById("showamount"+id).value = amount;
    document.getElementById("amount"+id).value = amount;
    
    if(document.getElementById("unitprice"+id).value == '')
    {
        document.getElementById("unitprice"+id).value = oldunitvalues;
        
        var rebootamount = oldunitvalues * quantity;
        document.getElementById("showamount"+id).value = rebootamount;
        document.getElementById("amount"+id).value = rebootamount;
        
    }
    
    if(document.getElementById("grnquantity"+id).value == '')
    {
        document.getElementById("grnquantity"+id).value = oldquantity;
        
        var rebootamount = unitprice * oldquantity;
        document.getElementById("showamount"+id).value = rebootamount;
        document.getElementById("amount"+id).value = rebootamount;
    }
}
    
function poDiscount()
{
    var discount = 0;
	
	if(document.getElementById("grndiscount").value == '')
	{
		discount = 0;
	}
	else
	{
		discount = parseFloat(document.getElementById("grndiscount").value);
	}
	
    var grntotal = parseFloat(document.getElementById("grntotal").value);
    
    sum = grntotal * discount / 100;
    document.getElementById("discountamount").value = sum;
	
	enableDiscount();
	poSubTotal();
}
	
function poNbt()
{
	var nbt = 2;
    var grntotal = 0;
    if(document.getElementById("grndiscount").value == '')
    {
        grntotal = parseFloat(document.getElementById("grntotal").value);
    }
    else
    {
        poDiscount();
        var sumdiscount = parseFloat(document.getElementById("grntotal").value) - parseFloat(document.getElementById("discountamount").value);
        grntotal = sumdiscount;
    }
     
    
    sum = grntotal * nbt / 100;
    document.getElementById("grnnbt").value = sum;
	
	enableNbt();
	poSubTotal();
} 

function poVat()
{
	var vat = 15;
    var grntotal = 0;
    if(document.getElementById("grndiscount").value == '')
    {
        grntotal = parseFloat(document.getElementById("grntotal").value);
    }
    else
    {
        poDiscount();
        var sumdiscount = parseFloat(document.getElementById("grntotal").value) - parseFloat(document.getElementById("discountamount").value);
        grntotal = sumdiscount;
    }
    
    sum = grntotal * vat / 100;
    document.getElementById("grnvat").value = sum;
	
	enableVat();
	poSubTotal();
} 

function poFullTotal()
{
    //grntotal grndiscount grnnbt grnvat subtotal numrows
    var sum = 0;    
    var loop = document.getElementById("numrows").value;
	var grntotal = parseFloat(document.getElementById("grntotal").value);
    
    for(i = 1; i < loop; i++)
    {
        var unitquantityamount = parseFloat(document.getElementById("showamount"+i).value);
        sum += unitquantityamount;  
        //alert(sum);
    }    
    document.getElementById("grntotal").value = sum;
    document.getElementById("subtotal").value = sum;
	
    
	poSubTotal();
}

function poSubTotal()
{
	var grntotal = parseFloat(document.getElementById("grntotal").value);
	var discount = parseFloat(document.getElementById("discountamount").value);
	var nbt = parseFloat(document.getElementById("grnnbt").value);
	var vat = parseFloat(document.getElementById("grnvat").value);
	//alert(grntotal+" "+discount+" "+nbt+" "+vat);
	var sum = (grntotal - discount) + nbt + vat;
	
	if(document.getElementById("grntotal").value == 0)
	{
		document.getElementById("subtotal").value = 0;
		document.getElementById("discount").value = 0;
		document.getElementById("discountamount").value = 0;
		document.getElementById("grnnbt").value = 0;
		document.getElementById("grnvat").value = 0;
	}
	else
	{
		document.getElementById("subtotal").value = sum;
	}
}

function grnUnitToQuantity(id)
{
    var unitprice = parseFloat(document.getElementById("grnunitprice"+id).value);
    var quantity = parseFloat(document.getElementById("grngrnquantity"+id).value);
    
    var amount = unitprice * quantity;
    
    var oldunitvalues = parseFloat(document.getElementById("hidgrnunitprice"+id).value);
    var oldquantity = 0;
    
    document.getElementById("showgrnamount"+id).value = amount;
    document.getElementById("grnamount"+id).value = amount;
    
    if(document.getElementById("grnunitprice"+id).value == '')
    {
        document.getElementById("grnunitprice"+id).value = oldunitvalues;
        
        var rebootamount = oldunitvalues * quantity;
        document.getElementById("showgrnamount"+id).value = rebootamount;
        document.getElementById("grnamount"+id).value = rebootamount;
        
    }
    
    if(document.getElementById("grngrnquantity"+id).value == '')
    {
        document.getElementById("grngrnquantity"+id).value = oldquantity;
        
        var rebootamount = unitprice * oldquantity;
        document.getElementById("showgrnamount"+id).value = rebootamount;
        document.getElementById("grnamount"+id).value = rebootamount;
    }
}
	
function grnFullTotal()
{
	var sum = 0;    
    var loop = document.getElementById("numrows").value;
    
    for(i = 1; i <= loop; i++)
	{
        var amount = parseFloat(document.getElementById("showgrnamount"+i).value);        
		sum += amount;    
	}	
	document.getElementById("grntotal").value = sum;
    document.getElementById("subtotal").value = sum;
    poSubTotal();
}
function addMore()
{
    //grnitemname grnitemcode grnunitprice hidgrnunitprice grnsellprice grngrnquantity grnamount showgrnamount
    var grnitemname = new Array();
    var grnitemcode = new Array(); 
    var grnunitprice = new Array(); 
    var hidgrnunitprice  = new Array(); 
    var grnsellprice = new Array();
    var grngrnquantity = new Array();
    var grnamount = new Array();
    var showgrnamount = new Array();
    
    num_rows = parseInt(document.getElementById("numrows").value);
    totalrows = num_rows  + 1;
    
    for(i = 2; i < totalrows; i++)
    {
        grnitemname[i] = document.getElementById("grnitemname"+i).value;
        grnitemcode[i] = document.getElementById("grnitemcode"+i).value;
        grnunitprice[i] = document.getElementById("grnunitprice"+i).value;
        hidgrnunitprice[i] = document.getElementById("hidgrnunitprice"+i).value;
        grnsellprice[i] = document.getElementById("grnsellprice"+i).value;
        grngrnquantity[i] = document.getElementById("grngrnquantity"+i).value;
        grnamount[i] = document.getElementById("grnamount"+i).value;
        showgrnamount[i] = document.getElementById("showgrnamount"+i).value;
    }
    document.getElementById("tech").innerHTML = "";
    tech = '<table id="myTable" class=" table order-list">';
    
    for(i = 2; i <= totalrows; i++)
    {
        if(i ==  totalrows)
        {
            tech += '<tr>';
            
            tech += '<td data-label="Item Name"><input type="text" required class="form-control" onkeyup="autoitem('+ i +')" id="grnitemname' + i + '" name="grnitemname' + i + '"/></td>';        
        
            tech += '<td data-label="Item Code"><input type="text" class="form-control" onkeyup="autocode('+ i +')" id="grnitemcode' + i + '" name="grnitemcode' + i + '"/></td>';

            tech += '<td data-label="Unit Price"><input type="text" onkeypress="return numOnly(event);" class="form-control" style="text-align: right;" id="grnunitprice' + i + '" name="grnunitprice' + i + '" onchange="grnUnitToQuantity('+ i +');grnFullTotal('+ i +');poDiscount();poNbt();poVat();" value="0"/><input type="hidden" name="hidgrnunitprice' + i + '" id="hidgrnunitprice' + i + '" value="0"></td>';

            tech += '<td data-label="Sell Price"><input type="text" class="form-control" onkeypress="return numOnly(event);"  style="text-align: right;" id="grnsellprice' + i + '" name="grnsellprice' + i + '" value="0"/></td>';

            tech += '<td data-label="GRN Quantity"><input type="text" onkeypress="return numOnly(event);" class="form-control" id="grngrnquantity' + i + '" name="grngrnquantity' + i + '" onchange="grnUnitToQuantity('+ i +');grnFullTotal('+ i +');poDiscount();poNbt();poVat();" value="0"/></td>';

            tech += '<td data-label="Amount (Rs)"><input type="text" onkeypress="return numOnly(event);" class="form-control" style="text-align: right;" id="grnamount' + i + '" name="grnamount' + i + '" readonly value="0"/><input type="hidden" name="showgrnamount' + i + '" id="showgrnamount' + i + '" value="0"></td>';

            tech += '<td data-label="Action"><input type="button" class="ibtnDel btn btn-md btn-danger" value="Delete" onclick="deleteAddRows('+i+');grnFullTotal();poDiscount();poNbt();poVat();"></td></tr>';
        }
        else    
        {
            tech += '<tr>';
            
            tech += '<td data-label="Item Name"><input type="text" required class="form-control" onkeyup="autoitem('+ i +')" id="grnitemname' + i + '" name="grnitemname' + i + '" value="'+grnitemname[i]+'"/></td>';        
        
            tech += '<td data-label="Item Code"><input type="text" class="form-control" onkeyup="autocode('+ i +')" id="grnitemcode' + i + '" name="grnitemcode' + i + '" value="'+grnitemcode[i]+'"/></td>';

            tech += '<td data-label="Unit Price"><input type="text" onkeypress="return numOnly(event);" class="form-control" style="text-align: right;" id="grnunitprice' + i + '" name="grnunitprice' + i + '" onchange="grnUnitToQuantity('+ i +');grnFullTotal('+ i +');poDiscount();poNbt();poVat();" value="'+grnunitprice[i]+'" /><input type="hidden" name="hidgrnunitprice' + i + '" id="hidgrnunitprice' + i + '" value="'+hidgrnunitprice[i]+'"></td>';

            tech += '<td data-label="Sell Price"><input type="text" class="form-control" onkeypress="return numOnly(event);"  style="text-align: right;" id="grnsellprice' + i + '" name="grnsellprice' + i + '" value="'+grnsellprice[i]+'"/></td>';

            tech += '<td data-label="GRN Quantity"><input type="text" onkeypress="return numOnly(event);" class="form-control" id="grngrnquantity' + i + '" name="grngrnquantity' + i + '" onchange="grnUnitToQuantity('+ i +');grnFullTotal('+ i +');poDiscount();poNbt();poVat();" value="'+grngrnquantity[i]+'"/></td>';

            tech += '<td data-label="Amount (Rs)"><input type="text" onkeypress="return numOnly(event);" class="form-control" style="text-align: right;" id="grnamount' + i + '" name="grnamount' + i + '" readonly value="'+grnamount[i]+'"/><input type="hidden" name="showgrnamount' + i + '" id="showgrnamount' + i + '" value="'+showgrnamount[i]+'"></td>';

            tech += '<td data-label="Action"><input type="button" class="ibtnDel btn btn-md btn-danger" value="Delete" onclick="deleteAddRows('+i+');grnFullTotal();poDiscount();poNbt();poVat();"></td></tr>';
        }
    }
    
    tech += "</table>";
    document.getElementById("tech").innerHTML = tech;
    document.getElementById("numrows").value = totalrows;
}
   
function deleteAddRows(row)
{
     var grnitemname = new Array();
    var grnitemcode = new Array(); 
    var grnunitprice = new Array(); 
    var hidgrnunitprice  = new Array(); 
    var grnsellprice = new Array();
    var grngrnquantity = new Array();
    var grnamount = new Array();
    var showgrnamount = new Array();
    
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
            grnitemname[m] = document.getElementById("grnitemname"+k).value;
            grnitemcode[m] = document.getElementById("grnitemcode"+k).value;
            grnunitprice[m] = document.getElementById("grnunitprice"+k).value;
            hidgrnunitprice[m] = document.getElementById("hidgrnunitprice"+k).value;
            grnsellprice[m] = document.getElementById("grnsellprice"+k).value;
            grngrnquantity[m] = document.getElementById("grngrnquantity"+k).value;
            grnamount[m] = document.getElementById("grnamount"+k).value;
            showgrnamount[m] = document.getElementById("showgrnamount"+k).value;
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
            
            tech += '<td data-label="Item Name"><input type="text" required class="form-control" onkeyup="autoitem('+ j +')" id="grnitemname' + j + '" name="grnitemname' + j + '" value="'+grnitemname[j]+'"/></td>';        
        
            tech += '<td data-label="Item Code"><input type="text" class="form-control" onkeyup="autocode('+ j +')" id="grnitemcode' + j + '" name="grnitemcode' + j + '" value="'+grnitemcode[j]+'"/></td>';

            tech += '<td data-label="Unit Price"><input type="text" onkeypress="return numOnly(event);" class="form-control" style="text-align: right;" id="grnunitprice' + j + '" name="grnunitprice' + j + '" onchange="grnUnitToQuantity('+ j +');grnFullTotal('+ i +');poDiscount();poNbt();poVat();" value="'+grnunitprice[j]+'" /><input type="hidden" name="hidgrnunitprice' + j + '" id="hidgrnunitprice' + j + '" value="'+hidgrnunitprice[j]+'"></td>';

            tech += '<td data-label="Sell Price"><input type="text" class="form-control" onkeypress="return numOnly(event);"  style="text-align: right;" id="grnsellprice' + j + '" name="grnsellprice' + j + '" value="'+grnsellprice[j]+'"/></td>';

            tech += '<td data-label="GRN Quantity"><input type="text" onkeypress="return numOnly(event);" class="form-control" id="grngrnquantity' + j + '" name="grngrnquantity' + j + '" onchange="grnUnitToQuantity('+ j +');grnFullTotal('+ j +');poDiscount();poNbt();poVat();" value="'+grngrnquantity[j]+'"/></td>';

            tech += '<td data-label="Amount (Rs)"><input type="text" onkeypress="return numOnly(event);" class="form-control" style="text-align: right;" id="grnamount' + j + '" name="grnamount' + j + '" readonly value="'+grnamount[j]+'"/><input type="hidden" name="showgrnamount' + j + '" id="showgrnamount' + j + '" value="'+showgrnamount[j]+'"></td>';

            tech += '<td data-label="Action"><input type="button" class="ibtnDel btn btn-md btn-danger" value="Delete" onclick="deleteAddRows('+j+');grnFullTotal();poDiscount();poNbt();poVat();"></td></tr>';
            j++;
        }
    }
    tech += "</table>";
    document.getElementById("tech").innerHTML = tech;
    document.getElementById("numrows").value = int_num_rows-1;
}
</script>

<?php 
if($_POST['polist'] == '')
{
   ?>
    <center><i><b>Please Don't Leave Empty</b></i></center>
   <?php
    exit;
}            
?>
<form class="form" id="grnform" name="grnform" action="goodresivenoteSubmit.php" method="post" enctype="multipart/form-data">
<div class="form-element panel form-element-padding">
    <div class="panel-body col-md-12" style="padding-bottom:30px;">
        <div class = "row">   
            <?php 
            if($_POST['polist'] != 'grn')
            {
                
                $poresult = $inventory->getapprovedPOrders($_POST['polist']);
                $porow = mysqli_fetch_array($poresult);
                ?>
            <input type="hidden" name="purchaseorderno" id="purchaseorderno" value="<?=$_POST['polist']?>">
            <input type="hidden" name="grndate" id="grndate" value="<?=$_POST['grndate']?>">
            <table id="myTable" class="table justtablle">
                <thead>
                    <tr>
                        <th scope="col"><i>Supplier Name <span id = "redstar">*</span></i></th>
                        <th scope="col"><i>Bill Date</i></th>
                        <th scope="col"><i>Warehouse <span id = "redstar">*</span></i></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td data-label="Supplier Name">
                            <select class="form-control " style="margin-bottom:20px;" name="posupplierid" id="posupplierid">
                                <option value="">-Please Select-</option>
                                <?php
                                $sqlselectsupplier = $customer->selectsupplier();
                                while($fetchselectsupplier = mysqli_fetch_array($sqlselectsupplier))
                                {
                                    if($porow['supplier'] == $fetchselectsupplier['id'])
                                    {
                                        ?>
                                        <option value = "<?=$fetchselectsupplier['id']?>" selected><?=$fetchselectsupplier['name']?></option>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <option value = "<?=$fetchselectsupplier['id']?>"><?=$fetchselectsupplier['name']?></option>
                                        <?php 
                                    }
                                }
                                ?>                                    
                            </select>
                        </td>
                        <td data-label="Bill Date">
                            <input type="text" class="form-text mask-placeholder form-control android" placeholder="MM/DD/YYYY"  value="<?=$date?>" name="pobilldate" id="pobilldate">
                        </td>
                        <td data-label="Supplier Name">
                            <select class="form-control " style="margin-bottom:20px;" name="powarehouse" id="powarehouse">
                                <option value="">-Please Select-</option>
                                <?php
                                $sqlwarehouse = $inventory->warehouse();
                                while($fetchwarehouse = mysqli_fetch_array($sqlwarehouse))
                                {
                                ?>
                                <option value = "<?=$fetchwarehouse['id']?>"><?=$fetchwarehouse['name']?></option>
                                <?php                                      
                                }
                                ?>                                    
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table id="myTable" class="table po-order-list">
                <thead>
                    <tr>
                        <th scope="col">Item Name <span id = "redstar">*</span></th>
                        <th scope="col">Item Code</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Sell Price</th>
                        <th scope="col">PO Quantity</th>
                        <th scope="col">GRN Quantity</th>
                        <th scope="col">Amount (Rs)</th>
                        <th scope="col">Remove</th>
                    </tr>
                </thead>
                <?php 
                $poresult1 = $inventory->getapprovedPOrders($_POST['polist']);
                ?>
                <tbody>
                <?php   
                $i = 1;
                
                while($porow1 = mysqli_fetch_array($poresult1))
                {                   
                ?>
                    <tr>
                        <td data-label="Item Name">
                            <input type="text" readonly class="form-control" name="itemname<?=$i?>" id="itemname<?=$i?>" autocomplete="off" value="<?=$porow1['itemname']?>">
                        </td>
                        <td data-label="Item Code">
                            <input type="text" readonly class="form-control" name="itemcode<?=$i?>" id="itemcode<?=$i?>" autocomplete="off" value="<?=$porow1['itemcode']?>">
                        </td>
                        <td data-label="Unit Price">
                            <input type="text"  class="form-control" onkeypress="return numOnly(event);" name="unitprice<?=$i?>" id="unitprice<?=$i?>" autocomplete="off" style="text-align: right;" value="<?=$porow1['unitprice']?>" onchange="poUnitToQuantity(<?=$i?>);poFullTotal();poDiscount();poNbt();poVat();">
                            <input type="hidden"  class="form-control" onkeypress="return numOnly(event);" name="hidunitprice<?=$i?>" id="hidunitprice<?=$i?>" autocomplete="off" style="text-align: right;" value="<?=$porow1['unitprice']?>" onchange="poUnitToQuantity(<?=$i?>);poFullTotal();">
                            
                        </td>
                        <td data-label="Sell Price">
                            <input type="text" class="form-control" onkeypress="return numOnly(event);" name="sellprice<?=$i?>" id="sellprice<?=$i?>" autocomplete="off" style="text-align: right;" value="<?=$porow1['sellprice']?>">
                        </td>
                        <td data-label="PO Quantity">
                            <input type="text" readonly class="form-control"name="poquantity<?=$i?>" id="poquantity<?=$i?>" autocomplete="off" value="<?=$porow1['quantity']?>" onkeypress="return numOnly(event);">
                        </td>
                        <td data-label="GRN Quantity">
                            <input type="text" class="form-control"name="grnquantity<?=$i?>" id="grnquantity<?=$i?>" autocomplete="off" value="<?=$porow1['grn_quantity']?>" onchange="validationgrnQuan(<?=$i?>);poUnitToQuantity(<?=$i?>);poFullTotal();poDiscount();poNbt();poVat();" onkeypress="return numOnly(event);">
                            <input type="hidden" class="form-control"name="hidgrnquantity<+id?=$i?>" id="hidgrnquantity<?=$i?>" autocomplete="off" value="<?=$porow1['grn_quantity']?>" onchange="poUnitToQuantity(<?=$i?>);poFullTotal();">
                        </td>
                        <td data-label="Amount (Rs)">
                            <?php
                            $totam = $porow1['unitprice'] * $porow1['quantity'];  
                            $grnsum += $totam;
                            ?>
                            <input type="hidden" class="form-control" onkeypress="return numOnly(event);" name="showamount<?=$i?>" id="showamount<?=$i?>" autocomplete="off" style="text-align: right;" readonly value="<?=$totam?>">
                            <input type="text" class="form-control" onkeypress="return numOnly(event);" name="amount<?=$i?>" id="amount<?=$i?>" autocomplete="off" style="text-align: right;" readonly value="<?=$totam?>">
                        </td>
                        <td data-label="Remove">
                            <div class="form-animate-checkbox" style="padding-bottom: 5px;">
                                <input type="checkbox" class="checkbox" name="del<?=$i?>" id="del<?=$i?>" onclick="removeid(<?=$i?>);poFullTotal();poDiscount();poNbt();poVat();">
                            </div>
                        </td>
                    </tr> 
                    
                <?php 
                    $i++;
                }
                ?>
                </tbody>
            </table>
            <input type="hidden" name="numrows" id="numrows" value="<?=$i?>">
                <?php
            }
            else if($_POST['polist'] == 'grn')
            {
                ?>
            <input type="hidden" name="purchaseorderno" id="purchaseorderno" value="<?=$_POST['polist']?>">
            <input type="hidden" name="grndate" id="grndate" value="<?=$_POST['grndate']?>">
            <table id="myTable" class="table justtablle">
                <thead>
                    <tr>
                        <th scope="col"><i>Supplier Name <span id = "redstar">*</span></i></th>
                        <th scope="col"><i>Bill Date</i></th>
                        <th scope="col"><i>Warehouse <span id = "redstar">*</span></i></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td data-label="Supplier Name">
                            <select class="form-control " style="margin-bottom:20px;" name="grnsupplierid" id="grnsupplierid">
                                <option value="">-Please Select-</option>
                                <?php
                                $sqlselectsupplier = $customer->selectsupplier();
                                while($fetchselectsupplier = mysqli_fetch_array($sqlselectsupplier))
                                {
                                ?>
                                <option value = "<?=$fetchselectsupplier['id']?>"><?=$fetchselectsupplier['name']?></option>
                                <?php                                      
                                }
                                ?>                                    
                            </select>
                        </td>
                        <td data-label="Bill Date">
                            <input type="text" class="form-text mask-placeholder form-control android" placeholder="MM/DD/YYYY"  value="<?=$date?>" name="grnbilldate" id="grnbilldate">
                        </td>
                        <td data-label="Supplier Name">
                            <select class="form-control " style="margin-bottom:20px;" name="grnwarehouse" id="grnwarehouse">
                                <option value="">-Please Select-</option>
                                <?php
                                $sqlwarehouse = $inventory->warehouse();
                                while($fetchwarehouse = mysqli_fetch_array($sqlwarehouse))
                                {
                                ?>
                                <option value = "<?=$fetchwarehouse['id']?>"><?=$fetchwarehouse['name']?></option>
                                <?php                                      
                                }
                                ?>                                    
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table id="myTable" class="table order-list">
                <thead>
                    <tr>
                        <th scope="col">Item Name <span id = "redstar">*</span></th>
                        <th scope="col">Item Code</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Sell Price</th>
                        <th scope="col">GRN Quantity <span id = "redstar">*</span></th>
                        <th scope="col">Amount (Rs)</th>
                        <th scope="col">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td data-label="Item Name">
                            <input type="text" class="form-control" name="grnitemname1" id="grnitemname1" autocomplete="off" onkeyup="autoitem(1)" required>
                        </td>
                        <td data-label="Item Code">
                            <input type="text" class="form-control" name="grnitemcode1" id="grnitemcode1" autocomplete="off" onkeyup="autocode(1)">
                        </td>
                        <td data-label="Unit Price">
                            <input type="text"  class="form-control" onkeypress="return numOnly(event);" name="grnunitprice1" id="grnunitprice1" autocomplete="off" style="text-align: right;" onchange="grnUnitToQuantity(1);grnFullTotal(1);poDiscount();poNbt();poVat();" value="0">
                        </td>
                        <td data-label="Sell Price">
                            <input type="text" class="form-control" onkeypress="return numOnly(event);" name="grnsellprice1" id="grnsellprice1" autocomplete="off" style="text-align: right;" value="0">
							<input type="hidden" name="hidgrnunitprice1" id="hidgrnunitprice1" value="0">
                        </td>
                        <td data-label="GRN Quantity">
                            <input type="text" class="form-control" name="grngrnquantity1" id="grngrnquantity1" autocomplete="off" onkeypress="return numOnly(event);" onchange="grnUnitToQuantity(1);grnFullTotal(1);poDiscount();poNbt();poVat();" value="0">
                        </td>
                        <td data-label="Amount (Rs)">
                            <input type="text" class="form-control" onkeypress="return numOnly(event);" name="grnamount1" id="grnamount1" autocomplete="off" style="text-align: right;" readonly value="0">
							<input type="hidden" name="showgrnamount1" id="showgrnamount1" value="0">
                        </td>
                        <td data-label="&nbsp">
                             <a class="deleteRow"></a>
                        </td>
                    </tr> 
                </tbody>
            </table>
            <div id="tech"></div>
            <div class ="row">
                <div class="col-md-12" style="margin-top:22px;">
                    <input type="hidden" name="numrows" id="numrows" value="1">
                    &nbsp;&nbsp;<button type="button" name="addmore" id="addmore" class="btn ripple-infinite btn-round btn-success" onclick="addMore()">
                        <div>
                            <span>Add Row</span>
                        </div>
                    </button>
                </div>
            </div>
                <?php   
            }
            ?>
            <table id="myTable" class="table total">
                <tbody class="colspanHead">                    
                    <tr>
                        <tr>
                           <td scope="col" colspan="4">&nbsp;</td>
                           <td scope="col">
                               <b><i>GRN TOTAL (Rs)</i></b>
                           </td>
                           <td scope="col">
                               <input type="text" class="form-control" onkeypress="return numOnly(event);" name="grntotal" id="grntotal" autocomplete="off" style="text-align: right;" readonly value="<?=$grnsum?>">
                           </td>
                        </tr>
                        <tr>
                           <td scope="col" colspan="4">&nbsp;</td>
                           <td scope="col">
                               <div class="form-animate-checkbox" style="padding-bottom: 5px;">
                                    <input type="checkbox" class="checkbox" name="confirmdiscount" id="confirmdiscount" onclick="enableDiscount();poDiscount();poNbt();poVat();">
                                </div>&nbsp;&nbsp;&nbsp;
                               <b><i>Discount</i></b>
                           </td>
                           <td scope="col">
                               <input type="text" class="form-control" onkeypress="return numOnly(event);" name="grndiscount" id="grndiscount" autocomplete="off" style="text-align: right;" readonly onchange="poDiscount();poNbt();poVat();" value="0">
                               <input type="hidden" name="discountamount" id="discountamount" value="0">
                           </td>
                        </tr>
                        <tr>
                           <td scope="col" colspan="4">&nbsp;</td>
                           <td scope="col">
                               <div class="form-animate-checkbox" style="padding-bottom: 5px;">
                                    <input type="checkbox" class="checkbox" name="confirmnbt" id="confirmnbt" onclick="enableNbt();poNbt()">
                                </div>&nbsp;&nbsp;&nbsp;
                               <b><i>NBT 2 %</i></b>
                           </td>
                           <td scope="col">
                               <input type="text" class="form-control" onkeypress="return numOnly(event);" name="grnnbt" id="grnnbt" autocomplete="off" style="text-align: right;" readonly value="0">
                           </td>
                        </tr>
                        <tr>
                           <td scope="col" colspan="4">&nbsp;</td>
                           <td scope="col">
                               <div class="form-animate-checkbox" style="padding-bottom: 5px;">
                                    <input type="checkbox" class="checkbox" name="confirmvat" id="confirmvat" onclick="enableVat();poVat();">
                                </div>&nbsp;&nbsp;&nbsp;                                    
                                <b><i>VAT 15 %</i></b>
                           </td>
                           <td scope="col">
                               <input type="text" class="form-control" onkeypress="return numOnly(event);" name="grnvat" id="grnvat" autocomplete="off" style="text-align: right;" readonly value="0">
                           </td>
                        </tr>
                        <tr>
                           <td scope="col" colspan="4">&nbsp;</td>
                           <td scope="col">
                               <b><i>Sub TOTAL (Rs)</i></b>
                           </td>
                           <td scope="col">
                               <input type="text" class="form-control" onkeypress="return numOnly(event);" name="subtotal" id="subtotal" autocomplete="off" style="text-align: right;" readonly value="<?=$grnsum?>">
                           </td>
                        </tr>   
                    </tr>
                </tbody>
            </table>
            <div class="panel-body">
                <div class="col-md-10"></div>
                <div class="col-md-2">
                    <button type="submit" name="save" id="save" style="margin-top:0px !important;" class="btn-flip btn btn-3d btn-primary">
                        <div class="flip">
                            <div class="side">
                                Submit <span class="fa fa-check"></span>
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
</form>   

<script>
   $(function() {
  $("form[name='grnform']").validate({
    rules:
        {
            posupplierid: {
                required: true,
            },
            pobilldate: {
                required: true,
            }, 
            powarehouse: {
                required: true,
            },
            grnsupplierid: {
                required: true,
            },
            grnbilldate: {
                required: true,
            },
            grnwarehouse: {
                required: true,
            },
        },
        messages:
        {
            posupplierid: {
                required: "This Field is Required"
            },
            pobilldate: {
                required: "This Field is Required"
            },
            powarehouse: {
                required: "This Field is Required"
            }, 
            grnsupplierid: {
                required: "This Field is Required"
            },
            grnbilldate: {
                required: "This Field is Required"
            },
            grnwarehouse: {
                required: "This Field is Required"
            }, 
        },
    submitHandler: function(form) {
      form.submit();
    }
  });
});
    </script>