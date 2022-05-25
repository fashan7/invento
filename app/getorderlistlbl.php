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
        <label>Select Section</label>
        <?php
    }
    else if($_POST['section'] == 'po')
    {
        ?> 
        <label>Select Order No</label>
        <?php
    }
    else if($_POST['section'] == 'grn')
    {
        ?> 
        <label>Select GRN No</label>
        <?php 
    }
?>