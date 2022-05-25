<?php
	session_start();
    ob_start();
?>
<html>
<head>
    <title>Verifying</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
	.no-js #loader { display: none;  }
	.js #loader { display: block; position: absolute; left: 100px; top: 0; }
	.se-pre-con {
		position: fixed;
		left: 0px;
		top: 0px;
		width: 100%;
		height: 100%;
		z-index: 9999;
		background: url(asset/gify/checkmark.gif) center no-repeat #fff;
	}
	</style>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
	<script>
		$(window).load(function() {
			$(".se-pre-con").fadeOut("slow");;
		});
	</script>
</head>
<body>
<div class="se-pre-con"></div>
</body>
<?php
    $logusername =      isset($_SESSION['username']);
    $loguserid =        isset($_SESSION['userid']);
    $loguserbranch =    isset($_SESSION['branch']);

    if($loguserid != '')
    {
        header('location: index.php');
    }
    
    include 'ControllerPage.php';
    include 'ControllerQuery.php';

    $obj = new AccountSettings();
    $object = new sqlfunctions();

	if(isset($_POST['login']))
	{
		$username = mysqli_real_escape_string($obj->bridge, $_POST['username']);
		$password = mysqli_real_escape_string($obj->bridge, $_POST['password']);
        $password = base64_encode($password);
        
        $result = $obj->loginCheck($username, $password);
        $row = mysqli_fetch_array($result);
        $count = mysqli_num_rows($result);
        
        if($count > 0)
        {      
           
            $userid =   $row['id'];
            
            if($row['usertype'] == '1')
            {
                $resultPage = $obj->pageCount();
                while($rowPage = mysqli_fetch_array($resultPage))
                {
                    $pagesid = $rowPage[0];
                    $resultPriviledge = $obj->countUserPrivledge($userid, $pagesid);
                    $rowPriviledge = mysqli_fetch_array($resultPriviledge);
                    
                    if($rowPriviledge[0] > 0)
                    {}
                    else
                    {
                        $arr = array();
				        $arr[0] = $userid; $arr[1] = $pagesid; $arr[2] = 'yes'; $arr[3] = 'id';				
				        $db = 'user_priviledge';
				        $object->insertion($db, $arr);
                    }
                }
            }
            $arra = array();
	        $arra[0] = $userid; $arra[1] = $object->getTime(); $arra[2] = $object->getDate(); $arra[3] = 'Logged In'; $arra[4] = 'id';
	        $db = 'history';
	        $object->insertion($db, $arra);
            
            $_SESSION['username'] = $username;
            $_SESSION['userid'] =   $row['id'];
            $_SESSION['branch'] =   $row['branch_loc'];
            ?>
	       <script type="text/javascript">
			 setTimeout("location.href = 'index.php';",2000);	// Page Dillay 2 Second
	       </script>
	       <?php
        }
		else
        {
            ?>
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
		      <div class="alert alert-danger">
                <strong>Alert !   </strong>Username or Password is Incorrect<br>
              </div>
	       </div>
	       <div class="col-lg-3"></div>
	       <script type="text/javascript">
			 setTimeout("location.href = 'login.php';",2000);	// Page Dillay 2 Second
	       </script>
	       <?php
        }
				
		
	}
ob_end_flush();
?>