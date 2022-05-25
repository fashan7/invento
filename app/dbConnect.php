<?php
class Modal
{
    public $bridge = "";    
    protected function __construct()
    {
        $con = new mysqli('localhost', 'sfsoluti_axis', 'webaxis321', 'sfsoluti_hrshop');
        
        if($con->connect_error)
            trigger_error('Connection Error'." ".$con->connect_error);
        else
            $this->bridge = $con;
    }
    
    public function mainQuery($sql)
    {
        $val = 1;
        $this->bridge->query($sql) or $val = 0;
        return $val;
    }
    
    public function Query($sql)
    {
        return $this->bridge->query($sql);
    }
}
?>