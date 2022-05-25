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
    include 'ControllerUsers.php';

    $obj            = new AccountSettings();
    $object         = new sqlfunctions();
    $stock          = new stockfunctions();
    $customer       = new customerfunctions();
    $usersettings   = new userfunctions();

if (isset($_GET['user']) && isset($_GET['id']) && isset($_GET['sign'])) {
		$user = $_GET['user'];	// Search User Id
		$pId = $_GET['id'];		// Page Id
		$sign = $_GET['sign'];	// View  Yes / No
		
		if (isset($_GET['new'])) {	// For New Page
			$arr = array();
			$db = 'user_priviledge';
			$arr[0] = $user;
			$arr[1] = $pId;
			$arr[2] = $sign;
			$arr[3] = 'id';
			$object->insertion($db, $arr); //insert new priviledge
		}
		
// Update User Privilege
		$obj->updateUserpriv($sign, $pId);
		
// Insert user Lg Details
		$select_user = $obj->select_user_reg($user);
		$result_user = mysqli_fetch_array($select_user);
		
		$action = "Set user privileges : ".$result_user['first_name']." ".$result_user['last_name'];
		$arrr = array();
		$arrr[0] = $user; $arrr[1] = $object->getTime(); $arrr[2] = $object->getDate(); $arrr[3] = $action; $arrr[4] = 'id';
		$database = 'history';
		$object->insertion($database, $arrr); //action details in the user login table
	}

// Search
	else {
		$user = $_GET['usernames'];
	}



