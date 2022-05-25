<?php
    session_start();	
    $logusername =      $_SESSION['username'];
    $loguserid =        $_SESSION['userid'];
    $loguserbranch =    $_SESSION['branch'];
?>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<?php
   
        $error = false;
        include 'ControllerQuery.php';
        $obj = new sqlfunctions();
		
        
        if(empty($_POST['Sname']))
        {
            $error = true;
            ?> 
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="alert alert-info">
                    <strong>Alert !   </strong>Please Provide Supplier Name<br>
  			   </div>
            </div>
		    <div class="col-lg-3"></div>
            <?php
        }
        
        if(empty($_POST['SCode']))
        {
            $error = true;
            ?> 
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="alert alert-info">
                    <strong>Alert !   </strong>Please Provide Supplier Code<br>
  			   </div>
            </div>
		    <div class="col-lg-3"></div>
            <?php
        }
        
        if(empty($_POST['telno']))
        {
            $error = true;
            ?> 
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="alert alert-info">
                    <strong>Alert !   </strong>Please Provide Supplier Phone No<br>
  			   </div>
            </div>
		    <div class="col-lg-3"></div>
            <?php
        }
        
        if(empty($_POST['address']))
        {
            $error = true;
            ?> 
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="alert alert-info">
                    <strong>Alert !   </strong>Please Provide Supplier Address<br>
  			   </div>
            </div>
		    <div class="col-lg-3"></div>
            <?php
        }
        
        if(!$error)
        {
            $Sname = $_POST['Sname'];
            $SCode = $_POST['SCode'];
            $Cperson = $_POST['Cperson'];
            $telno = $_POST['telno'];
            $fax = $_POST['fax'];
            $email = $_POST['email'];
            $address = $_POST['address'];
        
        
		
            $arr = array();
            $arr[0] = mysqli_real_escape_string($obj->bridge, $Sname);
            $arr[1] = mysqli_real_escape_string($obj->bridge, $SCode);
            $arr[2] = mysqli_real_escape_string($obj->bridge, $Cperson);
            $arr[3] = mysqli_real_escape_string($obj->bridge, $telno);
            $arr[4] = mysqli_real_escape_string($obj->bridge, $fax);
            $arr[5] = mysqli_real_escape_string($obj->bridge, $email);
            $arr[6] = mysqli_real_escape_string($obj->bridge, $address);
            $arr[7] = 'yes';
            $arr[8] = 'id';
        
            $db = 'supplier_reg';
        
        
		
		
            if ($obj->insertion($db, $arr) == '1') 
            {
                 $arra = array();
                 $arra[0] = $loguserid; $arra[1] = $obj->getTime(); $arra[2] = $obj->getDate(); $arra[3] = 'Supplier Registered - Code is '." ".$SCode; $arra[4] = 'id';
                 $db = 'history';
	             $obj->insertion($db, $arra);
                ?> 
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="alert alert-success">
                        <strong>Alert !   </strong>Saved Successfully<br>
                    </div>
                </div>
                <div class="col-lg-3"></div>
                <script type="text/javascript">
                    setTimeout("location.href = 'supplyerreg.php';",2000);	// Page Dillay 2 Second
                </script>
                <?php
            } 
            else 
            {
                ?> 
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="alert alert-warning">
                        <strong>Alert !   </strong>Some Thing Went Wrong :( Try Again <br>
                    </div>
                </div>
                <div class="col-lg-3"></div>
                <script type="text/javascript">
                    setTimeout("location.href = 'supplyerreg.php';",2000);	// Page Dillay 2 Second
                </script>
                <?php       
            }
        }
        else
        {
            ?> 
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="alert alert-danger">
                    <strong>Alert !   </strong>Please Fill Correctly the Details<br>
                </div>
            </div>
            <div class="col-lg-3"></div>
                <script type="text/javascript">
                    setTimeout("location.href = 'supplyerreg.php';",2000);	// Page Dillay 2 Second
                </script>
            <?php     
        }
	
	