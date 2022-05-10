<?php
class wishlist
{
    // table fields

    public $Wishlist_id;
    public $wishlist_description;
    public $Prod_id;
    public $product_description;
    public $Vendor;
    public $URL;

    // message string
    
    public $Wishlist_id_msg;
    public $wishlist_description_msg;
    public $Prod_id_msg;
    public $product_description_msg;
    public $Vendor_msg;
    public $URL_msg;
    // constructor set default value
    function __construct()
    {
        $Wishlist_id=0;$Description=$Prod_id=$Description=$Vendor=$URL="";
        $Wishlist_id_msg=$Description_msg=$Prod_id_msg=$Description_msg=$Vendor_msg=$URL_msg="";

        
    }
}
?>