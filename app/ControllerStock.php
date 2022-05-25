<?php
require_once 'dbConnect.php';
class stockfunctions extends Modal
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function selectstockcatbyname($stockcat)
    {
        $sql = "SELECT * FROM stock_cat WHERE name = '$stockcat'";
        return $this->Query($sql);
    }
    public function selectstockcat()
    {
        $sql = "SELECT * FROM stock_cat WHERE active = 'yes'";
        return $this->Query($sql);
    }
    public function selectstockcatedit($catergory)
    {
        $sql = "SELECT * FROM stock_cat WHERE active = 'yes' AND id != '$catergory'";
        return $this->Query($sql);
    }
    public function selectstockcatbyid($catergory)
    {
        $sql = "SELECT * FROM stock_cat WHERE active = 'yes' AND id = '$catergory'";
        return $this->Query($sql);
    }
    public function updatestockcat($stockcat, $stockcatid)
    {
        $sql = "UPDATE stock_cat SET name = '$stockcat' WHERE id = '$stockcatid'";
        return $this->Query($sql);
    }
    public function updatestockbrand($brandnameupdate, $brandcodeupdate, $stockbrandid)
    {
        $sql = "UPDATE stock_brand SET name = '$brandnameupdate', code = '$brandcodeupdate' WHERE id = '$stockbrandid'";
        return $this->Query($sql);
    }
    public function selectstockbrandbyname($brandcode)
    {
        $sql = "SELECT * FROM stock_brand WHERE code = '$brandcode'";
        return $this->Query($sql);
    }
    public function selectstockbrand()
    {
        $sql = "SELECT * FROM stock_brand WHERE active = 'yes'";
        return $this->Query($sql);
    }
    public function selectstockbrandedit($brand)
    {
        $sql = "SELECT * FROM stock_brand WHERE active = 'yes' AND id != '$brand'";
        return $this->Query($sql);
    }
    public function selectstockbrandbyid($brand)
    {
        $sql = "SELECT * FROM stock_brand WHERE active = 'yes' AND id = '$brand'";
        return $this->Query($sql);
    }
    public function selectstockregbycode($itemcode)
    {
        $sql = "SELECT * FROM item WHERE code = '$itemcode'";
        return $this->Query($sql);
    }
    public function selectstockqtybycode($itemcode)
    {
        $sql = "SELECT * FROM stock_master WHERE itemcode = '$itemcode'";
        return $this->Query($sql);
    }
    public function selectstockregbyid($getitem)
    {
        $sql = "SELECT * FROM item WHERE id = '$getitem'";
        return $this->Query($sql);
    }
    public function selectstockreg()
    {
        $sql = "SELECT * FROM item WHERE active = 'yes'";
        return $this->Query($sql);
    }
     public function selectstockregbycat($itemcat)
    {
        $sql = "SELECT * FROM item WHERE active = 'yes' AND category = '$itemcat'";
        return $this->Query($sql);
    }
    public function selectstockregcheck($itemcode)
    {
        $sql = "SELECT * FROM item WHERE active = 'yes' AND code = '$itemcode'";
        return $this->Query($sql);
    }
    public function updatestock($itemname, $itemcode, $itemcat, $itembrand, $qty, $costprice, $sellingprice, $itemid)
    {
        $sql = "UPDATE item SET name = '$itemname', code = '$itemcode', category = '$itemcat', brand = '$itembrand', quantity = '$qty', costprice = '$costprice', sellingprice = '$sellingprice' WHERE id = '$itemid'";
        return $this->Query($sql);
    }
     public function SearchcatbyName($search)
    {
        $sql = "SELECT name, id FROM stock_cat WHERE name LIKE '%$search%'";
        return $this->Query($sql);
    }
    
     public function SearchbrandbyNameandid($search, $categoryid)
    {
        $sql = "SELECT name, id FROM stock_brand WHERE catergory = '$categoryid' AND name LIKE '%$search%'";
        return $this->Query($sql);
    }
    
    public function SearchItembyName($search)
    {
        $sql = "SELECT name, code, quantity, costprice, sellingprice, id FROM item WHERE name LIKE '%$search%'";
        return $this->Query($sql);
    }
    
    public function SearchItembyCode($search)
    {
        $sql = "SELECT name, code, quantity, costprice, sellingprice, id FROM item WHERE code LIKE '%$search%'";
        return $this->Query($sql);
    }
    
    public function SearchItembyNameandCategory($catergory, $search)
    {
        $sql = "SELECT name, code, quantity, costprice, sellingprice, id FROM item WHERE category = '$catergory' AND name LIKE '%$search%'";
        return $this->Query($sql);
    }
    
    public function SearchItembycodeandCategory($catergory, $search)
    {
        $sql = "SELECT name, code, quantity, costprice, sellingprice, id FROM item WHERE category = '$catergory' AND code LIKE '%$search%'";
        return $this->Query($sql);
    }
}
?>





