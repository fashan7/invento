<?php
require_once 'dbConnect.php';
class sqlfunctions extends Modal
{
    public function __construct()
    {
        parent::__construct();
    }
    
   public function insertion($db, $arr = array())
	{
		$concat = "";
		for($i = 0; $i < count($arr); $i++)
		{
			if($i < count($arr) - 1)
			{
				$concat .= "'".$arr[$i]."',";
			}
			else 
			{
				$concat .= "'".$arr[$i]."'";
			}
		}
		$sql = "INSERT INTO $db VALUES (".$concat.")";
		return $this->mainQuery($sql);
	}
    
    public function getDate()
    {
        date_default_timezone_set('Asia/Colombo');
        $date = date('Y-m-d');
        return $date;
    }
    
    public function getTime()
    {
        date_default_timezone_set('Asia/Colombo');
        $time = date('H:i:s:A');
        return $time;
    }
    
    public function validatedusename($username)
    {
        $sql = "SELECT * FROM user_reg WHERE username = '$username'";
        return $this->Query($sql);
    }
    
    public function customerCode()
    {
        $sql = "SELECT code FROM customer_reg";
        $result = $this->Query($sql);
        $count = mysqli_num_rows($result);
        return $count;
    }
    
    public function supplierCode()
    {
        $sql = "SELECT code FROM supplier_reg";
        $result = $this->Query($sql);
        $count = mysqli_num_rows($result);
        return $count;
    }
    
    public function updating($field, $code, $dbname, $arr = array(), $arrr = array())
    {
        $collect = "";
        for($i = 0; $i < count($arr); $i++)
        {
            if($i < count($arr) - 1)
            {
                $collect .= "$arr[$i]= '$arrr[$i]',";
            }
            else
            {
                $collect .= "$arr[$i]= '$arrr[$i]'";
            }
        }
        $sql = "UPDATE $dbname SET ".$collect." WHERE $field = '$code'";
        return $this->mainQuery($sql);
    }
}
?>