<?php include 'header.php';?>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/ui-darkness/jquery-ui.min.css" rel="stylesheet">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
<style>
  .error 
  {
    color: #ff0000;
  }
  </style>
<?php include 'sidnav.php';?>
<?php 
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

$date = $object->getDate();
?>
<script type="text/javascript">
function addMore()
{
    var itemname = new Array();
    var itemcode = new Array(); 
    var unitprice = new Array(); 
    var sellprice  = new Array(); 
    var quantity = new Array();
    var hidquan = new Array();
    
    num_rows = parseInt(document.getElementById("nums").value);
    totalrows = num_rows  + 1;
    
    for(i = 2; i < totalrows; i++)
    {
        itemname[i] = document.getElementById("itemname"+i).value;
        itemcode[i] = document.getElementById("itemcode"+i).value;
        unitprice[i] = document.getElementById("unitprice"+i).value;
        sellprice[i] = document.getElementById("sellprice"+i).value;
        quantity[i] = document.getElementById("quantity"+i).value;
        hidquan[i] = document.getElementById("hidquan"+i).value;
    }
    document.getElementById("tech").innerHTML = "";
    tech = '<table id="myTable" class=" table order-list">';
    
    for(i = 2; i <= totalrows; i++)
    {
        if(i ==  totalrows)
        {
            tech += '<tr>';
            tech += '<td data-label="Item Name"><input type="text" required class="form-control" onkeyup="autoitem('+ i +')" id="itemname' + i + '" name="itemname' + i + '"/></td>';   

            tech += '<td data-label="Item Code"><input type="text" class="form-control" onkeyup="autocode('+ i +')" id="itemcode' + i + '" name="itemcode' + i + '"/></td>';

            tech += '<td data-label="Sell Price"><input type="text" class="form-control" readonly style="text-align: right;" id="unitprice' + i + '" name="unitprice' + i + '"/></td>';

            tech += '<td data-label="Unit Price"><input type="text" readonly style="text-align: right;" class="form-control" id="sellprice' + i + '" name="sellprice' + i + '"/></td>';

            tech += '<td data-label="Quantity"><input type="text" required class="form-control" onkeypress="return numOnly(event);" onchange="calculateAmount('+ i +');checkQuantityEmp('+ i +')" style="text-align: right;" id="quantity' + i + '" name="quantity' + i + '" maxlength="6"/><input type="hidden" name="hidquan' + i + '" id="hidquan' + i + '"><div class="col-lg-12"><br><center><label id="showquan' + i + '"></label></center></div></td>';

            tech += '<td data-label="Action"><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete" name="deletename'+i+'" id="deletename'+i+'" onclick="javascript:deleteAddRows('+i+')"></td></tr>';
        }
        else    
        {
            tech += '<tr>';
            tech += '<td data-label="Item Name"><input type="text" class="form-control" required onkeyup="autoitem('+ i +')" id="itemname' + i + '" name="itemname' + i + '"  value="'+itemname[i]+'" /></td>';   

            tech += '<td data-label="Item Code"><input type="text" class="form-control" onkeyup="autocode('+ i +')" id="itemcode' + i + '" name="itemcode' + i + '" value="'+itemcode[i]+'"/></td>';

            tech += '<td data-label="Sell Price"><input type="text" class="form-control" readonly style="text-align: right;" id="unitprice' + i + '" name="unitprice' + i + '" value="'+unitprice[i]+'"/></td>';

            tech += '<td data-label="Unit Price"><input type="text" readonly style="text-align: right;" class="form-control" id="sellprice' + i + '" name="sellprice' + i + '" value="'+sellprice[i]+'"/></td>';

            tech += '<td data-label="Quantity"><input type="text" class="form-control" onkeypress="return numOnly(event);" onchange="calculateAmount('+ i +');checkQuantityEmp('+ i +')" required style="text-align: right;" id="quantity' + i + '" name="quantity' + i + '" maxlength="6" value="'+quantity[i]+'"/><input type="hidden" name="hidquan' + i + '" id="hidquan' + i + '" value="'+hidquan[i]+'"><div class="col-lg-12"><br><center><label id="showquan' + i + '"></label></center></div></td>';

            tech += '<td data-label="Action"><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete" name="deletename'+i+'" id="deletename'+i+'" onclick="javascript:deleteAddRows('+i+')"></td></tr>'; 
        }
    }
    
    tech += "</table>";
    document.getElementById("tech").innerHTML = tech;
    document.getElementById("nums").value = totalrows;
}

