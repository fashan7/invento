<?php
require_once 'dbConnect.php';
class AccountSettings extends Modal
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function loginCheck($username, $password)
	{
		$sql = "SELECT * FROM user_reg WHERE status = 'yes' AND username = '$username' AND password = '$password'";
		return $this->Query($sql);
	}
    
    public function pageCount()
	{
		$sql = "SELECT id FROM pageallocation WHERE status = 'yes'";
		return $this->Query($sql);
	}
    
    public function countUserPrivledge($userid, $pagesid)
	{
		$sql = "SELECT COUNT(*) FROM user_priviledge WHERE userid = '$userid' AND pageallocation_id = '$pagesid'";
		return $this->Query($sql); 
	}
    
    public function selectPageSide($loguserid)
	{
		$sql = "SELECT pa.primarysection, pa.sectionposition FROM pageallocation pa JOIN user_priviledge  pr ON pr.pageallocation_id = pa.id WHERE pa.status = 'yes' AND pr.viewstatus = 'yes' AND  pr.userid  = '$loguserid' GROUP BY pa.primarysection ORDER BY pa.secondarysection";
		return $this->Query($sql);
	}
    
    public function enablePriviledge($loguserid, $sectioName)
	{
		$sql = "SELECT pa.pages FROM pageallocation pa JOIN user_priviledge pr ON pr.pageallocation_id = pa.id WHERE pr.userid = '$loguserid' AND pa.primarysection = '$sectioName' AND pa.status = 'yes'";
		return $this->Query($sql);
	}
    
    public function getsubsection($id)
	{
		$sql = "SELECT primarysection, secondarysection FROM pageallocation WHERE sectionposition = '$id' GROUP BY secondarysection ORDER BY position, id";
		return $this->Query($sql);
	}
    
    public function selectOnlySection($position)
	{
		$sql = "SELECT * FROM pageallocation WHERE sectionposition = '$position' GROUP BY primarysection";
		return $this->Query($sql);
	}
    
    public function getsubsection4($loguserid, $primarysection)
	{
		$sql = "SELECT pa.pages, pa.name, pa.image FROM pageallocation pa JOIN user_priviledge pr ON pr.pageallocation_id = pa.id WHERE pr.userid = '$loguserid' AND pa.primarysection = '$primarysection' AND pr.viewstatus = 'yes'  AND pa.status = 'yes' ORDER BY pa.position";
		return $this->Query($sql);
	}
    public function pagesections($sectionname)
	{
		$sql = "SELECT * FROM pageallocation WHERE primarysection = '$sectionname' ORDER BY primarysection";
		return $this->Query($sql);
	}
    
    public function updateUserpriv($sign, $id)
	{
		$sql = "UPDATE user_priviledge SET viewstatus = '$sign' WHERE id = '$id'";
		return $this->Query($sql);
	}
    
    public function select_user_reg($id)
	{
		$sql = "SELECT * FROM user_reg WHERE id = '$id'";
		return $this->Query($sql);
	}
    
    public function selectsectionTB()
	{
		$sql = "SELECT primarysection FROM pageallocation WHERE status = 'yes' GROUP BY primarysection ORDER BY id";
		return $this->Query($sql);
	}
    
    public function userprivOldPage($section, $id)
	{
		$sql = "SELECT pa.name, pr.viewstatus, pr.id FROM user_priviledge pr JOIN pageallocation pa ON pa.id = pr.pageallocation_id 
		JOIN user_reg ur ON ur.id = pr.userid WHERE pa.primarysection = '$section' AND pa.status = 'yes' AND pr.userid = '$id' ORDER BY pa.position";
		return $this->Query($sql);
	}
    
    public function userprivNewPage($section)
	{
		$sql = "SELECT pa.name, pa.pages, pa.id FROM pageallocation pa LEFT OUTER JOIN user_priviledge up ON pa.id = up.pageallocation_id 
		WHERE pa.primarysection = '$section' AND pa.status = 'yes' AND up.pageallocation_id IS NULL ORDER BY pa.position";
		return $this->Query($sql);
	}
}
?>






