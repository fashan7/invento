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
                        <h3 class="animated fadeInLeft">User Register</h3>
                        <p class="animated fadeInDown">
                          User Settings <span class="fa-angle-right fa"></span> User Register
                        </p>
                    </div>
                  </div>
                </div>
                <div class="form-element">
                <form class="form" id="userreg" name="userreg" action="userregsub.php" method="post" enctype="multipart/form-data">
                  <div class="col-md-12 padding-0"> 
                    <div class="col-md-12">
                      <div class="panel form-element-padding">
                        <div class="panel-heading">
                         <h4>User Register</h4>
                        </div>
                         <div class="panel-body" style="padding-bottom:30px;">
                          <div class="col-md-6"> 
                              <label>First Name <span id = "redstar">*</span></label>
                              <input type="text" class="form-control android" name="fname" id="fname" autocomplete="off">
                          </div>
                          <div class="col-md-4"> 
                              <label>Last Name <span id = "redstar">*</span></label>
                              <input type="text" class="form-control android" name="sname" id="sname" autocomplete="off">
                          </div>
                          </div>
                          <div class="panel-body" style="padding-bottom:30px;" >
                            <div class="col-md-3"> 
                              <label>Telephone No <span id = "redstar">*</span></label>
                              <input type="text" class="form-control android" name="telno" id="telno" autocomplete="off">
                            </div>
                             
                          <div class="col-md-3 form-animate-text"> 
                              <label>Date Of Birth <span id = "redstar">*</span></label>
                              <input type="text" class="form-control android" name="dob" id="dob" autocomplete="off">
                          </div>
                            <div class="col-md-3"> 
                              <label>NIC No <span id = "redstar">*</span></label>
                              <input type="text" class="form-control android" name="nic" id="nic" autocomplete="off">
                          </div>
                          <div class="col-md-3"> 
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
                            <div class="panel-body" style="padding-bottom:30px;">
                            <div class="col-md-3"> 
                              <label>User Name <span id = "redstar">*</span></label> 
                              <input type="text" class="form-control android" name="username" id="username" autocomplete="off">
                            </div>
                             
                          <div class="col-md-3"> 
                              <label>Password <span id = "redstar">*</span></label>
                              <input type="password" class="form-control android" name="password" id="password" autocomplete="off">
                          </div>
                            <div class="col-md-3"> 
                             <label>User Type <span id = "redstar">*</span></label>
                              <br>
                                <select class="form-control" name="usertype" id="usertype" autocomplete="off">
                                    <option value=""> - Please Select - </option>
                                    <?php
                                     $sqlselectusertype = $usersettings->selectusertype();
                                     while($fetchselectusertype = mysqli_fetch_array($sqlselectusertype))
                                     {
                                    
                                    ?>
                                    <option value = "<?=$fetchselectusertype['id']?>"><?php echo $fetchselectusertype['name'];?></option>
                                    <?php
                                     }
                                    ?>
                                    
                                </select>
                          </div>
                          <div class="col-md-3"> 
                          </div>
                          </div>
                      </div>
                    </div>
                         <div class="panel-body">
                             <div class="col-md-9"></div>
                          <div class="col-md-3">
                              <button type="submit" id="save" name="save" style="margin-top:0px !important;" class="btn-flip btn btn-3d btn-primary">
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
  $("form[name='userreg']").validate({
    
    rules:
        {
            title: {
                required: true
            },
            fname: {
                required: true,
                minlength: 4
            },
             sname: {
                required: true,
                minlength: 4
            },
            telno: {
                required: true,
                number: true,
                maxlength: 10,
                minlength: 10
            },
            dob: {
                required: true
            },
            nic: {
                required: true,
                maxlength: 13,
                minlength: 10
            },
            email: {
                email: true
            },
            address: {
                required: true,
                minlength: 7
            },
            username: {
                required: true,
                remote: {
                    url: "checkusernamein_userreg.php",
                    type: "post"
                }
            },
            password: {
                required: true,
                minlength: 5
            },
            usertype: {
                required: true
            }
        },
        messages:
        {
            title: "This Field is Required",
            fname:{
                required: "This Field is Required",
                minlength: "First Name Needs To Be Minimum of 4 Characters"
            },
             sname:{
                required: "This Field is Required",
                minlength: "Last Name Needs To Be Minimum of 4 Characters"
            },
            telno:{
                required: "Provide Contact No",
                number: "Provide in Numeric Values",
                minlength: "Phone No Needs To Be Minimum of 10 Characters",
                maxlength: "Phone No Needs To Be Maximum of 10 Characters"
            },
            dob: "This Field is Required",
            nic:{
                required: "This Field is Required",
                minlength: "NIC Needs To Be Minimum of 10 Characters",
                maxlength: "NIC Needs To Be Maximum of 13 Characters"
            },
            email: "Provide a valid email address",
            address:{
                required: "Provide Address",
                minlength: "Address Needs To Be Minimum of 7 Characters"
            },
            username: {
                required: "Please enter your Username",
                remote: "Username Already Taken!"
            },
            password: {
                required: "Please provide a Password",
                minlength: "Your password must be at least 5 characters long"
            },
            usertype: "This Field is Required"
        },
    submitHandler: function(form) {
      form.submit();
    }
  });
});
    </script>
  </body>
</html>