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
<script>
function addMore()
{
    var itemname = new Array();
    var itemcode = new Array(); 
    var itemcat = new Array(); 
    var itembrand  = new Array(); 
    var costprice = new Array();
    var sellingprice = new Array();
    
    num_rows = parseInt(document.getElementById("numrows").value);
    totalrows = num_rows  + 1;
    
    for(i = 2; i < totalrows; i++)
    {
        itemname[i] = document.getElementById("itemname"+i).value;
        itemcode[i] = document.getElementById("itemcode"+i).value;
        itemcat[i] = document.getElementById("itemcat"+i).value;
        itembrand[i] = document.getElementById("itembrand"+i).value;
        costprice[i] = document.getElementById("costprice"+i).value;
        sellingprice[i] = document.getElementById("sellingprice"+i).value;
    }
    document.getElementById("tech").innerHTML = "";
    tech = '<table id="myTable" class=" table order-list">';
    
    for(i = 2; i <= totalrows; i++)
    {
        if(i ==  totalrows)
        {
            tech += '<tr>';
            
            tech += '<td data-label="Item Name"><input type="text" class="form-control" required id="itemname' + i + '" name="itemname' + i + '"/></td>';        
        
            tech += '<td data-label="Item Code"><input type="text" class="form-control" required id="itemcode' + i + '" name="itemcode' + i + '"/></td>';

            tech += '<td data-label="Item Category"><input type="text" class="form-control" required id="itemcat' + i + '" name="itemcat' + i + '" onkeyup = "getitemcatauto('+i+');"/></td>';
            
            tech += '<input type = "hidden" name = "catid' + i + '" id = "catid' + i + '">';

            tech += '<td data-label="Item Brand"><input type="text" class="form-control" id="itembrand' + i + '" required name="itembrand' + i + '" onkeyup="clearbrand(' + i + ');getbrandauto(' + i + ');"/></td>';
            
            tech += '<input type = "hidden" name = "brandid' + i + '" id = "brandid' + i + '">';

            tech += '<td data-label="Unit Price(Rs)"><input type="text" onkeypress="return numOnly(event);" required class="form-control" style="text-align: right;" id="costprice' + i + '" name="costprice' + i + '"/></td>';
            
            tech += '<td data-label="Unit Price(Rs)"><input type="text" onkeypress="return numOnly(event);" required class="form-control" style="text-align: right;" id="sellingprice' + i + '" name="sellingprice' + i + '"/></td>';

            tech += '<td data-label="Action"><input type="button" class="ibtnDel btn btn-md btn-danger" value="Delete" onclick="deleteAddRows('+i+');"></td></tr>';
        }
        else    
        {
            tech += '<tr>';
            
            tech += '<td data-label="Item Name"><input type="text" class="form-control" required id="itemname' + i + '" name="itemname' + i + '" value="'+itemname[i]+'"/></td>';        
        
            tech += '<td data-label="Item Code"><input type="text" class="form-control" required id="itemcode' + i + '" name="itemcode' + i + '" value="'+itemcode[i]+'"/></td>';

            tech += '<td data-label="Item Category"><input type="text" class="form-control" required id="itemcat' + i + '" name="itemcat' + i + '" value="'+itemcat[i]+'" onkeyup = "getitemcatauto('+i+');"/></td>';
            
            tech += '<input type = "hidden" name = "catid' + i + '" id = "catid' + i + '">';
            
            tech += '<td data-label="Item Brand"><input type="text" class="form-control" required id="itembrand' + i + '" name="itembrand' + i + '" value="'+itembrand[i]+'" onkeyup="clearbrand(' + i + ');getbrandauto(' + i + ');"/></td>';
            
            tech += '<input type = "hidden" name = "brandid' + i + '" id = "brandid' + i + '">';

            tech += '<td data-label="Unit Price(Rs)"><input type="text" onkeypress="return numOnly(event);" required class="form-control" style="text-align: right;" id="costprice' + i + '" name="costprice' + i + '" value="'+costprice[i]+'"/></td>';
            
            tech += '<td data-label="Unit Price(Rs)"><input type="text" onkeypress="return numOnly(event);" required class="form-control" style="text-align: right;" id="sellingprice' + i + '" name="sellingprice' + i + '" value="'+sellingprice[i]+'"/></td>';

            tech += '<td data-label="Action"><input type="button" class="ibtnDel btn btn-md btn-danger" value="Delete" onclick="deleteAddRows('+i+');"></td></tr>';
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
    var itemcat = new Array(); 
    var itembrand  = new Array(); 
    var costprice = new Array();
    var sellingprice = new Array();
    
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
        itemcat[m] = document.getElementById("itemcat"+k).value;
        itembrand[m] = document.getElementById("itembrand"+k).value;
        costprice[m] = document.getElementById("costprice"+k).value;
        sellingprice[m] = document.getElementById("sellingprice"+k).value;
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
            
            tech += '<td data-label="Item Name"><input type="text" class="form-control" required id="itemname' + j + '" name="itemname' + j + '" value="'+itemname[j]+'"/></td>';        
        
            tech += '<td data-label="Item Code"><input type="text" class="form-control" required id="itemcode' + j + '" name="itemcode' + j + '" value="'+itemcode[j]+'"/></td>';

            tech += '<td data-label="Item Category"><input type="text" class="form-control" required id="itemcat' + j + '" name="itemcat' + j + '" value="'+itemcat[j]+'" onkeyup = "getitemcatauto('+j+')"/></td>';

            tech += '<input type = "hidden" name = "catid' + j + '" id = "catid' + j + '">';
            
            tech += '<td data-label="Item Brand"><input type="text" class="form-control" required id="itembrand' + j + '" name="itembrand' + j + '" value="'+itembrand[j]+'" onkeyup="clearbrand(' + j + ');getbrandauto(' + j + ');"/></td>';
            
            tech += '<input type = "hidden" name = "brandid' + j + '" id = "brandid' + j + '">';
            
            tech += '<td data-label="Unit Price(Rs)"><input type="text" onkeypress="return numOnly(event);" required class="form-control" style="text-align: right;" id="costprice' + j + '" name="costprice' + j + '" value="'+costprice[j]+'"/></td>';
            
            tech += '<td data-label="Unit Price(Rs)"><input type="text" onkeypress="return numOnly(event);" required class="form-control" style="text-align: right;" id="sellingprice' + j + '" name="sellingprice' + j + '" value="'+sellingprice[j]+'"/></td>';

            tech += '<td data-label="Action"><input type="button" class="ibtnDel btn btn-md btn-danger" value="Delete" onclick="deleteAddRows('+j+');"></td></tr>';
            j++;
        }
    }
    tech += "</table>";
    document.getElementById("tech").innerHTML = tech;
    document.getElementById("numrows").value = int_num_rows-1;
}
    
