<?php 
    include 'header.php';

    $supCode = "";

    if($object->supplierCode() > 0)
    {
        $count = $object->supplierCode() + 1;
        $supCode = 'SUP00'.$count;
    }
    else
    {
        $count = $object->supplierCode();
        $supCode = 'SUP001';
    }
        
?>

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
                        <h3 class="animated fadeInLeft">Supplier Register</h3>
                        <p class="animated fadeInDown">
                          Customer Related <span class="fa-angle-right fa"></span> Supplier Register
                        </p>
                    </div>
                  </div>
                </div>
                
                <div class="form-element">
                <form class="form" id="supplierreg" name="supplierreg" action="supplyerregsub.php" method="post" enctype="multipart/form-data">
                  <div class="col-md-12 padding-0"> 
                      <div class="col-md-1">
                      </div>
                    <div class="col-md-10">
                      <div class="panel form-element-padding">
                        <div class="panel-heading">
                         <h4>Supplier Register</h4>
                        </div>
                         <div class="panel-body" style="padding-bottom:30px;">
                          <div class="col-md-4"> 
                              <label>Supplier Name <span id = "redstar">*</span></label>
                              <input type="text" class="form-control android" name="Sname" id="Sname" autocomplete="off">
                          </div>
                          <div class="col-md-4"> 
                              <label>Supplier Code</label>
                              <input type="text" class="form-control android" name="SCode" id="SCode" value="<?=$supCode?>" autocomplete="off" readonly>
                          </div>
                            <div class="col-md-4"> 
                              <label>Contact Person</label>
                              <input type="text" class="form-control android" name="Cperson" id="Cperson" autocomplete="off">
                          </div>
                          </div>
                          <div class="panel-body" style="padding-bottom:30px;">
                            <div class="col-md-4"> 
                              <label>Telephone No <span id = "redstar">*</span></label>
                              <input type="text" class="form-control android" name="telno" id="telno" autocomplete="off">
                            </div>
                             
                          <div class="col-md-4"> 
                              <label>Fax</label>
                              <input type="text" class="form-control android" name="fax" id="fax" autocomplete="off">
                          </div>
                          <div class="col-md-4"> 
                              <label>Email</label>
                              <input type="text" class="form-control android" name="email" id="email" autocomplete="off">
                          </div>
                          </div>
                          <div class="panel-body" style="padding-bottom:30px;">
                          <div class="col-md-12"> 
                              <label>Address <span id = "redstar">*</span></label>
                              <input type="text" class="form-control android" name="address" id="address" autocomplete="off">
                          </div>
                        </div>
                      </div>
                    </div>
                      <div class="col-md-1"></div>
                         <div class="panel-body">
                             <div class="col-md-9"></div>
                          <div class="col-md-3">
                              <button type="submit" name="save" id="save" style="margin-top:0px !important;" class="btn-flip btn btn-3d btn-primary">
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
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script  src="asset/js/index.js"></script>
    <script src="asset/js/jquery.validate.min.js"></script>
    <script src="js/form-validation.js"></script>
    <script>
   $(function() {
  $("form[name='supplierreg']").validate({
    rules:
        {
            Sname: {
                required: true
            },
            SCode: {
                required: true,
                minlength: 4,
                maxlength: 8
            },
            Cperson: {
                minlength: 3
            },
            telno: {
                required: true,
                number: true,
                maxlength: 10,
                minlength: 10
            },
            fax: {
                number: true
            },
            email: {
                email: true
            },
            address: {
                required: true,
                minlength: 7
            },
        },
        messages:
        {
            Sname: "Enter a Valid Name",
            SCode:{
                required: "Provide a Code",
                minlength: "Code Needs To Be Minimum of 4 Characters",
                maxlength: "Code Needs To Be Maximum of 8 Characters"
            },
            Cperson: "Enter a Valid Contact Name",
            telno:{
                required: "Provide Contact No",
                number: "Provide in Numeric Values",
                minlength: "Phone No Needs To Be Minimum of 10 Characters",
                maxlength: "Phone No Needs To Be Maximum of 10 Characters"
            },
            email: "Provide a valid email address",
            address:{
                required: "Provide Address",
                minlength: "Address Needs To Be Minimum of 7 Characters"
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