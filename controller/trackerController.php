<?php
    require '/Applications/XAMPP/xamppfiles/htdocs/PT2/model/productsModel.php';
    require 'model/product.php';
	 
	require '/Applications/XAMPP/xamppfiles/htdocs/PT2/model/wishlist.php';
    

    require_once '/Applications/XAMPP/xamppfiles/htdocs/PT2/config.php';
	session_start();
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
			if(isset($_SESSION['User_name']) && !empty($_SESSION['User_name'])){
			$act = isset($_GET['act']) ? $_GET['act'] : NULL;
			switch ($act) 
			{
                case 'Track_Hourly' :                    
				$this->TrackByHourAll();
				break;						
				case 'Track_Day':
				$this -> TrackByDayAll();
				break;				
				case 'wishlist' :					
				$this -> wishlist();
				break;
				case 'add' :                    
				$this->insert($_GET['Prod_id']);
				break;
				case 'delete' :					
					$this -> delete($_GET['Prod_id']);
					break;																
				default:
				$this->list();
				
			}
		}else{
			$this->askLogin();                                      
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
            $result=$this->objsm->selectWishlistRecord($_SESSION['User_name']); //taking username
            include "view/wishlist.php";                                        
        }

		public function TrackByHourAll(){
            $result=$this->objsm->TrackByHourAllRecord(1); //taking username
            include "view/pricebyhour.php";                                        
        }

		public function TrackByDayAll(){
            $result=$this->objsm->TrackByDayAllRecord(1); //taking username
            include "view/pricebyday.php";                                        
        }
		public function askLogin(){
            include "view/login.php";                                        
        }

			// add new record
			public function insert($Prod_id)
			{
				try{
					$prodtb=new product(); 
						// read form value
						$prodtb->Prod_id = trim($Prod_id);
						$prodtb->Wishlist_id = $_SESSION['Wishlist_id'];
						//call validation
						//$chk=$this->checkValidation($prodtb);                    
						//if($chk)
						//{   
							//call insert record            
							$pid = $this->objsm->insertRecord($prodtb);
							if($pid>0){			
								
								echo "Somthing is wrong..., try again.";
							}else{
								header("location:index.php?act=wishlist&User_name=".$_SESSION['User_name']);
								
							}
						//}
					
				}catch (Exception $e) 
				{
					$this->close_db();	
					throw $e;
				}
			}
			        // delete record
					public function delete($Prod_id)
					{ 
						try
						{
							if (isset($Prod_id)) 
							{
								$res=$this->objsm->deleteRecord($Prod_id);                
								if($res){
									header("location:index.php?act=wishlist&User_name=".$_SESSION['User_name']);
								}else{
									echo "Somthing is wrong..., try again.";
								}
							}else{
								echo "Invalid operation.";
							}
						}
						catch (Exception $e) 
						{
							$this->close_db();				
							throw $e;
						}
					}


    }
?>