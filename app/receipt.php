<?php include 'header.php';?>

      <!-- end: Header -->
<?php include 'sidnav.php';?>
<?php $date2 = $object->getDate(); ?>
<script>

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
    

    
function getbalance() {
	

	var req = getXmlHttpRequestObject();	
	if (req) {
		req.onreadystatechange = function() {
			if (req.readyState == 4) {		
				if (req.status == 200) {	
					document.getElementById('getbalancediv').innerHTML = req.responseText;
				}
				else {
					alert("Please Wait !!");
				}
			}
		}
		
		var customerid = document.getElementById('customerid').value;

        strURL = "getcustomerbalance.php?customerid="+customerid;
		req.open("GET", strURL, true);
		req.send(null);
	}
		
}
    
    
function getpaytext(i) {
	

	var req = getXmlHttpRequestObject();	
	if (req) {
		req.onreadystatechange = function() {
			if (req.readyState == 4) {		
				if (req.status == 200) {	
					document.getElementById('getpaytextdiv').innerHTML = req.responseText;
				}
				else {
					alert("Please Wait !!");
				}
			}
		}
		
		var billno = document.getElementById('billno'+i).value;

        strURL = "getbalancetext.php?billno="+billno;
		req.open("GET", strURL, true);
		req.send(null);
	}
		
}

    
function getcreditinfo() {
	

	var req = getXmlHttpRequestObject();	
	if (req) {
		req.onreadystatechange = function() {
			if (req.readyState == 4) {		
				if (req.status == 200) {	
					document.getElementById('getcreditinfodiv').innerHTML = req.responseText;
				}
				else {
					alert("Please Wait !!");
				}
			}
		}
		
		var paytype = document.getElementById('paytype').value;

        strURL = "creditinfor.php?paytype="+paytype;
		req.open("GET", strURL, true);
		req.send(null);
	}
		
}
 
//function paidamount()
//    {
//        var rowcount = document.getElementById('rowcount').value;
//        for(i = 1; i < rowcount; i++)
//            {
//                
//                 var creditamount = parseFloat(document.getElementById("creditamount"+i).value);
//                 var paymentamount = parseFloat(document.getElementById("paymentamount").value);
//                
//                 newcreditamount = creditamount - paymentamount;
//                
//            }
//            if(newcreditamount <= 0)
//                {
//                    newcreditamount = 0;
//                }
//        
//        document.getElementById("newcreditamount").value = newcreditamount;
//    }
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
                        <h3 class="animated fadeInLeft">Receipt</h3>
                        <p class="animated fadeInDown">
                          Sales Related <span class="fa-angle-right fa"></span> Receipt
                        </p>
                    </div>
                  </div>
                </div>
                <div class="form-element">
                  <div class="col-md-12 padding-0"> 
                      <div class ="col-md-1"></div>
                    <div class="col-md-10">
                      <div class="panel form-element-padding">
                        <div class="panel-heading">
                         <h4>Receipt Form</h4>
                        </div>
                         <div class="panel-body" style="padding-bottom:30px;">
                             <div class = "col-md-12">
                                <div class="col-md-3"> 
                              <label>Customer Name</label>
                              <br>
                              <br>
                                <select class="form-control" style = "width:100%:" name = "customerid" id = "customerid" onchange="getbalance();">
                                    <option>-Please Select-</option>
                                    <?php
                                    $sqlselectpaybalance = $sales->selectpaybalance();
                                    while($fetchselectpaybalance = mysqli_fetch_array($sqlselectpaybalance))
                                    {
                                        $customerid = $fetchselectpaybalance['customer'];
                                        $sqlselectcustomerbyid = $customer->selectcustomerbyid($customerid);
                                        $fetchselectcustomerbyid = mysqli_fetch_array($sqlselectcustomerbyid);
                                    ?>
                                    <option value = "<?=$fetchselectcustomerbyid['id']?>"><?=$fetchselectcustomerbyid['name']?></option>
                                    <?php
                                    }
                                    ?>
                                    
                                </select>
                                </div>
                              <div class="col-md-3">
                                <label class="control-label text-right "  style="padding-bottom:15px;">Receipt No</label>
                                  <?php
                                    $sqlselectmaxrepno = $sales->selectmaxrepno();
                                    $fetchselectmaxrepno    = mysqli_fetch_array($sqlselectmaxrepno);

                                    if($fetchselectmaxrepno[0] == '')
                                    {
                                        $reciptno = '0001';
                                    }
                                    else
                                    {
                                        $incrementorder = $fetchselectmaxrepno[0] + 1;
                                        $reciptno = str_pad($incrementorder, 4, '0', STR_PAD_LEFT);
                                    }
                                    ?>
                                    <input type="text" class="form-control android" name = "reciptno" id = "reciptno" value = "<?=$reciptno?>" readonly>
                              </div>                       
                                <div class="col-md-3"> 
                                <label style = "margin-bottom:20px;">Receipt Date</label>
                                    
                                    <input type="text" class="form-text mask-placeholder form-control android" name = "reciptdate" id = "reciptdate" placeholder="MM/DD/YYYY"  value = "<?=$date2?>"  readonly>
                                </div>
                              </div>
                          </div> 
                      </div>
                    </div>
                      <div class ="col-md-1"></div>
                  </div>
              </div>
                
                 <div id = "getbalancediv"></div>
            </div>
        </div>
</form>


        
     
  <!-- end: Javascript -->
  </body>
</html>
