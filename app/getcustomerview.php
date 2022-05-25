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

    $cusid = $_GET['cusid'];


?>  
                <div class="form-element">
                  <div class="col-md-12 padding-0"> 
                      
                    <div class="col-md-12">
                      <div class="panel form-element-padding">  
                          <div class="panel-body" style="padding-bottom:30px;">
                            <table id="myTable" class=" table order-list">
                                <caption>Customer View</caption>
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Customer Name</th>
                                            <th scope="col">Customer Code</th>
                                            <th scope="col">Contact Person</th>
                                            <th scope="col">Phone Number</th>
                                            <th scope="col">Fax</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if($cusid != "")
                                        {
                                            $sqlselectcustomerbyid = $customer->selectcustomerbyid($cusid);
                                        }
                                        else
                                        {
                                            $sqlselectcustomerbyid = $customer->selectcustomer();
                                        }
                                        $countselectcustomerbyid = mysqli_num_rows($sqlselectcustomerbyid);
                                        if($countselectcustomerbyid <= 0)
                                        {
                                            ?>
                                            <center><h2><strong>Sorry Could Not find any Customers</strong></h2></center>
                                            <?php
                                        }
                                        else
                                        {
                                            $i = 1;
                                        while($fetchselectcustomerbyid = mysqli_fetch_array($sqlselectcustomerbyid))
                                        {
                                        ?>
                                        <tr>
                                            <td data-label="#">
                                                <label><?=$i?></label>
                                            </td>
                                            <td data-label="Customer Name">
                                                <label><?=$fetchselectcustomerbyid['name']?></label>
                                            </td>
                                            <td data-label="Customer Code">
                                                <label><?=$fetchselectcustomerbyid['code']?></label>
                                            </td>
                                            <td data-label="Contact Person">
                                                <label><?=$fetchselectcustomerbyid['c_person']?></label>
                                            </td>
                                            <td data-label="Phone Number">
                                                <label><?=$fetchselectcustomerbyid['phone_no']?></label>
                                            </td>
                                            <td data-label="Fax">
                                                <label><?=$fetchselectcustomerbyid['fax']?></label>
                                            </td>
                                            <td data-label="Email">
                                                <label><?=$fetchselectcustomerbyid['email']?></label>
                                            </td>
                                            <td data-label="Address">
                                                <label><?=$fetchselectcustomerbyid['address']?></label>
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