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
    
function deselectitem()
{       
    if(document.getElementById('itemname').value != '')
    {
        
        document.getElementById('itemcat').value = '';
    }
}

function deselectit()
{    
   if(document.getElementById('itemcat').value != '')
    {
        document.getElementById('itemname').value = '';
    }
}
    
function getitem() {
	
	//document.getElementById('getmaxno').innerHTML = '';

	var req = getXmlHttpRequestObject();	// fuction to get xmlhttp object
	if (req) {
		req.onreadystatechange = function() {
			if (req.readyState == 4) {		// data is retrieved from server
				if (req.status == 200) {	// which reprents ok status
					document.getElementById('getitemview').innerHTML = req.responseText;
				}
				else {
					alert("Please Wait !!");
				}
			}
		}
		
		var itemname = document.getElementById('itemname').value;
        var itemcat  = document.getElementById('itemcat').value;
		strURL = "getitemview.php?itemcat="+itemcat+"&itemname="+itemname;
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
                        <h3 class="animated fadeInLeft">Stock View</h3>
                        <p class="animated fadeInDown">
                          Stock Related <span class="fa-angle-right fa"></span> Stock View
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
                         <h4>Stock View Form</h4>
                        </div>
                         <div class="panel-body" style="padding-bottom:30px;">
                          <div class="col-md-4">       
                            <label>Stock Category</label>
                              <select class="form-control select2-B" name = "itemcat" id = "itemcat" style="margin-bottom:20px;" onchange="deselectit();getitem();">
                                 <option value = "">All</option>
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
                          </div>
                             <div class="col-md-4">
                                 <center><label>&nbsp;</label></center>
                            <center><label>OR</label></center>
                          </div>
                             <div class="col-md-4">       
                            <label>Stock Name</label>
                              <select class="form-control select2-B" name = "itemname" id = "itemname" style="margin-bottom:20px;" onchange="deselectitem();getitem();">
                                 <option value = "">All</option>
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
                </form>
              </div>  
                  <div id="getitemview">

            </div>  
            </div>

        </div>


          

    </script>
  </body>
</html>