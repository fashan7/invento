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

    $itemcat = $_GET['itemcat'];
    $itemname = $_GET['itemname'];


?>  
                <div class="form-element">
                  <div class="col-md-12 padding-0"> 
                      
                    <div class="col-md-12">
                      <div class="panel form-element-padding">  
                          <div class="panel-body" style="padding-bottom:30px;">
                            <table id="myTable" class=" table order-list">
                                <caption>Sales Order</caption>
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Item Name</th>
                                            <th scope="col">Item Code</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Brand</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Cost Price (Rs)</th>
                                            <th scope="col">Selling Price (Rs)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if($itemcat != "")
                                        {
                                            $sqlselectstockregbyitemandcat = $stock->selectstockregbycat($itemcat);
                                        }
                                        else if ($itemname != "")
                                        {
                                            $sqlselectstockregbyitemandcat = $stock->selectstockregbyid($itemname);
                                        }
                                        else
                                        {
                                            $sqlselectstockregbyitemandcat = $stock->selectstockreg();
                                        }
                                        $countsqlselectstockregbyitemandcat = mysqli_num_rows($sqlselectstockregbyitemandcat);
                                        if($countsqlselectstockregbyitemandcat <= 0)
                                        {
                                            ?>
                                            <center><h2><strong>Sorry Could Not find any products</strong></h2></center>
                                            <?php
                                        }
                                        else
                                        {
                                            $i = 1;
                                        while($fetchselectstockregbyitemandcat = mysqli_fetch_array($sqlselectstockregbyitemandcat))
                                        {
                                        ?>
                                        <tr>
                                            <td data-label="#">
                                                <label><?=$i?></label>
                                            </td>
                                            <td data-label="Item Name">
                                                <label><?=$fetchselectstockregbyitemandcat['name']?></label>
                                            </td>
                                            <td data-label="Item Code">
                                                <label><?=$fetchselectstockregbyitemandcat['code']?></label>
                                            </td>
                                            <td data-label="Category">
                                                <?php 
                                                $categoryid = $fetchselectstockregbyitemandcat['category'];
                                                $sqlselectstockcatbyid = $stock->selectstockcatbyid($categoryid);
                                                $fetchselectstockcatbyid = mysqli_fetch_array($sqlselectstockcatbyid);
                                                ?>
                                                <label><?=$fetchselectstockcatbyid['name']?></label>
                                            </td>
                                            <td data-label="Brand">
                                                <?php
                                                $categoryid = $fetchselectstockregbyitemandcat['brand'];
                                                $sqlselectstockbrandbyid = $stock->selectstockbrandbyid($categoryid);
                                                $fetchselectstockbrandbyid = mysqli_fetch_array($sqlselectstockbrandbyid);
                                                ?>
                                                <label><?=$fetchselectstockbrandbyid['name']?></label>
                                            </td>
                                            <td data-label="Quantity">
                                                <label><?=$fetchselectstockregbyitemandcat['quantity']?></label>
                                            </td>
                                            <td data-label="Cost Price (Rs)">
                                                <label><?=$fetchselectstockregbyitemandcat['costprice']?></label>
                                            </td>
                                            <td data-label="Selling Price (Rs)">
                                                <label><?=$fetchselectstockregbyitemandcat['sellingprice']?></label>
                                            </td>
                                        </tr>
                                        <?php
                                            $i++;
                                        }
                                        }
                                        ?>
                                </tbody>
                            </table>   
                          </div>
                      </div>
                    </div>
                  </div>
              </div>