function deleteAddRows(row)
{
    var itemname = new Array();
    var itemcode = new Array(); 
    var unitprice = new Array(); 
    var sellprice  = new Array(); 
    var quantity = new Array();
    var hidquan = new Array();
    
    num_rows = parseInt(document.getElementById("nums").value);
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
            unitprice[m] = document.getElementById("unitprice"+k).value;
            sellprice[m] = document.getElementById("sellprice"+k).value;
            quantity[m] = document.getElementById("quantity"+k).value;
            hidquan[m] = document.getElementById("hidquan"+k).value;
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
            tech += '<td data-label="Item Name"><input type="text" class="form-control" required onkeyup="autoitem('+ j +')" id="itemname' + j + '" name="itemname' + j + '"  value="'+itemname[j]+'" /></td>';   

            tech += '<td data-label="Item Code"><input type="text" class="form-control" onkeyup="autocode('+ j +')" id="itemcode' + j + '" name="itemcode' + j + '" value="'+itemcode[j]+'"/></td>';

            tech += '<td data-label="Sell Price"><input type="text" class="form-control" readonly style="text-align: right;" id="unitprice' + j + '" name="unitprice' + j + '" value="'+unitprice[j]+'"/></td>';

            tech += '<td data-label="Unit Price"><input type="text" readonly style="text-align: right;" class="form-control" id="sellprice' + j + '" name="sellprice' + j + '" value="'+sellprice[j]+'"/></td>';

            tech += '<td data-label="Quantity"><input type="text" class="form-control" onkeypress="return numOnly(event);" onchange="calculateAmount('+ j +');checkQuantityEmp('+ j +')" required style="text-align: right;" id="quantity' + j + '" name="quantity' + j + '" maxlength="6" value="'+quantity[j]+'"/><input type="hidden" name="hidquan' + j + '" id="hidquan' + j + '" value="'+hidquan[j]+'"><div class="col-lg-12"><br><center><label id="showquan' + j + '"></label></center></div></td>';

            tech += '<td data-label="Action"><input type="button" class="ibtnDel btn btn-md btn-danger"  value="Delete" id="deletename'+j+'" name="deletename'+j+'" onclick="javascript:deleteAddRows('+j+')"></td></tr>';
            j++;
        }
    }
    tech += "</table>";
    document.getElementById("tech").innerHTML = tech;
    document.getElementById("nums").value = int_num_rows-1;
}
</script>
<script>	
function autoitem(id)
{    
    $(function() {
        if($('#itemcat').val() == "")
        {
            $("#show").removeAttr("style").show();
        }
        else
        {
            $("#show").removeAttr("style").hide();       
        }
        $('#itemcode'+id).val("");
        $('#sellprice'+id).val("");
        $('#quantity'+id).val("");
        $('#unitprice'+id).val("");
        $('#hidquan'+id).val(""); 
        $('#showquan'+id).html('');
        
        $("#itemname"+id).autocomplete({        
            source: function(request, response) {
                $.getJSON("autocompleteitem_purchaseorder.php",{ 
                    term: $('#itemname'+id).val(), 
                    itemcats: $('#itemcat').val() }, response);
            },
            minLength: 1,
	       select: function(event, ui) {
           
               $('#itemcode'+id).val(ui.item.itemcode);
               $('#sellprice'+id).val(ui.item.sellprice);
               $('#unitprice'+id).val(ui.item.unitprice);
               $('#hidquan'+id).val(ui.item.hidquan);   
               
            }
        });
    });    
}

function autocode(id)
{
    $(function() {
        if($('#itemcat').val() == "")
        {
            $("#show").removeAttr("style").show();
        }
        else
        {
            $("#show").removeAttr("style").hide();       
        }
        $('#itemname'+id).val("");
        $('#sellprice'+id).val("");
        $('#quantity'+id).val("");
        $('#unitprice'+id).val("");
        $('#hidquan'+id).val(""); 
        $('#showquan'+id).html('');
        
        $("#itemcode"+id).autocomplete({        
            source: function(request, response) {
                $.getJSON("autocompleteitemcode_purchaseorder.php",{ 
                    term: $('#itemcode'+id).val(), 
                    itemcats: $('#itemcat').val() }, response);
            },
            minLength: 1,
	       select: function(event, ui) {
           
               $('#itemname'+id).val(ui.item.itemname);
               $('#sellprice'+id).val(ui.item.sellprice);
               $('#unitprice'+id).val(ui.item.unitprice);
               $('#hidquan'+id).val(ui.item.hidquan);   
               
            }
        });
    });
    
}
function selectCategory()
{
    var itemcat  = document.getElementById('itemcat').value;
    if(itemcat != '')
    {
        document.getElementById("show").style.display="none";
    }
}

