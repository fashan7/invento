<?php include 'header.php';?>
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
      <!-- end: Header -->
<?php include 'sidnav.php';?>

        <div class="container-fluid mimin-wrapper">
            <div id="content">
                <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft">Stock Brand Register</h3>
                        <p class="animated fadeInDown">
                          Stock Related <span class="fa-angle-right fa"></span> Stock Brand Register
                        </p>
                    </div>
                  </div>
                </div>
            <form class="form" id="stockbrandid" name="stockbrandid"  action="stockbrandsubmit.php" method="post" enctype="multipart/form-data">
                <div class="form-element">
                  <div class="col-md-12 padding-0">
                      <div class="col-md-2">
                      </div>
                    <div class="col-md-8">
                      <div class="panel form-element-padding">
                        <div class="panel-heading">
                         <h4>Stock Brand Register Form</h4>
                        </div>
                         <div class="panel-body">
                                <div class="col-md-4" style="padding-bottom:30px;"> 
                              <label>Brand Category <span id = "redstar">*</span></label>
                               <select class="form-control " name = "brandcat" name = "brandcat"  style="margin-bottom:20px;" required="required">
                                    <option value = "">-Please Select-</option>
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
                          <div class="col-md-4"  style="padding-bottom:30px;"> 
                              <label class="control-label text-right">Brand Code <span id = "redstar">*</span></label>
                            <div>
                              <div><input type="text" name = "brandcode" id = "brandcode" class="form-control android" autocomplete="off" required="required"></div>
                            </div>
                          </div>
                          <div class="col-md-4"  style="padding-bottom:30px;">   
                              <label class="control-label text-right">Brand Name <span id = "redstar">*</span></label>
                            <div>
                              <div><input type="text" name = "brandname" class="form-control android" required="required"></div>
                            </div>
                          </div>
                             
                        </div>
                      </div>
                    </div>
                         <div class="panel-body">
                             <div class="col-md-8"></div>
                          <div class="col-md-3">
                              <button style="margin-top:0px !important;" name="btn-save" id="btn-submit" class="btn-flip btn btn-3d btn-primary">
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
              </div>
            </form>
            </div>
        </div>


            <div id="content">
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-heading"><h3>Registerd Stock Brand</h3></div>
                    <div class="panel-body">
                          <?php 
                          $sqlselectstockbrand= $stock->selectstockbrand();
		                  $countselectstockbrand = mysqli_num_rows($sqlselectstockbrand);
		                  if($countselectstockbrand <= 0)
		                  {
                          ?>
                          <center><h3>No Categories Registerd</h3></center>
                          <?php
                          }
                          else
                          {
                          ?>
                        
                        <table id="myTable" class=" table order-list">
                                <caption>Sales Order</caption>
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Brand Name</th>
                                            <th scope="col">Brand Code</th>
                                            <th scope="col">Date Registerd</th>
                                            <th scope="col">Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php
                                        $rowcount = 1;
                                        while($fetchselectstockbrand = mysqli_fetch_array($sqlselectstockbrand))
                                            {
                                        ?>
                                        <tr>
                                           <form action="stockbrandupdate.php?brandid=<?php echo $fetchselectstockbrand['id'];?>" method="post">

                                            <td data-label="#">
                                                <label><?= $rowcount;?></label>
                                            </td>
                                            <td data-label="Category">
                                                <?php 
                                                $categoryid = $fetchselectstockbrand['catergory'];
                                                $sqlselectstockcatbyid = $stock->selectstockcatbyid($categoryid);
                                                $fetchselectstockcatbyid = mysqli_fetch_array($sqlselectstockcatbyid);
                                                ?>
                                                <label><?php echo $fetchselectstockbrand['name'];?></label>
                                            </td>
                                            <td data-label="Brand Name">
                                                <label><input type="text" required="required" name = "brandnameupdate" id = "brandnameupdate" class="form-control android" value = "<?php echo $fetchselectstockbrand['name'];?>"></label>
                                            </td>
                                            <td data-label="Brand Code">
                                                <label><input type="text" required="required" name = "brandcodeupdate" id = "brandcodeupdate" class="form-control android" value = "<?php echo $fetchselectstockbrand['code'];?>"></label>
                                            </td>
                                            <td data-label="Date Registerd">
                                                <label><?php echo $fetchselectstockbrand['date'];?></label>
                                            </td>
                                            <td data-label="Edit">
                                                <label><button name="btn-update" class="btn ripple-infinite btn-round btn-info">Update</button></label>
                                            </td>
                                               </form>
                                        </tr>
                                       <?php
                                  $rowcount++;
                                            }
                                        ?>
                                </tbody>
                            </table>
                          <?php }?>
                        

                        
                        
                        
                  </div>
                </div>
              </div>  
              </div>
            </div>
      <!-- start: Mobile -->

       <!-- end: Mobile -->
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script  src="asset/js/index.js"></script>
    <script src="asset/js/jquery.validate.min.js"></script>
    <script src="js/form-validation.js"></script>
    <script>
   $(function() {
  $("form[name='stockbrandid']").validate({
    rules:
        {
            brandcode: {
                required: true,
                remote: {
                    url: "checkstockbrand.php",
                    type: "post"
                }
            },
        },
        messages:
        {
            brandcode: {
                required: "Enter a Valid Code",
                remote: "Stock Brand Code Already Registered"
            } 
            
        },
    submitHandler: function(form) {
      form.submit();
    }
  });
});
    </script>
    <!-- start: Javascript -->
   
  <!-- end: Javascript -->
  </body>
</html>