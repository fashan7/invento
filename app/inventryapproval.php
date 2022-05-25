<?php include 'header.php';?>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript">
    
$(document).ready(function(){
    $("#section").change(function(){
        var section = $("#section").val();        
        $.post("getorderlist.php", {
			section:section,
		},			
		function(data,status) {
			$("#orderselect").empty();			
			$("#orderselect").append(data);
		});
    });
});
$(document).ready(function(){
    $("#section").change(function(){
        var section = $("#section").val();        
        $.post("getorderlistlbl.php", {
			section:section,
		},			
		function(data,status) {
			$("#orderselectlbl").empty();			
			$("#orderselectlbl").append(data);
		});
    });
});
    
$(document).ready(function(){
    $("#search").click(function(){
        var section = $("#section").val();
        var orderno = $("#orderno").val();
        $.post("giveapproval.php", {
			section:section,
            orderno:orderno
		},
			
		function(data,status) {
			$("#loadapprovals").empty();			
			$("#loadapprovals").append(data);
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
                        <h3 class="animated fadeInLeft">Inventory Approval</h3>
                        <p class="animated fadeInDown">
                          Inventory <span class="fa-angle-right fa"></span> Inventory Approval
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
                         <h4>Inventory Approval Form</h4>
                        </div>
                         <div class="panel-body" style="padding-bottom:30px;">
                            <div class="col-md-4"> 
                              <label>Select Section</label>
                               <select class="form-control" style="margin-bottom:20px;" name="section" id="section">
                                    <option value="">- Please Select -</option>
                                    <option value="po">PO</option>
                                    <option value="grn">GRN</option>
                                </select>
                            </div>                        
                            <div class="col-md-4"> 
                              <div id="orderselectlbl">
                                  <label>Select Order No</label>
                              </div>
                               <div id="orderselect">
                                   <select class="form-control " style="margin-bottom:20px;" name="orderno" id="orderno">
                                        <option value="">- Please Select -</option>
                                    </select>
                               </div>
                            </div>
                             <div class="col-md-1" style="margin-top:22px;">
                                   <button class="btn ripple-infinite btn-round btn-info" type="button" name="search" id="search">
                                    <div>
                                      <span>Search</span>
                                    </div>
                                  </button>
                              </div>
                          </div>                     
                      </div>
                    </div>
                      <div class="col-md-1"></div>
                  </div>
                  <div class="col-md-12 padding-0">
                      <div id="loadapprovals"></div>
                   </div>
              </div>
            </div>
        </div>
  </body>
</html>.
