<?php include 'header.php';?>

      <!-- end: Header -->
<?php include 'sidnav.php';?>
<?php $date2 = $object->getDate(); ?>
<script>
function numOnly(e) 
{
    var k;
    document.all ? k = e.keyCode : k = e.which;
    return ((k > 47 && k < 58));
}
function getXmlHttpRequestObject() {
	if (window.XMLHttpRequest) {
		return new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {
		return new ActiveXObject("Microsoft.XMLHTTP");
	}
	else {
	}
}

var receiveReq = getXmlHttpRequestObject();
    

    
function getbalance(i) {
	

	var req = getXmlHttpRequestObject();	
	if (req) {
		req.onreadystatechange = function() {
			if (req.readyState == 4) {		
				if (req.status == 200) {	
					document.getElementById('getissuediv').innerHTML = req.responseText;
				}
				else {
					alert("Please Wait !!");
				}
			}
		}
		
		var billno = document.getElementById('billno'+i).value;

        strURL = "getissueitems.php?billno="+billno;
		req.open("GET", strURL, true);
		req.send(null);
	}
		
}
</script>
<style>
  .error 
  {
    color: #ff0000;
  }
  </style>
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
  <form action="reciptsub.php" method="post" enctype="multipart/form-data">
        <div class="container-fluid mimin-wrapper">
            <div id="content">
                <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft">Issue Note</h3>
                        <p class="animated fadeInDown">
                          Sales Related <span class="fa-angle-right fa"></span> Issue Note
                        </p>
                    </div>
                  </div>
                </div>
                <div class="form-element">
                  <div class="col-md-12 padding-0"> 
                    <div class="col-md-12">
                      <div class="panel form-element-padding">
                        <div class="panel-heading">
                         <h4>Issue Note Form</h4>
                        </div>
                         <div class="panel-body" style="padding-bottom:30px;">
                            <div class="form-element">
                                  <div class="col-md-12 padding-0">                       
                                    <div class="col-md-12">
                                      <div class="panel form-element-padding">  
                                        <div class="panel-body" style="padding-bottom:30px;">
                                            <?php
                                            $sqlselectbilltype = $sales->selectbilltype();
                                            $countselectbilltype = mysqli_num_rows($sqlselectbilltype);
                                            if($countselectbilltype <= 0 )
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
                                                            <th scope="col">Invoice Date</th>
                                                            <th scope="col">Customer</th>
                                                            <th scope="col">Warehouse</th>
                                                            <th scope="col">Total(Rs)</th>                                 
                                                            <th scope="col">Select</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $i = 1;
                                                        while($fetchselectbilltype = mysqli_fetch_array($sqlselectbilltype))
                                                        {
                                                        ?>
                                                        <tr>
                                                            <td data-label="#">
                                                                <label><?=$i?></label>
                                                            </td>
                                                            <td data-label="Invoice No">
                                                                <label><?=$fetchselectbilltype['billNo']?></label>
                                                            </td>
                                                            <td data-label="Invoice Date">
                                                                <label><?=$fetchselectbilltype['billDate']?></label>
                                                            </td>
                                                            <td data-label="Customer">
                                                                <?php
                                                                $customerid = $fetchselectbilltype['customer'];
                                                                $sqlselectcustomerbyid = $customer->selectcustomerbyid($customerid);
                                                                $fetchselectcustomerbyid = mysqli_fetch_array($sqlselectcustomerbyid);
                                                                ?>
                                                                <label><?=$fetchselectcustomerbyid['name']?></label>   
                                                            </td>
                                                            <td data-label="Warehouse">
                                                                <?php
                                                                $warehouseid = $fetchselectbilltype['warehouse'];
                                                                $sqlselectwherehouseid = $sales->selectwherehouseid($warehouseid);
                                                                $fetchselectwherehouseid = mysqli_fetch_array($sqlselectwherehouseid);
                                                                ?>
                                                                <label><?=$fetchselectwherehouseid['name']?></label>
                                                            </td>
                                                            <td data-label="Total(Rs)">
                                                                <label><?=number_format($fetchselectbilltype['subTotal'],2)?></label>
                                                            </td>
                                                            <td data-label="Select">
                                                                <label>
                                                                    <div class="form-animate-checkbox" style = "margin-left:50%;">
                                                                    <input type="hidden" name = "billno<?=$i?>" id = "billno<?=$i?>" value = "<?=$fetchselectbilltype['billNo'];?>">
                                                                    <input type="radio" class="checkbox" name = "checkpay" id = "checkpay" onclick = "getbalance(<?=$i?>);">
                                                                    </div>
                                                                </label>
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
                      </div>
                    </div>
                  </div>
              </div>  
                 <div id = "getissuediv"></div>
            </div>
        </div>
</form>


        
     
  <!-- end: Javascript -->
  </body>
</html>
