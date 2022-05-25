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
    

    
function getuser() {
	

	var req = getXmlHttpRequestObject();	
	if (req) {
		req.onreadystatechange = function() {
			if (req.readyState == 4) {		
				if (req.status == 200) {	
					document.getElementById('getuserview').innerHTML = req.responseText;
				}
				else {
					alert("Please Wait !!");
				}
			}
		}
		
		var userid = document.getElementById('userid').value;

        strURL = "getuser.php?userid="+userid;
		req.open("GET", strURL, true);
		req.send(null);
	}
		
}
</script>
      <!-- end: Header -->
<?php include 'sidnav.php';?>
<?php
$sqlselectuserbyid = $usersettings->selectuserbyid($loguserid);
$fetchselectuserbyid = mysqli_fetch_array($sqlselectuserbyid);
?>
        <div class="container-fluid mimin-wrapper">
            <div id="content">
                <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft">User Password Update</h3>
                        <p class="animated fadeInDown">
                          User Settings <span class="fa-angle-right fa"></span> User Password Update
                        </p>
                    </div>
                  </div>
                </div>
           <form class="form" id="passchange" name="passchange" action="passwordchangesubmit.php" method="post" enctype="multipart/form-data">

                <div class="form-element">
                  <div class="col-md-12 padding-0"> 
                    <div class="col-md-12">
                      <div class="panel form-element-padding">
                        <div class="panel-heading">
                         <h4>User Password Update</h4>
                        </div>
                         <div class="panel-body" style="padding-bottom:30px;">
                        <div class="col-md-2" style="padding-bottom:30px;"> 
                            <label>Title</label>
                              <br>
                                <select class="form-control" name="title" id="title">
                                    <option value=""> - Please Select - </option>
                                    <option value="mr">Mr</option>
                                    <option value="mrs">Mrs</option>
                                    <option value="miss">Miss</option>
                                </select>
                          </div>
                          <div class="col-md-6" style="padding-bottom:30px;"> 
                              <label>First Name</label>
                              <input type="text" class="form-control android" value = "<?= $fetchselectuserbyid['first_name']?>" autocomplete="off" readonly= "readonly">
                          </div>
                          <div class="col-md-4" style="padding-bottom:30px;"> 
                              <label>Last Name</label>
                              <input type="text" class="form-control android" value = "<?= $fetchselectuserbyid['last_name']?>" autocomplete="off" readonly= "readonly">
                          </div>
                          </div>
                          <div class="panel-body">
                            <div class="col-md-3" style="padding-bottom:30px;"> 
                              <label>Telephone No</label>
                              <input type="text" class="form-control android" value = "<?= $fetchselectuserbyid['tel_no']?>" autocomplete="off" readonly= "readonly">
                            </div>
                             
                          <div class="col-md-3 form-animate-text" style="padding-bottom:30px;"> 
                              <label>Date Of Birth</label>
                              <input type="text" class="form-control android" value = "<?= $fetchselectuserbyid['birthday']?>" autocomplete="off" readonly= "readonly">
                          </div>
                            <div class="col-md-3" style="padding-bottom:30px;"> 
                              <label>NIC No</label>
                              <input type="text" class="form-control android" value = "<?= $fetchselectuserbyid['nic']?>" autocomplete="off" readonly= "readonly">
                          </div>
                          <div class="col-md-3" style="padding-bottom:30px;"> 
                              <label>Email</label>
                              <input type="text" class="form-control android" value = "<?= $fetchselectuserbyid['email']?>" autocomplete="off" readonly= "readonly">
                          </div>
                          </div>
                          <div class="panel-body">
                          <div class="col-md-9" style="padding-bottom:30px;"> 
                              <label>Address</label>
                              <input type="text" class="form-control android" name="address" id="address" value = "<?= $fetchselectuserbyid['address']?>" autocomplete="off" readonly= "readonly">
                          </div>
                              <div class="col-md-3" style="padding-bottom:30px;"> 
                             <label>User Type</label>
                              <br>
                                <select class="form-control" name="usertype" id="usertype" autocomplete="off">
                                    <?php
                                    $usertypeid = $fetchselectuserbyid['usertype'];
                                    $sqlselectusertype = $usersettings->selectusertype();
                                    while($fetchselectusertype = mysqli_fetch_array($sqlselectusertype))
                                    {
                                    ?>
                                    <option value="<?= $fetchselectusertype['id']?>" <?php if($fetchselectusertype['id'] == $usertypeid){?>selected<?php } ?>><?= $fetchselectusertype['name']?></option>
                                    <?php
                                    }
                                        ?>
                                </select>
                          </div>
                        </div>
                            <div class="panel-body">
                            <div class="col-md-3" style="padding-bottom:30px;"> 
                              <label>User Name</label> 
                              <input type="text" class="form-control android" name="username" id="username" value = "<?= $fetchselectuserbyid['username']?>" autocomplete="off" readonly= "readonly">
                            </div>
                                <div class="col-md-3" style="padding-bottom:30px;"> 
                              <label>Old Password <span id = "redstar">*</span></label> 
                              <input type="password" class="form-control android" name="password" required id="password" >
                            </div>
                                <div class="col-md-3" style="padding-bottom:30px;"> 
                              <label>New Password <span id = "redstar">*</span></label> 
                              <input type="password" class="form-control android" name="newpassword" required id="newpassword" autocomplete="off" >
                            </div>
                                <div class="col-md-3" style="padding-bottom:30px;"> 
                              <label>Confirm New Password <span id = "redstar">*</span></label> 
                              <input type="password" class="form-control android" name="confirmnewpassword" required id="confirmnewpassword" autocomplete="off" >
                            </div>
                          </div>
                             
                      </div>
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
              </div> 
             </form>

            </div>
        </div>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script  src="asset/js/index.js"></script>
    <script src="asset/js/jquery.validate.min.js"></script>
    <script src="js/form-validation.js"></script>
    <script>
   $(function() {
  $("form[name='passchange']").validate({
    rules: {        
      password: 
      {
        required: true,
          remote: 
          {
            url: "checkpassword.php",
            type: "post"
          }
      },
      newpassword:
      {
          minlength : 8,
      },
      confirmnewpassword : 
      {
          minlength : 8,
          equalTo : "#newpassword"
      }
    },
    messages: {
      password: {
            required: "Please provide a Password",
            remote: "This is not your password!"
        },
        confirmnewpassword: {
            equalTo: "Password is Not Matched"
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