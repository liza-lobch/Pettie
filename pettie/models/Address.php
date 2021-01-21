<?php

	class Address 
	{
		public function getAll() { 
			$db = DB::connect();
			$query = (new Select('shop_addresses'))
						->joins([['LEFT', 'metro_stations', 'shop_address_metro_station_id', 'metro_station_id']])            
						->where('WHERE `shop_address_is_deleted` = 0')
                        ->orderBy('metro_station_name', 'ASC')
						->build(); 
            //var_dump($query);
			$result = $db->query($query); 
			$addresses = $result->fetchAll();
			return $addresses;
		}
        
        public function addAddress($shop_address) {
			$db = DB::connect();
            $query = (new Insert('shop_addresses'))
                        ->set(['shop_address_name' => "$shop_address[address_name]", 
				   	           'shop_address_phone' => "$shop_address[address_phone]",                      
				   	           'shop_address_work_time' => "$shop_address[work_time]",
                               'shop_address_metro_station_id' => "$shop_address[metro_station]" ])
                        ->build();          
            //var_dump($query);
            //exit();
			$db->query($query);
			return;
		}
        
        public function updateAddress($shop_address) {
			$db = DB::connect();
			$query = (new Update('shop_addresses'))
                    ->set(['shop_address_name' => "$shop_address[address_name]", 
                           'shop_address_phone' => "$shop_address[address_phone]",               
				   	       'shop_address_work_time' => "$shop_address[work_time]",
                           'shop_address_metro_station_id' => "$shop_address[metro_station]" ])
                    ->where("WHERE `shop_address_id` = $shop_address[address_id]")
                    ->build();
            //var_dump($query);
			$db->query($query);
			return;
		}
        
        public function checkIfAddressExists($address_name) {
			$db = DB::connect();
			$query = (new Select('shop_addresses'))
                        ->what(['count' => 'count(*)'])
                        ->where("WHERE `shop_address_name` = '$address_name'")
                        ->build();
                
            //var_dump($query);
			$result = $db->query($query);
			$count = $result->fetch();
			if ($count['count'] == 1) {
				return true; 
			} else {
				return false;
			}
		}
        
        public function deleteAddressById($id) {
			$db = DB::connect();
			$query = (new Update('shop_addresses'))
                        ->set(['shop_address_is_deleted' => 1])
                        ->where("WHERE `shop_address_id` = $id")
                        ->build();         
			$db->query($query);
			return;
		}
        
        public function getAddressById($id) {
			$db = DB::connect();
			$query = (new Select('shop_addresses'))
                        ->joins([['LEFT', 'metro_stations', 'shop_address_metro_station_id', 'metro_station_id']])  
						->where("WHERE `shop_address_id` = $id AND `shop_address_is_deleted` = '0'")
						->build(); 
            //var_dump($query);
			$result = $db->query($query);
			$address = $result->fetch();
			return $address;
		}
    }
