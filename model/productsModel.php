<?php

class productsModel
{
    // set database config for mysql
    function __construct($consetup)
    {
        $this->host = $consetup->host;
        $this->user = $consetup->user;
        $this->pass =  $consetup->pass;
        $this->db = $consetup->db;
    }
    // open mysql data base
    public function open_db()
    {
        $this->condb=new mysqli($this->host,$this->user,$this->pass,$this->db);
        if ($this->condb->connect_error)
        {
            die("Erron in connection: " . $this->condb->connect_error);
        }
    }
    // close database
    public function close_db()
    {
        $this->condb->close();
    }
    // // insert record
    // public function insertRecord($obj){ }
    //     //update record
    // public function updateRecord($obj){ }
    //      // delete record
    // public function deleteRecord($id){ }
         // select record
    




    // select record     
		public function selectRecord($Prod_id)
		{
			try
			{
                $this->open_db();
                if($Prod_id>0)
				{	
					$query=$this->condb->prepare("SELECT * FROM product WHERE Prod_id=?");
					$query->bind_param("i",$Prod_id);
				}
                else
                {$query=$this->condb->prepare("SELECT * FROM product");	}		
				
				$query->execute();
				$res=$query->get_result();	
				$query->close();				
				$this->close_db();                
                return $res;
			}
			catch(Exception $e)
			{
				$this->close_db();
				throw $e; 	
			}
			
		}


    //display wishlist
        public function selectWishlistRecord($User_name)
		{
			try
			{
                $this->open_db();
                //if($User_name!= )
                if(TRUE)
				{	
					$query=$this->condb->prepare("SELECT
                    cw.Wishlist_id,
                    cw.Description as wishlist_description,
                    p.Prod_id,
                    p.Description as product_description,
                    p.Vendor,
                    p.URL
                FROM
                    `customer_wishlist` cw
                INNER JOIN `wishlist` w ON
                    cw.Wishlist_id = w.Wishlist_id
                INNER JOIN `product` p ON
                    w.Prod_id = p.Prod_id
                WHERE
                    user_name = ?
                ORDER BY
                    cw.Wishlist_id ASC;
                ");
					$query->bind_param("s",$User_name);
				}
                else
                {
                    echo "Error showing wishlist";
                }		
				
				$query->execute();
				$res=$query->get_result();	
				$query->close();				
				$this->close_db();                
                return $res;
			}
			catch(Exception $e)
			{
				$this->close_db();
				throw $e; 	
			}
			
		}

        public function TrackByHourAllRecord($Prod_id)
        {
            try
			{
                $this->open_db();
                //if($User_name!= )
                $Prod_id=1;
                if(TRUE)
				{	
				$query=$this->condb->prepare('SELECT Date(timestamp) as date, concat( TIME_FORMAT(time(TIMESTAMP),"%H") ," Hr") as time , price
                FROM
                    `price_tracker`
                WHERE
                    Prod_id = ?
                ORDER BY
                    TIMESTAMP
                DESC
                LIMIT 10;
                ');
					$query->bind_param("i",$Prod_id);
				}
                else
                {
                    echo "Error showing price track by hour";
                }		
				
				$query->execute();
				$res=$query->get_result();	
				$query->close();				
				$this->close_db();                
                return $res;
			}
			catch(Exception $e)
			{
				$this->close_db();
				throw $e; 	
			}


        }

        public function TrackByDayAllRecord($Prod_id)
        {
            try
			{
                $this->open_db();
                $Prod_id=1;
                //if($User_name!= )
                if(TRUE)
				{	
				$query=$this->condb->prepare('SELECT
                DATE(TIMESTAMP) AS Date,
                MIN(price) AS Min_price,
                MAX(price) AS Max_price
            FROM
                `price_tracker`
            WHERE
                Prod_id = ?
            GROUP BY
                prod_id,
                DATE(TIMESTAMP)
            ORDER BY
                TIMESTAMP
            DESC
            LIMIT 10
            
                ');
					$query->bind_param("i",$Prod_id);
				}
                else
                {
                    echo "Error showing price track by day";
                }		
				
				$query->execute();
				$res=$query->get_result();	
				$query->close();				
				$this->close_db();                
                return $res;
			}
			catch(Exception $e)
			{
				$this->close_db();
				throw $e; 	
			}


        }

    }

?>