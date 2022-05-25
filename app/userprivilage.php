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
		
		var usernames = document.getElementById('userid').value;

        strURL = "getuser.php?usernames="+usernames;
		req.open("GET", strURL, true);
		req.send(null);
	}
		
}
    
function fillSpan(id) {
	if (document.getElementById('changeCon'+id).checked) {
		document.getElementById('viewCon'+id).innerHTML = '(Yes)';
	}
	else {
		document.getElementById('viewCon'+id).innerHTML = '(No)';
	}	
}

function fillNewSpan(id) {
	if (document.getElementById('changeNewCon'+id).checked) {
		document.getElementById('viewNewCon'+id).innerHTML = '(Yes)';
	}
	else {
		document.getElementById('viewNewCon'+id).innerHTML = '(No)';
	}	
}

function getUserPrivileges(id) {
	if (document.getElementById('userid').value != '') {
		if (document.getElementById('changeCon'+id).checked) {
			sign = "yes";
		}
		else {
			sign = "no";
		}
		
		var req = getXmlHttpRequestObject();	// fuction to get xmlhttp object
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {		// data is retrieved from server
					if (req.status == 200) {	// which reprents ok status
						document.getElementById('getuserview').innerHTML = req.responseText;
					}
					else {
						alert("Please Wait !!");
					}
				}
			}
			var user = document.getElementById('userid').value;
			strURL = "getuser.php?user="+user+"&id="+id+"&sign="+sign;
			req.open("GET", strURL, true);
			req.send(null);
		}
	}
}

// For New Page Add Into Syatem
function getNewUserPrivileges(id) {
	if (document.getElementById('userid').value != '') {
		if (document.getElementById('changeNewCon'+id).checked) {
			sign = "yes";
		}
		else {
			sign = "no";
		}
		
		var req = getXmlHttpRequestObject();	// fuction to get xmlhttp object
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {		// data is retrieved from server
					if (req.status == 200) {	// which reprents ok status
						document.getElementById('getuserview').innerHTML = req.responseText;
					}
					else {
						alert("Please Wait !!");
					}
				}
			}
			var user = document.getElementById('userid').value;
			strURL = "getuser.php?user="+user+"&id="+id+"&sign="+sign+"&new=new";
			req.open("GET", strURL, true);
			req.send(null);
		}
	}
}
</script>
      <!-- end: Header -->
<?php include 'sidnav.php';?>
        <div class="container-fluid mimin-wrapper">
            <div id="content">
                <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft">User Privilage</h3>
                        <p class="animated fadeInDown">
                          User Settings <span class="fa-angle-right fa"></span> User Privilage
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
                         <h4>User Privilage</h4>
                        </div>
                         <div class="panel-body" style="padding-bottom:30px;">
                        <div class="col-md-4"> 
                            <label>Select User</label>
                              <br>
                                <select class="form-control" name="userid" id="userid" onchange = "getuser();">
                                    <option value=""> - Please Select - </option>
                                    <?php 
                                    $sqlselectuser = $usersettings->selectuser();
                                    while($fetchselectuser = mysqli_fetch_array($sqlselectuser))
                                    {
                                    ?>                                   
                                    <option value="<?=$fetchselectuser['id']?>"><?=$fetchselectuser['first_name'].' '.$fetchselectuser['last_name']?></option>
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
                <div id = "getuserview"></div>

                
                
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