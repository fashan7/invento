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
		
        

        
        if(empty($_POST['fname']))
        {
            $error = true;
            ?> 
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="alert alert-info">
                    <strong>Alert !   </strong>First Name is Empty<br>
  			   </div>
            </div>
		    <div class="col-lg-3"></div>
            <?php
        }
        
        if(empty($_POST['sname']))
        {
            $error = true;
            ?> 
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="alert alert-info">
                    <strong>Alert !   </strong>Last Name is Empty<br>
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
                    <strong>Alert !   </strong>Please Provide Telephone No<br>
  			   </div>
            </div>
		    <div class="col-lg-3"></div>
            <?php
        }
        
        if(empty($_POST['dob']))
        {
            $error = true;
            ?> 
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="alert alert-info">
                    <strong>Alert !   </strong>Please Provide your Birth Date<br>
  			   </div>
            </div>
		    <div class="col-lg-3"></div>
            <?php
        }
        
        if(empty($_POST['nic']))
        {
            $error = true;
            ?> 
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="alert alert-info">
                    <strong>Alert !   </strong>Please Provide NIC Details<br>
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
                    <strong>Alert !   </strong>Please Provide Address<br>
  			   </div>
            </div>
		    <div class="col-lg-3"></div>
            <?php
        }
        
        if(empty($_POST['username']))
        {
            $error = true;
            ?> 
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="alert alert-info">
                    <strong>Alert !   </strong>Please Provide Username<br>
  			   </div>
            </div>
		    <div class="col-lg-3"></div>
            <?php
        }
        
        if(empty($_POST['password']))
        {
            $error = true;
            ?> 
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="alert alert-info">
                    <strong>Alert !   </strong>Please Provide Password<br>
  			   </div>
            </div>
		    <div class="col-lg-3"></div>
            <?php
        }
        
        if(empty($_POST['usertype']))
        {
            $error = true;
            ?> 
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="alert alert-info">
                    <strong>Alert !   </strong>Please Provide User Type<br>
  			   </div>
            </div>
		    <div class="col-lg-3"></div>
            <?php
        }
        
        if(!$error)
        {
            echo 's';
            
            //title fname sname telno dob nic email address username password usertype accountno
            //$title = $_POST['title'];
            $fname = $_POST['fname'];
            $sname = $_POST['sname'];
            $telno = $_POST['telno'];
            $dob = $_POST['dob'];
            $nic = $_POST['nic'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $password = base64_encode($password);
            $usertype = $_POST['usertype'];
        
        
		
            $arr = array();
            
            $arr[0] = 'id';
            
            $arr[1] = mysqli_real_escape_string($obj->bridge, $nic);
            
            $arr[2] = mysqli_real_escape_string($obj->bridge, $fname);
            
            $arr[3] = mysqli_real_escape_string($obj->bridge, $sname);
            
            $arr[4] = mysqli_real_escape_string($obj->bridge, $address);
            
            $arr[5] = mysqli_real_escape_string($obj->bridge, $telno);
            
            $arr[6] = mysqli_real_escape_string($obj->bridge, $telno);
            
            $arr[7] = '';
            
            $arr[8] = '';
            
            $arr[9] = '';
                
            $arr[10] = mysqli_real_escape_string($obj->bridge, $username);
            
            $arr[11] = mysqli_real_escape_string($obj->bridge, $password);
            
            $arr[12] = mysqli_real_escape_string($obj->bridge, $dob);
            
            $arr[13] = mysqli_real_escape_string($obj->bridge, $usertype);
            
            $arr[14] = mysqli_real_escape_string($obj->bridge, $email);;
            
            $arr[15] = 'yes';
            
            $arr[16] = '';
            
            $arr[17] = $obj->getTime();
            
            $arr[18] = '';
            
            
        
            $db = 'user_reg';
        
        
		
		
            if ($obj->insertion($db, $arr) == '1') 
            {
                 $arra = array();
                 $arra[0] = $loguserid; $arra[1] = $obj->getTime(); $arra[2] = $obj->getDate(); $arra[3] = 'User Registered - Username is '." ".$username; $arra[4] = 'id';
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
                    setTimeout("location.href = 'userreg.php';",2000);	// Page Dillay 2 Second
                </script>
                <?php
            } 
            else 
            {
                ?> 
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="alert alert-warning">
                        <strong>Alert !   </strong>Some Thing Went Wrong Try Again <br>
                    </div>
                </div>
                <div class="col-lg-3"></div>
                <script type="text/javascript">
                    //setTimeout("location.href = 'userreg.php';",2000);	// Page Dillay 2 Second
                </script>
                <?php       
            
                }
            }
        

	

	