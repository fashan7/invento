<?php
session_start();
    $logusername   =     $_SESSION['username'];
    $loguserid     =     $_SESSION['userid'];
    $loguserbranch =     $_SESSION['branch'];

    if(!$loguserid)
    {
	   header("Location:login.php");
    }
?>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="description" content="Miminium Admin Template v.1">
  <meta name="author" content="Isna Nur Azis">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HR</title>

  <!-- start: Css -->
  <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">

  <!-- plugins -->
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/font-awesome.min.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/simple-line-icons.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/animate.min.css"/>
  <link href="asset/css/style.css" rel="stylesheet">
  <!-- end: Css -->

  <link rel="shortcut icon" href="asset/img/logomi.png">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<?php
    include 'ControllerPage.php';
    include 'ControllerQuery.php';
    include 'ControllerStock.php';
    include 'ControllerCustomer.php';
    include 'ControllerUsers.php';
    include 'ControllerInventory.php';
    include 'ControllerSales.php';

    $obj            = new AccountSettings();
    $object         = new sqlfunctions();
    $stock          = new stockfunctions();
    $customer       = new customerfunctions();
    $usersettings   = new userfunctions();
    $inventory      = new inventoryfunction();
    $sales          = new salesFunction();

    $error = false;
    
    if(isset($_POST['save']))
    {
        
        $sqlselectmaxrepno = $sales->selectmaxrepno();
        $fetchselectmaxrepno    = mysqli_fetch_array($sqlselectmaxrepno);

        if($fetchselectmaxrepno[0] == '')
        {
            $reciptno = '0001';
        }
        else
        {
            $incrementorder = $fetchselectmaxrepno[0] + 1;
            $reciptno = str_pad($incrementorder, 4, '0', STR_PAD_LEFT);
        }
                                    
        
        
        $reciptdate         = $_POST['reciptdate'];
        $reciptdate         = mysqli_real_escape_string($obj->bridge, $reciptdate);

        $billno             = $_POST['billno'];
        $billno             = mysqli_real_escape_string($obj->bridge, $billno);
        
        $paymentamount      = $_POST['paymentamount'];
        $paymentamount      = mysqli_real_escape_string($obj->bridge, $paymentamount); 
        
        $cardref            = $_POST['cardref'];
        $cardref            = mysqli_real_escape_string($obj->bridge, $cardref);
        
        $cardno             = $_POST['cardno'];
        $cardno             = mysqli_real_escape_string($obj->bridge, $cardno);
        
        
        $sqlselectbybillnosummary = $sales->selectbybillnosummary($billno);
        $fetchselectbybillnosummary = mysqli_fetch_array($sqlselectbybillnosummary);
        
        $balance = $fetchselectbybillnosummary['paybalense'];
        $billDate = $fetchselectbybillnosummary['billDate'];
        $subTotal = $fetchselectbybillnosummary['subTotal'];
        
        if($paymentamount > $balance)
        {
            
           $newcreditamount   = '0';
            $paymentamount  = $balance;
            
        }
        else
        {
            $newcreditamount    = $balance - $paymentamount; 
            
        }
        
        
        
        

        
        $paytype            = $_POST['paytype'];
        $paytype            = mysqli_real_escape_string($obj->bridge, $paytype);

        
        
        date_default_timezone_set('Asia/Colombo');
        $time                  = date('H:i:s:A');

        date_default_timezone_set('Asia/Colombo');
        $date                  = date('Y-m-d');
        
        $datetime = $date." ".$time;
        
        $dbnameorder = 'recipt';
        $arr = array();
        $arr[0]     = $reciptno;
        $arr[1]     = $billno;
        $arr[2]     = $paytype;
        $arr[3]     = $cardref;
        $arr[4]     = $cardno;
        $arr[5]     = $paymentamount;
        $arr[6]     = $newcreditamount;
        $arr[7]     = '';      
        $arr[8]     = 'yes';
        $arr[9]     = $reciptdate;
        $arr[10]    = $loguserid; 
        $arr[11]    = 'yes';
        $arr[12]    = '';
        $arr[13]    = 'id';
 

        if($object->insertion($dbnameorder, $arr) == 1)
        {
            $sales->updatebillsummary($newcreditamount, $billno);
            ?>
            <body id="mimin" onload = "window.print();">

              <div class="container invoice invoice-v1">
                <!-- start: Content -->
                <div class="panel invoice-v1-content">
                    <div class="panel-body">
                        <div class="col-md-12 invoice-v1-header">
                          <div class="col-md-12">
                            <h1><b>Recipt</b></h1>
                          </div>
                          <div class="col-md-12">
                              <div class = "row">
                              <div class="col-md-6">
                            <h4>
                            <address>
                              <strong>Recipt #: <?=$reciptno?></strong><br>
                              Created: <?=$reciptdate?><br>
                              Payment Type: <?=$paytype?><br>
                            </address>
                            </h4>
                          </div>
                             <div class="col-md-6" text-right>
                                <h4>
                                <address>
                                  <strong>HR shop.</strong><br>
                                  1234 Mimin Street, Suite 900<br>
                                  Miminium City, CA 94103<br>
                                  Contact: (123) 456-7890
                                </address>
                                </h4>
                            </div>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                           
            <!--
                            <div class="col-md-6 text-right">
                                <h4>
                                <address>
                                  <strong>AlfaMiminium Corp</strong><br>
                                  Akihiko Avaron<br>
                                  akihiko.avaron@gmail.com<br>
                                </address>
                                </h4>
                            </div>
            -->
                        </div>
                        <div class="col-md-12 padding-0">
                            <div class="responsive-table">

                               <table class="table table-striped">
                                <tr>
                                  <th>INVOICE NO</th>
                                  <th>INVOICE DATE</th>
                                  <th>TOTAL(RS)</th>
                                  <th>CREDIT AMOUNT(RS)</th>
                                  <th>PAID AMOUNT(RS)</th>
                                </tr>
                                <tr>
                                  <td><?=$billno?></td>
                                  <td><?=$billDate?></td>
                                  <td><?=$subTotal?></td>
                                  <td><?=$balance?></td>
                                  <td><?=$paymentamount?></td>
                                </tr>
                                <tr>
                                  <th colspan="4">BALANCE(RS)</th>
                                  <td><?=$newcreditamount?></td>
                                </tr>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end: content -->
              </div>
            <?php
            
        }

        ?>
<!--
        <div class="row col-lg-12">
            <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="alert alert-success">
                        <strong>Alert !   </strong>Invoice SuccessFully<br>
                    </div>
                </div>
            <div class="col-lg-3"></div>
        </div>		
-->
        <script type="text/javascript">
            setTimeout("location.href = 'receipt.php';",1000);	// Page Dillay 2 Second
        </script>
        <?php
    }
    else
    {
        ?> 
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <div class="alert alert-danger">
                <strong>Alert !   </strong>Some Thing Went Wrong <br>
            </div>
        </div>
        <div class="col-lg-3"></div>
        <script type="text/javascript">
            setTimeout("location.href = 'receipt.php';",1000);	// Page Dillay 2 Second
        </script>
        <?php  
    } ?>
    
    <script src="asset/js/jquery.min.js"></script>
<script src="asset/js/jquery.ui.min.js"></script>
<script src="asset/js/bootstrap.min.js"></script>


<!-- plugins -->
<script src="asset/js/plugins/moment.min.js"></script>
<script src="asset/js/plugins/jquery.nicescroll.js"></script>


<!-- custom -->
<script src="asset/js/main.js"></script>
<script type="text/javascript">
</script>
<!-- end: Javascript -->
</body>
</html>