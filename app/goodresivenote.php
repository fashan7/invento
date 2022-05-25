<?php include 'header.php';
$date = $object->getDate();
?>
    
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/ui-darkness/jquery-ui.min.css" rel="stylesheet">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>

<script type="text/javascript">    //itemname1 itemcode1 unitprice1 sellprice1 poquantity1 grnquantity1 amount1
$.noConflict();
$(document).ready(function(){
    $("#polist").change(function(){
        var polist = $("#polist").val();
        var grndate = $("#grndate").val();
        $.post("grnform.php", {
			polist:polist,
            grndate:grndate
		},
			
		function(data,status) {
			$("#putgrnform").empty();			
			$("#putgrnform").append(data);
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

      <!-- end: Header -->
<?php include 'sidnav.php';?>
        <div class="container-fluid mimin-wrapper">
            <div id="content">
                <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft">Good Receive Note (GRN)</h3>
                        <p class="animated fadeInDown">
                          Inventory <span class="fa-angle-right fa"></span> Good Receive Note (GRN)
                        </p>
                    </div>
                  </div>
                </div>
                <div class="form-element">
                  <div class="col-md-12 padding-0"> 
                      <div class="col-md-1">
                      </div>
                    <div class="col-md-10">
                      <div class="panel form-element-padding">
                        <div class="panel-heading">
                         <h4>Good Receive Note</h4>
                        </div>
                         <div class="panel-body" style="padding-bottom:30px;">
                            <div class="col-md-4"> 
                              <label>Purchase No</label>
                               <select class="form-control " style="margin-bottom:20px;" name="polist" id="polist"> 
                                    <option value="">- Please Select -</option>
                                    <option value="grn">Without PO</option>
                                   <?php
                                   $result = $inventory->approvedPONo();
                                   while($row = mysqli_fetch_array($result))
                                   {
                                       ?>
                                        <option value="<?=$row['purchase_no']?>"><?=$row['purchase_no']?></option>
                                       <?php
                                   }
                                   ?>
                                </select>
                            </div>                        
                            <div class="col-md-4"> 
                              <label>GRN Date</label>
                              <input type="text" class="form-text mask-placeholder form-control android" placeholder="MM/DD/YYYY"  value="<?=$date?>" name="grndate" id="grndate">
                            </div>                             
                          </div>                     
                      </div>
                    </div>
                      <div class="col-md-1"></div>
                  </div>
              </div>
                
                   <div class="form-element">
                  <div class="col-md-12 padding-0">                       
                    <div class="col-md-12">
                        <div id="putgrnform"></div>
                      
                    </div>
                         
                  </div>
              </div>
            </div>
        </div>
  </body>
</html>.
