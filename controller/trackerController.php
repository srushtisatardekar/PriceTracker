<?php
    require 'model/productsModel.php';
    // require 'model/products.php';
	require 'model/wishlist.php';
    

    require_once 'config.php';

    session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
    
	class trackerController 
	{

 		function __construct() //create objects for 
		{          
			$this->objconfig = new config();
			$this->objsm =  new productsModel($this->objconfig);

		}
        // mvc handler request
		public function mvcHandler() 
		{
			$act = isset($_GET['act']) ? $_GET['act'] : NULL;
			switch ($act) 
			{
                 case 'Track_Hourly' :                    
					$this->TrackByHourAll();
				// 	break;						
				// case 'update':
				// 	$this->update();
				// 	break;				
				// case 'wishlist' :					
				// 	$this -> wishlist();
				// 	break;								
				default:
                   $this->list();
				   //$this->TrackByHourAll();
			}
		}		
        // page redirection
		public function pageRedirect($url)
		{
			header('Location:'.$url);
		}

        public function list(){ //product
            $result=$this->objsm->selectRecord(0); //all data from table; if 1 only 1 prod disp
            include "view/list.php";      //product                                  
        }
		public function wishlist(){
            $result=$this->objsm->selectWishlistRecord("sathya"); //taking username
            include "view/wishlist.php";                                        
        }

		public function TrackByHourAll(){
            $result=$this->objsm->TrackByHourAllRecord("sathya"); //taking username
            include "view/trackerAll.php";                                        
        }

    }
?>