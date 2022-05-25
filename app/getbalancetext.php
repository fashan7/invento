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
    include 'ControllerUsers.php';
    include 'ControllerSales.php';

    $obj            = new AccountSettings();
    $object         = new sqlfunctions();
    $stock          = new stockfunctions();
    $customer       = new customerfunctions();
    $usersettings   = new userfunctions();
    $sales          = new salesFunction();

    $billno = $_GET['billno'];
    
    
?>
<div class = "col-md-12">
        <div class = "col-md-9">
        </div>
        <div class = "col-md-3">
            <label class="control-label text-right "  style="padding-bottom:15px;">Payment Value For Invoice No. <?=$billno;?></label>
            <input type="text" class="form-control android" name = "paymentamount" id = "paymentamount" autocomplete="off" required>
<!--            <input type="text" class="form-control android" name = "newcreditamount" id = "newcreditamount" value="0">-->
            <input type="hidden" class="form-control android" name = "billno" id = "billno" value="<?=$billno;?>">
        </div>                    
 </div>
    <div class = "row">
      <div class="col-md-3"> 
      <label>Payment type</label>
      <br>
      <br>
        <select class="form-control" style = "width:100%:" name = "paytype" id = "paytype" onchange = "getcreditinfo();" style = "margin-bottom:10px;">
            <option value = "cash">Cash</option>
            <option value = "card">Card</option>
        </select>
        </div>
        <div class = "col-md-9"></div>
        </div>
        <div id = "getcreditinfodiv">
        </div>        
<div class="panel-body">
          <div class="col-md-12" style="align: left">
              <button style="margin-top:0px !important;" name = "save" class="btn-flip btn btn-3d btn-primary">
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
