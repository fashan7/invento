<?php include 'header.php';?>
      <!-- end: Header -->
<?php include 'sidnav.php';?>
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

function getcustomer() {
	
	//document.getElementById('getmaxno').innerHTML = '';

	var req = getXmlHttpRequestObject();	// fuction to get xmlhttp object
	if (req) {
		req.onreadystatechange = function() {
			if (req.readyState == 4) {		// data is retrieved from server
				if (req.status == 200) {	// which reprents ok status
					document.getElementById('getcustomer').innerHTML = req.responseText;
				}
				else {
					alert("Please Wait !!");
				}
			}
		}
		
		var customerid = document.getElementById('customerid').value;
		
		strURL = "getcustomer.php?customerid="+customerid;
		req.open("GET", strURL, true);
		req.send(null);
	}
		
}
    

function isNumberKey(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode
	//if (charCode > 31 && (charCode < 48 || charCode > 57))
	if (charCode > 31 && (charCode < 46 || charCode > 57))
		return false;

	return true;
}
</script>
        <div class="container-fluid mimin-wrapper">
            <div id="content">
                <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft">Customer Edit / View</h3>
                        <p class="animated fadeInDown">
                          Customer Related <span class="fa-angle-right fa"></span> Customer Edit / View
                        </p>
                    </div>
                  </div>
                </div>
                
                
            <div class="form-element">
                  <div class="col-md-12 padding-0">
                      <div class="col-md-2">
                      </div>
                    <div class="col-md-8">
                      <div class="panel form-element-padding">
                        <div class="panel-heading">
                            <h4>Customer Select Form</h4>
                        </div>
                         <div class="panel-body" style="padding-bottom:30px;">
                          <div class="col-md-4"> 
                              <label>Customer Name</label>
                               <select class="form-control " style="margin-bottom:20px;" name = "customerid" id = "customerid" onchange="getcustomer()">
                                    <option value = "">-Please Select-</option>
                                   <?php
                                   $sqlselectcustomer = $customer->selectcustomer();
                                   while($fetchselectcustomer = mysqli_fetch_array($sqlselectcustomer))
                                   {
                                   ?>
                                    <option value = "<?= $fetchselectcustomer['id'];?>"><?= $fetchselectcustomer['name'];?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                          </div>                            
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
                
                
                
            <div id = "getcustomer"></div>
            </div>
        </div>


  <!-- end: Javascript -->
  </body>
</html>