function clearvalue()
    {
            document.getElementById("itemname1").value = "";
            document.getElementById("itemcode1").value = "";
            document.getElementById("itemcat1").value = "";
            document.getElementById("itembrand1").value = "";
            document.getElementById("costprice1").value = "";
            document.getElementById("sellingprice1").value = "";
        
    }
    
    
    function isNumberKey1(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;

	return true;
}

function isNumberKey(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode
	//if (charCode > 31 && (charCode < 48 || charCode > 57))
	if (charCode > 31 && (charCode < 46 || charCode > 57))
		return false;

	return true;
}
    
    
//function autocode(id)
//{
//    $(function() {
//        if($('#itemcat').val() == "")
//        {
//            $("#show").removeAttr("style").show();
//        }
//        else
//        {
//            $("#show").removeAttr("style").hide();       
//        }
//        $('#itemname'+id).val("");
//        $('#sellprice'+id).val("");
//        $('#quantity'+id).val("");
//        $('#unitprice'+id).val("");
//        $('#hidquan'+id).val(""); 
//        $('#showquan'+id).html('');
//        
//        $("#itemcode"+id).autocomplete({        
//            source: function(request, response) {
//                $.getJSON("autocompleteitemcode_purchaseorder.php",{ 
//                    term: $('#itemcode'+id).val(), 
//                    itemcats: $('#itemcat').val() }, response);
//            },
//            minLength: 1,
//	       select: function(event, ui) {
//           
//               $('#itemname'+id).val(ui.item.itemname);
//               $('#sellprice'+id).val(ui.item.sellprice);
//               $('#unitprice'+id).val(ui.item.unitprice);
//               $('#hidquan'+id).val(ui.item.hidquan);   
//               
//            }
//        });
//    });
//    
//}
    
function getitemcatauto(i)
{
    $(function() {
        $("#itemcat"+i).autocomplete({
            source: "auto_complete_itemcat.php",
            minLength: 1,
	       select: function(event, ui) {
           
               $('#itemcat'+i).val(ui.item.value);
               $('#catid'+i).val(ui.item.catid);
               
            }
        });
    });
    
}

    
function getbrandauto(i)
{    
    $(function() {
        if($('#itemcat'+i).val() == "")
        {
            $("#show"+i).removeAttr("style").show();
        }
        else
        {
            $("#show"+i).removeAttr("style").hide();       
        }
        
         $("#itembrand"+i).autocomplete({        
            source: function(request, response) {
                $.getJSON("auto_complete_itembrand.php",{ 
                    term: $('#itembrand'+i).val(), 
                    itemcatid: $('#catid'+i).val() }, response);
            },
            minLength: 1,
	       select: function(event, ui) {
           
               $('#itembrand'+i).val(ui.item.value);
               $('#brandid'+i).val(ui.item.brandid);  
               
            }
        });
    });    
}
    

