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
include 'ControllerQuery.php';
include 'ControllerStock.php';
$obj = new sqlfunctions();    
$stock = new stockfunctions();
$getitem = $_GET['getitem'];


$sqlselectstockregbyid = $stock->selectstockregbyid($getitem);
$fetchselectstockregbyid = mysqli_fetch_array($sqlselectstockregbyid);
?>

    <form class="form" id="stockupdateid" name="stockupdateid"  action="updatestock.php" method="post" enctype="multipart/form-data">
            <div id="content">
                <div class="form-element">
                  <div class="col-md-12 padding-0"> 
                    <div class="col-md-12">
                      <div class="panel form-element-padding">
                        <div class="panel-heading">
                         <h4>Stock Update Form</h4>
                        </div>
                         <div class="panel-body" style="padding-bottom:30px;">
                          <div class="col-md-4"> 
                              <label>Item Name</label>
                              <input type="text" name = "itemname" required="required" id = "itemname" class="form-control android" value = "<?php echo $fetchselectstockregbyid['name']?>">
                          </div>
                          <div class="col-md-4"> 
                              <label>Item Code</label>
                              <input type="text" name = "itemcode" required="required" id = "itemcode" class="form-control android" value = "<?php echo $fetchselectstockregbyid['code']?>">
                          </div>
                          <div class="col-md-4"> 
                              <label>Item Category</label>
                               <select class="form-control " required="required" name = "itemcat" name = "iemcat" style="margin-bottom:20px;">
                                    <?php
                                   $catergory = $fetchselectstockregbyid['category']; 
                                   
                                   $sqlselectstockcatbyid = $stock->selectstockcatbyid($catergory);
                                   $fetchselectstockcatbyid= mysqli_fetch_array($sqlselectstockcatbyid);                                   
                                    ?>                                  
                                    <option value = "<?php echo $fetchselectstockcatbyid['id'];?>"><?php echo $fetchselectstockcatbyid['name'];?></option>
                                    <?php
                                   $sqlselectstockcatedit = $stock->selectstockcatedit($catergory);
                                   while($fetchselectstockcatedit = mysqli_fetch_array($sqlselectstockcatedit))
                                   {                                   
                                   ?>
                                    <option value = "<?php echo $fetchselectstockcatedit['id'];?>"><?php echo $fetchselectstockcatedit['name'];?></option>
                                   <?php
                                   }
                                   ?>
                                </select>
                          </div>
                        <div class="col-md-3"> 
                              <label>Item Brand</label>
                               <select class="form-control"  required="required" name = "itembrand" id = "itembrand" style="margin-bottom:20px;" >
                                    <?php
                                   $brand = $fetchselectstockregbyid['brand']; 
                                   
                                   $sqlselectstockbrandbyid = $stock->selectstockbrandbyid($brand);
                                   $fetchselectstockbrandbyid = mysqli_fetch_array($sqlselectstockbrandbyid);                                   
                                    ?>                                  
                                    <option value = "<?php echo $fetchselectstockbrandbyid['id']?>"><?php echo $fetchselectstockbrandbyid['name']?></option>
                                    <?php
                                   $sqlselectstockbrandedit = $stock->selectstockbrandedit($brand);
                                   while($fetchselectstockbrandedit = mysqli_fetch_array($sqlselectstockbrandedit))
                                   {                                   
                                   ?>
                                    <option value = "<?php echo $fetchselectstockbrandedit['id'];?>"><?php echo $fetchselectstockbrandedit['name'];?></option>
                                   <?php
                                   }
                                   ?>
                                </select>
                          </div>
                             
                          <div class="col-md-3"> 
                              <label>Quantity</label>
                              <input type="number" name = "qty" required="required" id = "qty" class="form-control android" value = "<?php echo $fetchselectstockregbyid['quantity']?>">
                          </div>
                          <div class="col-md-3"> 
                              <label>Cost Price (Rs)</label>
                              <input type="text" class="form-control android" required="required" name = "costprice" id = "costprice" onkeypress="return isNumberKey(event)" value = "<?php echo $fetchselectstockregbyid['costprice']?>">
                          </div>
                          <div class="col-md-3"> 
                              <label>Selling Price (Rs)</label>
                              <input type="text" class="form-control android" required="required" name = "sellingprice" id = "sellingprice" onkeypress="return isNumberKey1(event)" value = "<?php echo $fetchselectstockregbyid['sellingprice']?>">
                          </div>
                        </div>
                      </div>
                    </div>
                      <input type="hidden" name = "itemid" id = "itemid" class="form-control android" value = "<?php echo $fetchselectstockregbyid['id']?>">
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
            </div>
    </form>

 <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script  src="asset/js/index.js"></script>
    <script src="asset/js/jquery.validate.min.js"></script>
    <script src="js/form-validation.js"></script>
    <script>
   $(function() {
  $("form[name='stockupdateid']").validate({
    rules:
        {
            itemcode: {
                required: true,
                remote: {
                    url: "checkstockreg.php",
                    type: "post"
                }
            },
        },
        messages:
        {
            itemcode: {
                required: "Enter a Valid Code",
                remote: "Stock Code Already Registered"
            } 
            
        },
    submitHandler: function(form) {
      form.submit();
    }
  });
});
    </script>