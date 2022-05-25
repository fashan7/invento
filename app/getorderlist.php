<?php 
    session_start();	
    $logusername =      $_SESSION['username'];
    $loguserid =        $_SESSION['userid'];
    $loguserbranch =    $_SESSION['branch'];

    include 'ControllerPage.php';
    include 'ControllerQuery.php';
    include 'ControllerStock.php';
    include 'ControllerCustomer.php';
    include 'ControllerUsers.php';
    include 'ControllerInventory.php';

    $obj            = new AccountSettings();
    $object         = new sqlfunctions();
    $stock          = new stockfunctions();
    $customer       = new customerfunctions();
    $usersettings   = new userfunctions();
    $inventory      = new inventoryfunction();


    if($_POST['section'] == '')
    {
        ?>
        <select class="form-control " style="margin-bottom:20px;" name="orderno" id="orderno">
            <option value="">- Please Select -</option>
        </select>
        <?php 
        exit;
    }
    else if($_POST['section'] == 'po')
    {
        $result = $inventory->getPurchaseOrdersgrn();
        ?>
        <select class="form-control " style="margin-bottom:20px;" name="orderno" id="orderno">
            <option value="">- Please Select -</option>
        <?php
        while($row = mysqli_fetch_array($result))
        {
            ?>
            <option value="<?=$row['purchase_no']?>"><?=$row['purchase_no']?></option>
            <?php
        }
        ?>            
        </select>
        <?php 
    }
    else if($_POST['section'] == 'grn')
    {
        $result = $inventory->getGrnOrder();
        ?>
        <select class="form-control " style="margin-bottom:20px;" name="orderno" id="orderno">
            <option value="">- Please Select -</option>
        <?php
        while($row = mysqli_fetch_array($result))
        {
            ?>
            <option value="<?=$row['grn_no']?>"><?=$row['grn_no']?></option>
            <?php
        }
        ?>            
        </select>
        <?php 
    }
?>