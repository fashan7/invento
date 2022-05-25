<?php
require_once 'dbConnect.php';
class inventoryfunction extends Modal
{
    public function __construct()
    {
        parent::__construct();
    }    
        
    public function getPurchaseOrders()
    {
        $sql = "SELECT * FROM purchase_order WHERE order_status = 'yes' OR order_status = 'grn' || order_status = 'approved' GROUP BY purchase_no";
        return $this->Query($sql);
    }
    
    public function getPurchaseOrdersgrn()
    {
        $sql = "SELECT * FROM purchase_order WHERE order_status != 'grn' AND order_status != 'approved' GROUP BY purchase_no";
        return $this->Query($sql);
    }
    
    public function getPurchaseOrdersbyPO($po)
    {
        $sql = "SELECT * FROM purchase_order WHERE purchase_no = '$po' AND order_status = 'yes'";
        return $this->Query($sql);
    }
    
    public function approvedPONo()
    {
        $sql = "SELECT * FROM purchase_order WHERE order_status = 'approved' GROUP BY purchase_no";
        return $this->Query($sql);
    }
    
    public function warehouse()
    {
        $sql = "SELECT * FROM warehouse WHERE status = 'yes'";
        return $this->Query($sql);
    }
    
    public function warehousebycodeorname($warehousenameupdate, $warehousecodeupdate)
    {
        $sql = "SELECT * FROM warehouse WHERE name = '$warehousenameupdate' OR code = '$warehousecodeupdate'";
        return $this->Query($sql);
    }
    
    public function updatewarehouse($warehousenameupdate, $warehousecodeupdate, $warehouseid)
    {
        $sql = "UPDATE warehouse SET name = '$warehousenameupdate', code = '$warehousecodeupdate' WHERE id = '$warehouseid'";
        return $this->Query($sql);
    }
    
    public function getapprovedPOrders($po)
    {
        $sql = "SELECT * FROM purchase_order WHERE purchase_no = '$po' AND order_status = 'approved'";
        return $this->Query($sql);
    }
    
    public function gettoapprovePOD($porowid, $poOrderNo)
    {
        $sql = "SELECT * FROM purchase_order WHERE id = '$porowid' AND purchase_no = '$poOrderNo'";
        return $this->Query($sql);
    }
    
    public function updatePOApproval($porowid, $poOrderNo, $arr = array(), $arrr = array())
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
        $sql = "UPDATE purchase_order SET ".$collect." WHERE id = '$porowid' AND purchase_no = '$poOrderNo'";
        return $this->mainQuery($sql);
    }
        
    public function getgrnNo()
    {
        $sql = "SELECT * FROM stock_purchase_summary GROUP BY grn_no";
        return $this->Query($sql);
    }
    
    public function updatingPOItem($field, $code, $dbname, $arr = array(), $arrr = array())
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
        $sql = "UPDATE $dbname SET ".$collect." WHERE $field = '$code' AND order_status != 'grn'";
        return $this->mainQuery($sql);
    }
    
    public function getGrnOrder()
    {
        $sql = "SELECT * FROM stock_purchase_summary WHERE grn_staus = 'no' GROUP BY grn_no";
        return $this->Query($sql);
    }
    
    public function selectGrnListSummary($grn)
    {
        $sql = "SELECT * FROM stock_purchase_summary WHERE grn_no = '$grn'";
        return $this->Query($sql);
    }
    
    public function selectGrnListMasters($grn)
    {
        $sql = "SELECT * FROM stock_purchase_masters WHERE grn_no = '$grn'";
        return $this->Query($sql);
    }
	
	public function updatinggrnSum($field, $code, $dbname, $arr = array(), $arrr = array())
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
        $sql = "UPDATE $dbname SET ".$collect." WHERE $field = '$code' AND grn_staus = 'no'";
        return $this->mainQuery($sql);
    }
	
	public function updatinggrnMas($field, $code, $dbname, $arr = array(), $arrr = array())
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
        $sql = "UPDATE $dbname SET ".$collect." WHERE $field = '$code' AND grn_status = 'no'";
        return $this->mainQuery($sql);
    }
	
	public function getQuantitybyItemCode($code)
	{
		$sql = "SELECT SUM(available_qty) FROM stock_master WHERE status = 'grn' AND itemcode = '$code'";
		return $this->Query($sql);
	}
    
    public function getDetailsofStockMaster($itemcode)
    {
        $sql = "SELECT quantity, available_qty, allocate_qty, grn_no, status, id FROM stock_master WHERE itemcode = '$itemcode' ORDER BY id";
        return $this->Query($sql);
    }
    
    public function updatingStockonStockMaster($dbname, $arrr = array(), $code, $status, $id)
    {
        $arr = array();
        $arr[0] = 'available_qty';
        $arr[1] = 'allocate_qty';
        
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
        $sql = "UPDATE $dbname SET ".$collect." WHERE itemcode = '$code' AND status = '$status' AND id = '$id'";
        return $this->mainQuery($sql);
    }
    
    public function getallocateQtyStockMaster($itemcode, $id)
    {
        $sql = "SELECT allocate_qty, id FROM stock_master WHERE itemcode = '$itemcode' AND id = '$id' ORDER BY id";
        return $this->Query($sql);
    }
    
     public function warehousebyid($id)
    {
        $sql = "SELECT * FROM warehouse WHERE status = 'yes' AND id = '$id'";
        return $this->Query($sql);
    }
}
?>