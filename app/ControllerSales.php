<?php
require_once 'dbConnect.php';
class salesFunction extends Modal
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function maxSalesid()
    {
        $sql = "SELECT MAX(orderno) FROM sales_oder";
        return $this->Query($sql);
    }
      public function getAllSalesOrder()
    {
        $sql = "SELECT * FROM sales_oder WHERE orderstatus = 'yes' GROUP BY orderno";
        return $this->Query($sql);
    }
    
    public function getAllDetailsofSalesOrderbyONo($orderno)
    {
        $sql = "SELECT * FROM sales_oder WHERE orderstatus = 'yes' AND orderno = '$orderno'";
        return $this->Query($sql);
    }
    public function selectpaybalance()
    {
        $sql = "SELECT * FROM `bill_summary` WHERE paybalense != '0' GROUP BY customer";
        return $this->Query($sql);
    }
    public function selectbycustomerid($customerid)
    {
        $sql = "SELECT * FROM `bill_summary` WHERE paybalense != '0' AND customer = '$customerid'";
        return $this->Query($sql);
    }
    public function selectbybillno($billno)
    {
        $sql = "SELECT * FROM `bill_master` WHERE billno = '$billno'";
        return $this->Query($sql);
    }
    public function selectbybillnosummary($billno)
    {
        $sql = "SELECT * FROM `bill_summary` WHERE billno = '$billno'";
        return $this->Query($sql);
    }
    public function selectmaxrepno()
    {
        $sql = "SELECT MAX(reciptno) FROM `recipt`";
        return $this->Query($sql);
    }
    public function updatebillsummary($newcreditamount, $billno)
    {
        $sql = "UPDATE bill_summary SET paybalense = '$newcreditamount' WHERE billNo = '$billno'";
        return $this->Query($sql);
    }
    
      public function salesOrdered()
    {
        $sql = "SELECT * FROM sales_oder WHERE orderstatus = 'yes'";
        return $this->Query($sql);
    }
    
    public function maxInvoiceNo()
    {
        $sql = "SELECT MAX(billNo) FROM bill_summary";
        return $this->Query($sql);
    }
    
    public function paymentmonths()
    {
        $sql = "SELECT no_of_months, id FROM payment_duration WHERE status = 'yes'";
        return $this->Query($sql);
    }
    
    public function updateSalesOrder($orderno)
    {
        $sql = "UPDATE sales_oder SET orderstatus = 'complete', invoicestatus = 'yes' WHERE orderno = '$orderno'";
        return $this->Query($sql);
    }
    
    public function updateSalesOrdersummary($orderno)
    {
        $sql = "UPDATE sales_order_summary SET print_status = 'yes' WHERE orderno = '$orderno'";
    }
    
    public function selectbilltype()
    {
        $sql = "SELECT * FROM `bill_summary` WHERE billtype = 'direct invoice'";
        return $this->Query($sql);
    }
    public function selectwherehouseid($warehouseid)
    {
        $sql = "SELECT * FROM `warehouse` WHERE id = '$warehouseid'";
        return $this->Query($sql);
    }
    public function selectbillmasterno($billno)
    {
        $sql = "SELECT * FROM `bill_master` WHERE billno = '$billno'";
        return $this->Query($sql);
    }
    public function selectbillsum($itemid)
    {
        $sql = "SELECT SUM(total) FROM `bill_master` WHERE itemid = '$itemid'";
        return $this->Query($sql);
    }
    public function getSales()
    {
        date_default_timezone_set('Asia/Colombo');
        $datemonth    = date('m');
        $dateyear     = date('Y');
        
        $sql = "SELECT SUM(subTotal), billDate FROM bill_summary WHERE YEAR(billDate) = '$dateyear' AND month(billDate) = '$datemonth' AND approval = 'yes' GROUP BY day(billDate)";
        return $this->Query($sql);
    }
    public function getSalesyear()
    {
        date_default_timezone_set('Asia/Colombo');
        $datemonth    = date('m');
        $dateyear     = date('Y');
        
        $sql = "SELECT SUM(subTotal), billDate FROM bill_summary WHERE YEAR(billDate) = '$dateyear' AND approval = 'yes'";
        return $this->Query($sql);
    }
    public function getSalescomplete()
    {
        
        $sql = "SELECT SUM(subTotal), billDate FROM bill_summary WHERE approval = 'yes'";
        return $this->Query($sql);
    }
    
    public function getdaySales()
    {
        date_default_timezone_set('Asia/Colombo');
        $dateday      = date('d');
        $datemonth    = date('m');
        $dateyear     = date('Y');
        
        $sql = "SELECT SUM(subTotal), billDate, billNo FROM bill_summary WHERE YEAR(billDate) = '$dateyear' AND month(billDate) = '$datemonth' AND day(billDate) = '$dateday' AND approval = 'yes' GROUP BY billNo";
        return $this->Query($sql);
    }
}