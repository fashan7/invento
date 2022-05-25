<?php
require_once 'dbConnect.php';
class userfunctions extends Modal
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function selectbranchbyname($branchname)
    {
        $sql = "SELECT * FROM branch WHERE name = '$branchname'";
        return $this->Query($sql);
    }
    public function selectbranch()
    {
        $sql = "SELECT * FROM branch";
        return $this->Query($sql);
    }
     public function updatebranch($branchupdate, $branchid)
    {
        $sql = "UPDATE branch SET name = '$branchupdate' WHERE id = '$branchid'";
        return $this->Query($sql);
    }
    public function selectusertypebyname($usertype)
    {
        $sql = "SELECT * FROM user_type WHERE name = '$usertype'";
        return $this->Query($sql);
    }
    public function selectusertype()
    {
        $sql = "SELECT * FROM user_type";
        return $this->Query($sql);
    }
     public function updateusertype($usertypeupdate, $usertypeid)
    {
        $sql = "UPDATE user_type SET name = '$usertypeupdate' WHERE id = '$usertypeid'";
        return $this->Query($sql);
    }
    public function selectuser()
    {
        $sql = "SELECT * FROM user_reg";
        return $this->Query($sql);
    }
    public function selectuserbyid($userid)
    {
        $sql = "SELECT * FROM user_reg WHERE id = '$userid'";
        return $this->Query($sql);
    }
    public function selectuserbynicoremail($nic, $email)
    {
        $sql = "SELECT * FROM user_reg WHERE nic = '$nic' OR email = '$email'";
        return $this->Query($sql);
    }
    public function updateuserpassword($loguserid, $newenctypepassword)
    {
        $sql = "UPDATE user_reg SET password = '$newenctypepassword' WHERE id = '$loguserid'";
        return $this->Query($sql);
    }
    public function updateuserreg($fname, $sname, $telno, $dob, $nic, $email, $address, $username, $usertype, $userid)
    {
        $sql = "UPDATE user_reg SET first_name = '$fname', last_name = '$sname', address = '$address', tel_no = '$telno', username = '$username', birthday = '$dob', usertype = '$usertype', email = '$email', nic = '$nic' WHERE id = '$userid'";
        return $this->Query($sql);
    } 
    public function salesRep()
    {
        $sql = "SELECT id, first_name, last_name FROM user_reg WHERE usertype = '3'";
        return $this->Query($sql);
    }
}
?>
