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
                        <h3 class="animated fadeInLeft">Warehouse Register</h3>
                        <p class="animated fadeInDown">
                          Inventroy Related <span class="fa-angle-right fa"></span> Warehouse Register
                        </p>
                    </div>
                  </div>
                </div>
                
                <div class="form-element">
                <form class="form" id="warehouse" name="warehouse" action="warehouseSub.php" method="post" enctype="multipart/form-data">
                  <div class="col-md-12 padding-0">
                      <div class="col-md-2">
                      </div>
                    <div class="col-md-8">
                      <div class="panel form-element-padding">
                        <div class="panel-heading">
                         <h4>Warehouse Register</h4>
                        </div>
                         <div class="panel-body" style="padding-bottom:30px;">
                          <div class="col-md-12">  
                              <div class="col-sm-5">
                            <div class="form-group">
                                <label class="control-label text-right">Warehouse Name <span id = "redstar">*</span></label>
                              <input type="text" class="form-control android" name="Wname" id="Wname" required autocomplete="off" >
                            </div>
                            </div>
                            <div class="col-sm-5">
                            <div class="form-group">
                                <label class="control-label text-right">Warehouse Code <span id = "redstar">*</span></label>
                              <input type="text" class="form-control android" name="Wcode" id="Wcode" required autocomplete="off">
                            </div>
                            </div>
                             <div class="col-md-1"    style="margin-top:30px;">
                                   <button type="submit" name="save" id="save" class="btn ripple-infinite btn-round btn-info">
                                    <div>
                                      <span>Save</span>
                                    </div>
                                  </button>
                              </div>
                          </div>
                             
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
                    <div class="panel-heading"><h3>Registerd Warehouses</h3></div>
                    <div class="panel-body">
                          <?php 
                          $sqlwarehouse= $inventory->warehouse();
		                  $countwarehouse = mysqli_num_rows($sqlwarehouse);
		                  if($countwarehouse <= 0)
		                  {
                          ?>
                          <center><h3>No Categories Registerd</h3></center>
                          <?php
                          }
                          else
                          {
                          ?>
                        
                        <table id="myTable" class=" table order-list">
                                <caption>Warehouses</caption>
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Warehouse Name</th>
                                            <th scope="col">Warehouse Code</th>
                                            <th scope="col">Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php
                                        $rowcount = 1;
                                        while($fetchwarehouse = mysqli_fetch_array($sqlwarehouse))
                                            {
                                        ?>
                                        <tr>
                                           <form name = "warehouseupdate" id = "warehouseupdate" action="warehouseupdate.php?warehouseid=<?php echo $fetchwarehouse['id'];?>" method="post">

                                            <td data-label="#">
                                                <label><?= $rowcount;?></label>
                                            </td>
                                            <td data-label="Warehouse Name">
                                                <label><input type="text" required="required" name = "warehousenameupdate" id = "warehousenameupdate" class="form-control android" value = "<?php echo $fetchwarehouse['name'];?>" required></label>
                                            </td>
                                            <td data-label="Warehouse Code">
                                                <label><input type="text" required="required" name = "warehousecodeupdate" id = "warehousecodeupdate" class="form-control android" value = "<?php echo $fetchwarehouse['code'];?>" required></label>
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
        </div>
     <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script  src="asset/js/index.js"></script>
    <script src="asset/js/jquery.validate.min.js"></script>
    <script src="js/form-validation.js"></script>
    <script>
   $(function() {
  $("form[name='warehouse']").validate({
    rules:
        {
            Wname: {
                required: true
            },
            Wcode: {
                required: true,
                minlength: 4,
                maxlength: 8
            }
        },
        messages:
        {
            Wname: "Enter a Valid Name",
            Wcode:{
                required: "Provide a Code",
                minlength: "Code Needs To Be Minimum of 4 Characters",
                maxlength: "Code Needs To Be Maximum of 8 Characters"
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