function numOnly(e) 
{
    var k;
    document.all ? k = e.keyCode : k = e.which;
    return ((k > 47 && k < 58));
}
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
<div class="container-fluid mimin-wrapper">
    <div id="content">
        <div class="panel box-shadow-none content-header">
            <div class="panel-body">
                <div class="col-md-12">
                    <h3 class="animated fadeInLeft">Purchase Order</h3>
                    <p class="animated fadeInDown">
                        Inventory <span class="fa-angle-right fa"></span> Purchase Order
                    </p>
                </div>
            </div>
        </div>        
        <div class="form-element">
            <form class="form" id="purhcaseform" name="purhcaseform" action="purchaseorderSub.php" method="post" enctype="multipart/form-data">
            <div class="col-md-12 padding-0"> 
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="panel form-element-padding">
                        <div class="panel-heading">
                            <h4>Purchase Order</h4>
                        </div>
                        <div class="panel-body" style="padding-bottom:30px;">
                            <div class="col-md-4"> 
                                <label>Purchase No</label>
                                <input type="text" class="form-control android" name="purchaseno" id="purchaseno" readonly value="<?=$purchaseno?>">
                            </div>
                            <div class="col-md-4 form-animate-text"> 
                                <label>Purchase Date</label>
                                <input type="text" class="form-text mask-placeholder form-control android" placeholder="MM/DD/YYYY"  required value="<?=$date?>" name="purchasedate" id="purchasedate">
                            </div>
                            <div class="col-md-4"> 
                                <label>Supplier Name <span id = "redstar">*</span></label>
                                <select class="form-control " style="margin-bottom:20px;" name="supplierid" id="supplierid"  onchange="loa()">
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
                            </div>                          
                            <div class="col-md-4"> 
                                <label>Item Category <span id = "redstar">*</span></label>
                                <select class="form-control " name="itemcat" id="itemcat"  style="margin-bottom:20px;" onchange="selectCategory()">
                                    <option value="">-Please Select-</option>
                                   <?php
                                   $sqlselectstockcat = $stock->selectstockcat();
                                   while($fetchselectstockcat = mysqli_fetch_array($sqlselectstockcat))
                                   {                                   
                                   ?>
                                    <option value = "<?php echo $fetchselectstockcat['id'];?>"><?php echo $fetchselectstockcat['name'];?></option>
                                   <?php
                                   }
                                   ?>
                                </select>
                                <div  role="alert" id="show" style="display: none;">
                                    <center><strong style="color: red"><i class="glyphicon glyphicon-warning-sign"></i>  Required </strong></center>
                                </div>
                                <input type="hidden" name="counters" id="counters" value="2">
                            </div>                     
                        </div>                     
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
            <div class="col-md-12 padding-0">       
                <div class="col-md-12">
                    <div class="panel form-element-padding">  
                        <div class="panel-body" style="padding-bottom:30px;">
                            <table id="myTable" class=" table order-list">
                                <caption>Orders</caption>
                                <thead>
                                    <tr>
                                        <th scope="col">Item Name <span id = "redstar">*</span></th>
                                        <th scope="col">Item Code</th>
                                        <th scope="col">Unit Price</th>
                                        <th scope="col">Sell Price</th>
                                        <th scope="col">PO Quantity <span id = "redstar">*</span></th>
                                        <th scope="col">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td data-label="Item Name">
                                            <input type="text" class="form-control" name="itemname1" id="itemname1" autocomplete="off" onkeyup="autoitem(1)" required>
                                        </td>
                                        <td data-label="Item Code">
                                            <input type="text" class="form-control" name="itemcode1" id="itemcode1" autocomplete="off" onkeyup="autocode(1)">
                                        </td>
                                        <td data-label="Unit Price">
                                            <input type="text" readonly class="form-control" name="unitprice1" id="unitprice1" autocomplete="off" style="text-align: right;">
                                        </td>
                                        <td data-label="Sell Price">
                                            <input type="text" readonly class="form-control"name="sellprice1" id="sellprice1" autocomplete="off" style="text-align: right;">
                                        </td>
                                        <td data-label="Quantity">
                                            <input type="text" class="form-control"  onkeypress="return numOnly(event);" name="quantity1" id="quantity1" autocomplete="off" style="text-align: right;" maxlength="6" required>
                                            <input type="hidden" name="hidquan1" id="hidquan1">
                                            <div class="col-lg-12">
                                                <br><center><label id="showquan1"></label></center>
                                            </div>
                                        </td>
                                        <td data-label="&nbsp;">
                                            <a class="deleteRow"></a>
                                        </td>
                                    </tr> 
                                </tbody>
                            </table>
                            <div id="tech">
                                
                            </div>
                            <div class="row">
                                <div class="col-md-12" style="margin-top:22px;">
                                    <input type="hidden" name="nums" id="nums" value="1">
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
                    <div class="panel-body">
                        <div class="col-md-9"></div>
                            <div class="col-md-3">
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
                </form>
            </div>            
        </div>
    </div>
<script>
$(function() {
  $("form[name='purhcaseform']").validate({
    rules: {    
      purchaseno: {
          required: true,
      },        
      purchasedate: {
        required: true,
      },
      supplierid: {
        required: true,
      },
      itemcat: {
        required: true,
      }
    
    },
    messages: {
      purchaseno: {
         required: "This Field is Required"
      },
      purchasedate: {
        required: "This Field is Required"
      },
      supplierid: {
        required: "This Field is Required"
      },
      itemcat: {
        required: "This Field is Required"
      }    
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
});
</script>
</body>
</html>.
