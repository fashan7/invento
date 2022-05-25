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


?>  
                <div class="form-element">
                  <div class="col-md-12 padding-0"> 
                      
                    <div class="col-md-12">
                      <div class="panel form-element-padding">  
                          <div class="panel-body" style="padding-bottom:30px;">
                            <table id="myTable" class=" table order-list">
                                <caption>Supplier View</caption>
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Supplier Name</th>
                                            <th scope="col">Supplier Code</th>
                                            <th scope="col">Contact Person</th>
                                            <th scope="col">Phone Number</th>
                                            <th scope="col">Fax</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if($supplierid != "")
                                        {
                                            $sqlselectsupplierbyid = $customer->selectsupplierbyid($supplierid);
                                        }
                                        else
                                        {
                                            $sqlselectsupplierbyid = $customer->selectsupplier();
                                        }
                                        $countselectsupplierbyid = mysqli_num_rows($sqlselectsupplierbyid);
                                        if($countselectsupplierbyid <= 0)
                                        {
                                            ?>
                                            <center><h2><strong>Sorry Could Not find any Customers</strong></h2></center>
                                            <?php
                                        }
                                        else
                                        {
                                            $i = 1;
                                        while($fetchselectsupplierbyid = mysqli_fetch_array($sqlselectsupplierbyid))
                                        {
                                        ?>
                                        <tr>
                                            <td data-label="#">
                                                <label><?=$i?></label>
                                            </td>
                                            <td data-label="Supplier Name">
                                                <label><?=$fetchselectsupplierbyid['name']?></label>
                                            </td>
                                            <td data-label="Supplier Code">
                                                <label><?=$fetchselectsupplierbyid['code']?></label>
                                            </td>
                                            <td data-label="Contact Person">
                                                <label><?=$fetchselectsupplierbyid['c_person']?></label>
                                            </td>
                                            <td data-label="Phone Number">
                                                <label><?=$fetchselectsupplierbyid['phone_no']?></label>
                                            </td>
                                            <td data-label="Fax">
                                                <label><?=$fetchselectsupplierbyid['fax']?></label>
                                            </td>
                                            <td data-label="Email">
                                                <label><?=$fetchselectsupplierbyid['email']?></label>
                                            </td>
                                            <td data-label="Address">
                                                <label><?=$fetchselectsupplierbyid['address']?></label>
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