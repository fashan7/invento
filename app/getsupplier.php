   <?php
session_start();
    $logusername =      $_SESSION['username'];
    $loguserid =        $_SESSION['userid'];
    $loguserbranch =    $_SESSION['branch'];

    if(!$loguserid)
    {
	   header("Location:login.php");
    }
?>
<?php 
    include 'ControllerPage.php';
    include 'ControllerQuery.php';
    include 'ControllerStock.php';
    include 'ControllerCustomer.php';


    $obj        = new AccountSettings();
    $object     = new sqlfunctions();
    $stock      = new stockfunctions();
    $customer   = new customerfunctions();

    $supplierid = $_GET['supplierid'];


$sqlselectsupplierbyid = $customer->selectsupplierbyid($supplierid);
$fetchselectsupplierbyid = mysqli_fetch_array($sqlselectsupplierbyid);
?>
<form class="form" action="supplierupdatesubmit.php" method="post" enctype="multipart/form-data">
        <div class="form-element">
                  <div class="col-md-12 padding-0"> 
                      <div class="col-md-1">
                      </div>
                    <div class="col-md-10">
                      <div class="panel form-element-padding">
                        <div class="panel-heading">
                         <h4>Customer Edit / View Form</h4>
                        </div>
                         <div class="panel-body" style="padding-bottom:30px;">
                          <div class="col-md-4"> 
                              <label>Customer Name</label>
                              <input type="text" name = "cname" id = "cname" class="form-control android" value = "<?= $fetchselectsupplierbyid['name']?>" required = "required">
                          </div>
                          <div class="col-md-4"> 
                              <label>Customer Code</label>
                              <input type="text" class="form-control android" value = "<?= $fetchselectsupplierbyid['code']?>" readonly = "readonly">
                          </div>
                            <div class="col-md-4"> 
                              <label>Contact Person</label>
                              <input type="text" name = "contactperson" id = "contactperson"  class="form-control android" value = "<?= $fetchselectsupplierbyid['c_person']?>">
                          </div>
                          </div>
                          <div class="panel-body" style="padding-bottom:30px;">
                            <div class="col-md-4"> 
                              <label>Telephone No</label>
                              <input type="text" name = "telenmum" id = "telenmum" maxlength = "10" class="form-control android" value = "<?= $fetchselectsupplierbyid['phone_no']?>" onkeypress="return isNumberKey(event)">
                            </div>
                             
                          <div class="col-md-4"> 
                              <label>Fax</label>
                              <input type="text" name = "fax" id = "fax" class="form-control android" value = "<?= $fetchselectsupplierbyid['fax']?>">
                          </div>
                          <div class="col-md-4"> 
                              <label>Email</label>
                              <input type="email" class="form-control android" value = "<?= $fetchselectsupplierbyid['email']?>" readonly = "readonly">
                          </div>
                          </div>
                          <div class="panel-body" style="padding-bottom:30px;" >
                          <div class="col-md-12"> 
                              <label>Address</label>
                              <input type="text" required = "required" name = "address" id = "address" class="form-control android" value = "<?= $fetchselectsupplierbyid['address']?>">
                          </div>
                        </div>
                      </div>
                    </div>
                       <input type="hidden" name = "customerid" id = "customerid" class="form-control android" value = "<?= $fetchselectsupplierbyid['id']?>">
                      <div class="col-md-1"></div>
                         <div class="panel-body">
                             <div class="col-md-9"></div>
                          <div class="col-md-3">
                              <button style="margin-top:0px !important;" class="btn-flip btn btn-3d btn-primary">
                                <div class="flip">
                                  <div class="side">
                                    Update <span class="fa fa-check"></span>
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