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

function getitem() {
	
	//document.getElementById('getmaxno').innerHTML = '';

	var req = getXmlHttpRequestObject();	// fuction to get xmlhttp object
	if (req) {
		req.onreadystatechange = function() {
			if (req.readyState == 4) {		// data is retrieved from server
				if (req.status == 200) {	// which reprents ok status
					document.getElementById('getstockedit').innerHTML = req.responseText;
				}
				else {
					alert("Please Wait !!");
				}
			}
		}
		
		var getitem = document.getElementById('getitem').value;
		
		strURL = "getstockedit.php?getitem="+getitem;
		req.open("GET", strURL, true);
		req.send(null);
	}
		
}
    

</script>
<script>
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
</script>
        <div class="container-fluid mimin-wrapper">
            <div id="content">
                <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft">Stock Update</h3>
                        <p class="animated fadeInDown">
                          Stock Related <span class="fa-angle-right fa"></span> Stock Update
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
                         <h4>Stock Update Form</h4>
                        </div>
                         <div class="panel-body" style="padding-bottom:30px;">
                          <div class="col-md-4"> 
                              <label>Item Name</label>
                               <select class="form-control" name = "getitem" id = "getitem" onchange = "getitem()" style="margin-bottom:20px;">
                                    <option value = "">-please Select-</option>
                              <?php
                              $sqlselectstockreg = $stock->selectstockreg();
                                while($fetchselectstockreg = mysqli_fetch_array($sqlselectstockreg))
                                {
                                ?>
                                    <option value = "<?php echo $fetchselectstockreg['id'];?>"><?php echo $fetchselectstockreg['name'];?></option>
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
            </div>
        </div>

    <div id = "getstockedit"></div>
      <!-- start: Mobile -->

       <!-- end: Mobile -->

    <!-- start: Javascript -->
   
  <!-- end: Javascript -->
  </body>
</html>