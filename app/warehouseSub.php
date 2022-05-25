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
		
        
        if(empty($_POST['Wname']))
        {
            $error = true;
            ?> 
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="alert alert-info">
                    <strong>Alert !   </strong>Please Provide Warehouse Name<br>
  			   </div>
            </div>
		    <div class="col-lg-3"></div>
            <?php
        }
        
        if(empty($_POST['Wcode']))
        {
            $error = true;
            ?> 
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="alert alert-info">
                    <strong>Alert !   </strong>Please Provide Warehouse Code<br>
  			   </div>
            </div>
		    <div class="col-lg-3"></div>
            <?php
        }
        
        
        
        if(!$error)
        {
            $Wname = $_POST['Wname'];
            $WCode = $_POST['Wcode'];
        
        
		
            $arr = array();
            $arr[0] = mysqli_real_escape_string($obj->bridge, $Wname);
            $arr[1] = mysqli_real_escape_string($obj->bridge, $WCode);
            $arr[2] = 'yes';
            $arr[3] = 'id';
        
            $db = 'warehouse';
        
        
		
		
            if ($obj->insertion($db, $arr) == '1') 
            {
                 $arra = array();
                 $arra[0] = $loguserid; $arra[1] = $obj->getTime(); $arra[2] = $obj->getDate(); $arra[3] = 'Warehouse Registered - Code is '." ".$WCode; $arra[4] = 'id';
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
                    setTimeout("location.href = 'warehouse.php';",2000);	// Page Dillay 2 Second
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
                    setTimeout("location.href = 'warehouse.php';",2000);	// Page Dillay 2 Second
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
                    setTimeout("location.href = 'warehouse.php';",2000);	// Page Dillay 2 Second
                </script>
            <?php     
        }
	