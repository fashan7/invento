<?php include 'header.php';?>
<style>
  .error 
  {
    color: #ff0000;
  }
  </style>
      <!-- end: Header -->
<?php include 'sidnav.php';?>
        <div class="container-fluid mimin-wrapper">
            <div id="content">
                <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft">Stock Category Register</h3>
                        <p class="animated fadeInDown">
                          Stock Related <span class="fa-angle-right fa"></span> Stock Category Register
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
                         <h4>Stock Category Register Form</h4>
                        </div>
                         <div class="panel-body" style="padding-bottom:30px;">
                          <div class="col-md-12">       
                            <label>Stock Category <span id = "redstar">*</span></label>
                              <input type="text" name = "stock_cat" id = "stock_cat" class="form-control android" autocomplete="off" required="required">
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
                </form>
              </div>            
            </div>
        </div>


            <div id="content">
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-heading"><h3>Registerd Stock Category</h3></div>
                    <div class="panel-body">
                      <div class="">
                          <?php 
                          $sqlselectstockcat = $stock->selectstockcat();
		                  $countselectstockcat = mysqli_num_rows($sqlselectstockcat);
		                  if($countselectstockcat <= 0)
		                  {
                          ?>
                          <center><h3>No Categories Registerd</h3></center>
                          <?php
                          }
                          else
                          {
                          ?>
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Category Name</th>
                          <th>Date Registerd</th>
                          <th>Edit</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                              $rowcount = 1;
                              while($fetchselectstockcat = mysqli_fetch_array($sqlselectstockcat))
                              {
                            ?>
                        <tr>
                         <form action="stockcatupdate.php?stockid=<?php echo $fetchselectstockcat['id'];?>" method="post">
                          <td><?php echo $rowcount; ?></td>
                          <td><input type="text" class="form-control android" name = "stockcatupdate" value = "<?php echo $fetchselectstockcat['name'];?>"></td>
                          <td><?php echo $fetchselectstockcat['date'];?></td>
                          <td><button name="btn-update" class="btn ripple-infinite btn-round btn-info">Update</button></td>
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
            </div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script  src="asset/js/index.js"></script>
    <script src="asset/js/jquery.validate.min.js"></script>
    <script src="js/form-validation.js"></script>
    <script>
   $(function() {
  $("form[name='stockcatid']").validate({
    rules:
        {
            stock_cat: {
                required: true,
                remote: {
                    url: "checkstockcat.php",
                    type: "post"
                }
            },
        },
        messages:
        {
            stock_cat: {
                required: "Enter a Valid Name",
                remote: "Stock Category Already Registered"
            } 
            
        },
    submitHandler: function(form) {
      form.submit();
    }
  });
});
    </script>
  </body>
</html>