function selectCategory(i)
{
    var itemcat  = document.getElementById('itemcat'+i).value;
    if(itemcat != '')
    {
        document.getElementById("show"+i).style.display="none";
    }
}

function clearbrand(i)
    {
      var itemcat  = document.getElementById('itemcat'+i).value;
        if(itemcat == '')
            {
                document.getElementById("itembrand"+i).value = '';
                document.getElementById("brandid"+i).value = '';
            }
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
      <!-- end: Header -->
<?php include 'sidnav.php';?>
        <div class="container-fluid mimin-wrapper">
            <div id="content">
                <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft">Stock Register</h3>
                        <p class="animated fadeInDown">
                          Stock Related <span class="fa-angle-right fa"></span> Stock Register
                        </p>
                    </div>
                  </div>
                </div>
                <div class="form-element">
                <form action="stockregsubmit.php" method="post" enctype="multipart/form-data">
                  <div class="col-md-12 padding-0">
                    <div class="col-md-12">
                      <div class="panel form-element-padding">
                        <div class="panel-heading">
                         <h4>Stock Register Form</h4>
                        </div>
                         <div class="panel-body" style="padding-bottom:30px;">
                      <table id="myTable" class=" table order-list">
                                <thead>
                                    <tr>
                                        <th scope="col">Item Name <span id = "redstar">*</span></th>
                                        <th scope="col">Item Code <span id = "redstar">*</span></th>
                                        <th scope="col">Item Category <span id = "redstar">*</span></th>
                                        <th scope="col">Item Brand <span id = "redstar">*</span></th>
                                        <th scope="col">Unit Price(Rs) <span id = "redstar">*</span></th>
                                        <th scope="col">Selling Price(Rs) <span id = "redstar">*</span></th>
                                        <th scope="col">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td data-label="Item Name">
                                            <input type="text" class="form-control" name="itemname1" required id="itemname1" autocomplete="off">
                                        </td>
                                        <td data-label="Item Code">
                                            <input type="text" class="form-control" name="itemcode1" required id="itemcode1" autocomplete="off">
                                        </td>
                                        <td data-label="Item Category">
                                            <input type="text" class="form-control" name="itemcat1" required id="itemcat1" autocomplete="off" onkeyup = "getitemcatauto(1);">
                                            <div  role="alert" id="show1" style="display: none;">
                                                <center><strong style="color: red"><i class="glyphicon glyphicon-warning-sign"></i>  Required </strong></center>
                                            </div>
                                            <input type = "hidden" name = "catid1" id = "catid1">
                                        </td>
                                        
                                        <td data-label="Item Brand">
                                            <input type="text" class="form-control"name="itembrand1" required id="itembrand1" autocomplete="off" onkeyup="clearbrand(1);getbrandauto(1);">
                                            <input type = "hidden" name = "brandid1" id = "brandid1">
                                        </td>
                                         <td data-label="Unit Price(Rs)">
                                            <input type="text" class="form-control"  onkeypress="return isNumberKey(evt);" required name="costprice1" id="costprice1" autocomplete="off" style="text-align: right;" maxlength="6">
                                        </td>
                                         <td data-label="Selling Price(Rs)">
                                            <input type="text" class="form-control"  onkeypress="return isNumberKey(evt);" required name="sellingprice1" id="sellingprice1" autocomplete="off" style="text-align: right;" maxlength="6">
                                        </td>
                                        <td data-label="">
                                            <button type="button" name="addmore" id="addmore" class="ibtnDel btn btn-md btn-danger" onclick="clearvalue();">
                                    <div>
                                        <span>Clear</span>
                                    </div>
                                    </button>
                                        </td>
                                    </tr> 
                                </tbody>
                            </table> 
                           <div id="tech"></div>
                             <div class="row">
                                 <div class = "col-md-10"></div>
                            <input type="hidden" name="numrows" id="numrows" value="1">
                                <div class="col-md-2" style="margin-top:22px;">
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
                              <button type="submit" style="margin-top:0px !important;" class="btn-flip btn btn-3d btn-primary">
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
                         

<!--
   <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script  src="asset/js/index.js"></script>
    <script src="asset/js/jquery.validate.min.js"></script>
-->
<!--    <script src="js/form-validation.js"></script>-->
<!--
    <script>
   $(function() {
  $("form[name='stockregid']").validate({
    rules:
        {
            itemcode1: {
                required: true,
                remote: {
                    url: "checkstockreg.php",
                    type: "post"
                }
            },
        },
        messages:
        {
            itemcode1: {
                required: "Enter a Valid Code",
                remote: "Stock Code Already Registered"
            } 
            
        },
    submitHandler: function(form) {
      form.submit();
    }
  });
});
    </script>
-->
  <!-- end: Javascript -->
  </body>
</html>