$sqlselectuserbyid = $usersettings->selectuserbyid($user);
$fetchselectuserbyid = mysqli_fetch_array($sqlselectuserbyid);
?>
<div class="form-element">
                <form class="form" id="userreg" name="userreg" action="updateuser.php" method="post" enctype="multipart/form-data">
                  <div class="col-md-12 padding-0"> 
                    <div class="col-md-12">
                      <div class="panel form-element-padding">
                        <div class="panel-heading">
                         <h4>User Privilage</h4>
                        </div>
                         <div class="panel-body" style="padding-bottom:30px;">
                          <div class="col-md-4" style="padding-bottom:30px;"> 
                              <label>First Name</label>
                              <input type="text" class="form-control android" name="fname" id="fname" value = "<?= $fetchselectuserbyid['first_name']?>" autocomplete="off">
                          </div>
                          <div class="col-md-4" style="padding-bottom:30px;"> 
                              <label>Last Name</label>
                              <input type="text" class="form-control android" name="sname" id="sname" value = "<?= $fetchselectuserbyid['last_name']?>" autocomplete="off">
                          </div>
                             <div class="col-md-4" style="padding-bottom:30px;"> 
                              <label>Telephone No</label>
                              <input type="text" class="form-control android" name="telno" id="telno" value = "<?= $fetchselectuserbyid['tel_no']?>" autocomplete="off">
                            </div>
                          </div>
                          <div class="panel-body">  
                          <div class="col-md-4 form-animate-text" style="padding-bottom:30px;"> 
                              <label>Date Of Birth</label>
                              <input type="text" class="form-control android" name="dob" id="dob" value = "<?= $fetchselectuserbyid['birthday']?>" autocomplete="off">
                          </div>
                            <div class="col-md-4" style="padding-bottom:30px;"> 
                              <label>NIC No</label>
                              <input type="text" class="form-control android" name="nic" id="nic" value = "<?= $fetchselectuserbyid['nic']?>" autocomplete="off">
                          </div>
                          <div class="col-md-4" style="padding-bottom:30px;"> 
                              <label>Email</label>
                              <input type="text" class="form-control android" name="email" id="email" value = "<?= $fetchselectuserbyid['email']?>" autocomplete="off">
                          </div>
                          </div>
                          <div class="panel-body">
                          <div class="col-md-12" style="padding-bottom:30px;"> 
                              <label>Address</label>
                              <input type="text" class="form-control android" name="address" id="address" value = "<?= $fetchselectuserbyid['address']?>" autocomplete="off">
                          </div>
                        </div>
                            <div class="panel-body">
                            <div class="col-md-3" style="padding-bottom:30px;"> 
                              <label>User Name</label> 
                              <input type="text" class="form-control android" name="username" id="username" value = "<?= $fetchselectuserbyid['username']?>" autocomplete="off">
                            </div>
                             <input type="hidden" class="form-control android" name="userid" id="userid" value = "<?= $fetchselectuserbyid['id']?>" autocomplete="off">
                            <div class="col-md-3" style="padding-bottom:30px;"> 
                             <label>User Type</label>
                              <br>
                                <select class="form-control" name="usertype" id="usertype" autocomplete="off">
                                    <?php
                                    $usertypeid = $fetchselectuserbyid['usertype'];
                                    $sqlselectusertype = $usersettings->selectusertype();
                                    while($fetchselectusertype = mysqli_fetch_array($sqlselectusertype))
                                    {
                                    ?>
                                    <option value="<?= $fetchselectusertype['id']?>" <?php if($fetchselectusertype['id'] == $usertypeid){?>selected<?php } ?>><?= $fetchselectusertype['name']?></option>
                                    <?php
                                    }
                                        ?>
                                </select>
                          </div>
                          <div class="col-md-6"> 
                          </div>
                            </div>
                            <div class="panel-body">
                                <div class = "row">
                                     <div class="panel-body">
                                         
                                      <div class="col-md-3">
                                          <button style="margin-top:0px !important;" name="btn-save" id="btn-submit" class="btn-flip btn btn-3d btn-info">
                                            <div class="flip">
                                              <div class="side">
                                                Update <span class="fa fa-check"></span>
                                              </div>
                                              <div class="side back">
                                                are you sure?
                                              </div>
                                            </div>
                                            <span class="icon"></span>
                                          </button>
                                      </div>
                                  </div>
                                </div>
                          </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
                        
                <div class="form-element">
                    <div class="col-md-12 padding-0"> 
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="panel form-element-padding">
                                <?php
                                // Fill New Page Into Privilage Table
                                // Select All Pages
                                $select_new_page = $obj->pageCount();
                                while ($result_new_page = mysqli_fetch_array($select_new_page)) 
                                {
                                    // Check That Page in Privileges Table
                                    $pageidd = $result_new_page[0];
                                    $select_privileges = $obj->countUserPrivledge($user, $pageidd);
                                    $result_privileges = mysqli_fetch_array($select_privileges);
				
                                    if ($result_privileges[0] > 0) {	// Have Record In Privilege Page
                                    }
                                    else 
                                    {	// Not Record In Privilege Page
                                        $database1 = 'user_priviledge';
                                        $ar = array();
                                        $ar[0] = $user; $ar[1] = $pageidd; $ar[2] = 'no'; $ar[3] = 'id';
                                        $object->insertion($database1, $ar);
                                    }
                                }
                                // End of Fill New Page Into Privilage Table
			
                                // Select Section
                                $select_section = $obj->selectsectionTB();
                                ?>
                                <div class="panel-body" style="padding-bottom:30px;">
                                    <table id="myTable" class=" table order-list">
                                        <caption>User privileges for <?= $fetchselectuserbyid['first_name'].' '.$fetchselectuserbyid['last_name']?></caption>
                                    <?php 
            		              while ($result_section = mysqli_fetch_array($select_section)) 
                                  {
                                    ?>
                                        <thead>
                                            <tr>
                                                <th scope="col"><?php echo $result_section[0];?></th>
                                                <th scope="col">View (Yes/No)</th>
                                                <th scope="col">Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php 
                                      // Select User Assecc Pages
                                      $sectionName = $result_section[0];
                                      $select_page = $obj->userprivOldPage($sectionName, $user);
                                      while ($result_page = mysqli_fetch_array($select_page)) 
                                      {
                                          $id = $result_page[2];
                                          if ($result_page[1] == 'yes') // View Page 
                                          {	
                                              $check = "checked='checked'";	// Checkbox On
                                              $span = "(Yes)";
                                          }
                                          else // Not View Page
                                          {	
                                              $check = '';	// Checkbox Off
                                              $span = "(No)";
                                          }		
                                            ?>
                                            <tr>
                                                <td data-label="<?php echo $result_page[0];?>">
                                                    <label><?php echo $result_page[0];?></label>
                                                </td>
                                                <td data-label="View (Yes/No)">
                                                    <div class="form-animate-checkbox" style="padding: 0px;font-size: 1px;">
                                                        <label><input type="checkbox" class="checkbox" name="changeCon<?php echo $id?>" id="changeCon<?php echo $id?>" <?php echo $check;?> onClick="fillSpan('<?php echo $id;?>')">
                                                        <span id="viewCon<?php echo $id;?>" style='margin-left:5px'><?php echo $span;?></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td data-label="Edit">
                                                    <a style="text-decoration: none;" href="javascript:getUserPrivileges('<?php echo $id;?>')">Edit</a>
                                                </td>
                                            </tr>
                                            <?php 
						                  }
                                      // Select New Add Page
                                      $select_new_page = $obj->userprivNewPage($sectionName);
                                      while ($result_new_page = mysqli_fetch_array($select_new_page)) 
                                      {
                                          if ($result_new_page[0] == $result_page[0]) 
                                          {
                                          } 
                                          else 
                                          {
                                              
                                              $newId = $result_new_page[2];
								              $arrrr = array();
                                              $arrrr[0] = $user; $arrrr[1] = $result_new_page[2]; $arrrr[2] = 'no'; $arrrr[3] = 'id';
                                              $database12 = 'user_priviledge';
								//echo $database12;
                                              $object->insertion($database12, $arrrr);
								            ?>
                                            <tr>
                                                <td data-label="<?php echo $result_page[0];?>">
                                                    <label><?php echo $result_page[0];?></label>
                                                </td>
                                                <td data-label="View (Yes/No)">
                                                    <div class="form-animate-checkbox" style="padding: 0px;font-size: 1px;">
                                                        <label><input type="checkbox" class="checkbox"  name="changeNewCon<?php echo $newId?>" id="changeNewCon<?php echo $newId?>"  onClick="fillSpan('<?php echo $newId;?>')" >
                                                        <span id="viewNewCon<?php echo $newId;?>" style='margin-left:5px'>(No)</span></label>
                                                    </div>
                                                </td>
                                                <td data-label="Edit">
                                                    <a style="text-decoration: none;" href="getNewUserPrivileges('<?php echo $newId;?>')">Edit</a>
                                                </td>
                                            </tr>
                                            <?php 
							                 }
                                        }
        				                ?>		
                                        </tbody>
                                    <?php  
                                        }
                                      ?>
                                    </table>   
                                </div>
                            </div>
                        </div>
                      <div class="col-md-3"></div>
                  </div>
              </div>