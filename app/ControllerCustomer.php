<?php
require_once 'dbConnect.php';
class customerfunctions extends Modal
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function selectcustomer()
    {
        $sql = "SELECT * FROM customer_reg WHERE status = 'yes'";
        return $this->Query($sql);
    }
    public function selectcustomerbyid($customerid)
    {
        $sql = "SELECT * FROM customer_reg WHERE status = 'yes' AND id = '$customerid'";
        return $this->Query($sql);
    }
    public function updatecustomer($cname, $contactperson, $telenmum, $fax, $address, $customerid)
    {
        $sql = "UPDATE customer_reg SET name = '$cname', c_person = '$contactperson', phone_no = '$telenmum', fax = '$fax', address = '$address' WHERE id = '$customerid'";
        return $this->Query($sql);
    }
    public function selectsupplier()
    {
        $sql = "SELECT * FROM supplier_reg WHERE status = 'yes'";
        return $this->Query($sql);
    }
    public function selectsupplierbyid($supplierid)
    {
        $sql = "SELECT * FROM supplier_reg WHERE status = 'yes' AND id = '$supplierid'";
        return $this->Query($sql);
    }
    public function updatesupplier($cname, $contactperson, $telenmum, $fax, $address, $customerid)
    {
        $sql = "UPDATE supplier_reg SET name = '$cname', c_person = '$contactperson', phone_no = '$telenmum', fax = '$fax', address = '$address' WHERE id = '$customerid'";
        return $this->Query($sql);
    }
    public function SearchcustomerbyName($search)
    {
        $sql = "SELECT name, id, address, phone_no, code FROM customer_reg WHERE name LIKE '%$search%'";
        return $this->Query($sql);
    }
    
    public function SearchcustomerbyCode($search)
    {
        $sql = "SELECT name, id, address, phone_no, code FROM customer_reg WHERE code LIKE '%$search%'";
        return $this->Query($sql);
    }
}
?>