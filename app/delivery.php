<?php include 'header.php';?>
      <!-- end: Header -->
<?php include 'sidnav.php';?>
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
                        <h3 class="animated fadeInLeft">Delivery</h3>
                        <p class="animated fadeInDown">
                          Sales Related <span class="fa-angle-right fa"></span> Delivery
                        </p>
                    </div>
                  </div>
                </div>

              <div class="form-element">
                  <div class="col-md-12 padding-0"> 
                      
                    <div class="col-md-12">
                      <div class="panel form-element-padding">  
                          <div class="panel-body" style="padding-bottom:30px;">
                            <table id="myTable" class=" table order-list">
                                <caption>Delivery Details</caption>
                                    <thead>
                                        <tr>
                                            <th scope="col" style = "width:10px;">#</th>
                                            <th scope="col">Invoice No</th>
                                            <th scope="col">Invoice Date</th>
                                            <th scope="col">Customer</th>
                                            <th scope="col">Warehouse</th>
                                            <th scope="col">Total Amount (Rs)</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Select</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td data-label="#">
                                                <label>1</label>
                                            </td>
                                            <td data-label="Invoice No">
                                                <label>1001</label>
                                            </td>
                                            <td data-label="Invoice Date">
                                                <label>2017-10-21</label>
                                            </td>
                                            <td data-label="Customer">
                                               <label>Fashan</label>
                                            </td>
                                            <td data-label="Warehouse">
                                                <label>OFFICE</label>
                                            </td>
                                            <td data-label="Total Amount (Rs)">
                                                <label>3,000.00	</label>
                                            </td>
                                            <td data-label="Date">
                                               <input type="text" class="form-text mask-placeholder form-control android" placeholder="MM/DD/YYYY"  required>
                                            </td>
                                            <td data-label="Select">
                                                <div class="form-animate-checkbox" style="padding-bottom: 5px;margin-left:50px;">
											<input type="checkbox" class="checkbox" name="confirmdiscount" id="confirmdiscount">
										      </div>
                                            </td>
                                        </tr> 
                                </tbody>
                            </table> 
                          </div>
                      </div>
                    </div>
                         <div class="panel-body">
                          <div class="col-md-12" style="align: left">
                              <button style="margin-top:0px !important;" class="btn-flip btn btn-3d btn-info">
                                <div class="flip">
                                  <div class="side">
                                    Approve <span class="fa fa-check"></span>
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
              </div>
            </div>
        </div>


  <!-- end: Javascript -->
  </body>
</html>.
