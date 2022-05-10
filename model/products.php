<?php
class products
{
    // table fields
    public $Prod_id;
    public $Description;
    public $Vendor;
    public $URL;

    // message string
    public $Prod_id_msg;
    public $Description_msg;
    public $Vendor_msg;
    public $URL_msg;
    // constructor set default value
    function __construct()
    {
        $Prod_id=0;$Description=$Vendor=$URL="";
        $Prod_id_msg=$Description_msg=$Vendor_msg=$URL_msg="";
    }
}
?>