<?php include 'header.php';?>
<style>
  .error 
  {
    color: #ff0000;
  }
  </style>
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
    
    
function getsupplier() {
	

	var req = getXmlHttpRequestObject();
	if (req) {
		req.onreadystatechange = function() {
			if (req.readyState == 4) {	
				if (req.status == 200) {	
					document.getElementById('getsupplierview').innerHTML = req.responseText;
				}
				else {
					alert("Please Wait !!");
				}
			}
		}
		
		var supplierid = document.getElementById('supplierid').value;
		strURL = "getsupplierview.php?supplierid="+supplierid;
		req.open("GET", strURL, true);
		req.send(null);
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
                        <h3 class="animated fadeInLeft">Supplier View</h3>
                        <p class="animated fadeInDown">
                          Reports <span class="fa-angle-right fa"></span> Supplier View
                        </p>
                    </div>
                  </div>
                </div>
                
                <div class="form-element">
                <form class="form" id="stockcatid" name="stockcatid" action="stockcatregsubmit.php" method="post" enctype="multipart/form-data">
                  <div class="col-md-12 padding-0">
                      <div class="col-md-2">
                      </div>
                    <div class="col-md-8">
                      <div class="panel form-element-padding">
                        <div class="panel-heading">
                         <h4>Supplier View Form</h4>
                        </div>
                         <div class="panel-body" style="padding-bottom:30px;">
                          <div class="col-md-4">       
                            <label>Supplier Name</label>
                              <select class="form-control select2-B" name = "supplierid" id = "supplierid" style="margin-bottom:20px;" onchange="getsupplier();">
                                 <option value = "">All</option>
                                    <?php
                                   $sqlselectsupplier = $customer->selectsupplier();
                                   while($fetchselectsupplier = mysqli_fetch_array($sqlselectsupplier))
                                   {                                   
                                   ?>
                                    <option value = "<?php echo $fetchselectsupplier['id'];?>"><?php echo $fetchselectsupplier['name'];?></option>
                                   <?php
                                   }
                                   ?>
                                </select>
                          </div>                           
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>  
                  <div id="getsupplierview">

            </div>  
            </div>

        </div>


          

  </body>
</html>