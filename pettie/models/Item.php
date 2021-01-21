<?php

	class Item 
	{
		public function getAll($quantity = 12, $list=0) { 
			$db = DB::connect();
			$query = (new Select('items'))
						->joins([['LEFT', 'units', 'item_unit_id', 'unit_id'], ['LEFT', 'manufacturers', 'item_manufacturer_id', 'manufacturer_id'], ['LEFT', 'categories', 'item_category_id', 'category_id'], ['LEFT', 'animal_types', 'item_animal_type_id', 'animal_type_id']])            
						->where('WHERE `item_is_deleted` = 0')
                        ->orderBy('item_animal_type_id, item_category_id, item_name', 'ASC')
                        ->limit($quantity, $list)
						->build(); 
            //var_dump($query);
			$result = $db->query($query); 
			$items = $result->fetchAll();
			return $items;
		}

		public function getItemById($id) {
			$db = DB::connect();
			$query = (new Select('items'))
                        ->joins([['LEFT', 'units', 'item_unit_id', 'unit_id'], ['LEFT', 'manufacturers', 'item_manufacturer_id', 'manufacturer_id'], ['LEFT', 'categories', 'item_category_id', 'category_id'], ['LEFT', 'animal_types', 'item_animal_type_id', 'animal_type_id']])
						->where("WHERE `item_id` = $id AND `item_is_deleted` = '0'")
						->build(); 
            //var_dump($query);
			$result = $db->query($query);
			$item = $result->fetch();
			return $item;
		}
        
        public function addItem($item) {
			$db = DB::connect();
            $query = (new Insert('items'))
                        ->set(['item_name' => "$item[item_name]", 
				   	           'item_vendor_code' => "$item[item_vendor_code]",                      
				   	           'item_unit_id' => "$item[item_unit]",
                               'item_unit_count' => "$item[item_unit_count]",
                               'item_count' => "$item[item_count]",
                               'item_manufacturer_id' => "$item[item_manufacturer]",
                               'item_animal_type_id' => "$item[item_animal_type]",
					           'item_category_id' => "$item[item_category]",
                               'item_structure' => "$item[item_structure]",
					           'item_desc' => "$item[item_desc]",
					           'item_price' => "$item[item_price]",
                               'item_img_preview' => "$item[item_img_preview]",
                               'item_img_main' => "$item[item_img_main]" ])
                        ->build();          
            //var_dump($query);
            //exit();
			$db->query($query);
			return;
		}
        
        public function checkIfItemExists($item_name) {
			$db = DB::connect();
			$query = (new Select('items'))
                        ->what(['count' => 'count(*)'])
                        ->where("WHERE `item_name` = '$item_name'")
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
        
        public function checkIfItemExistsForUpdate($item_name, $item_id) {
			$db = DB::connect();
			$query = (new Select('items'))
                        ->what(['count' => 'count(*)'])
                        ->where("WHERE `item_name` = '$item_name' AND `item_id` != $item_id")
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

		public function updateItem($item) {
			$db = DB::connect();
			// TODO: make Update, Insert and Delete 
			$query = (new Update('items'))
                    ->set(['item_name' => "$item[item_name]", 
                           'item_vendor_code' => "$item[item_vendor_code]",               
				   	       'item_unit_id' => "$item[item_unit]",
                           'item_unit_count' => "$item[item_unit_count]",
					       'item_count' => "$item[item_count]",
                           'item_manufacturer_id' => "$item[item_manufacturer]",
                           'item_animal_type_id' => "$item[item_animal_type]",
					       'item_category_id' => "$item[item_category]",
                           'item_structure' => "$item[item_structure]",
                           'item_desc' => "$item[item_desc]",
					       'item_price' => "$item[item_price]"])
                    ->where("WHERE `item_id` = $item[item_id]")
                    ->build();
            //var_dump($query);
			$db->query($query);
			return;
		}

		public function deleteItemById($id) {
			$db = DB::connect();
			$query = (new Update('items'))
                        ->set(['item_is_deleted' => 1])
                        ->where("WHERE `item_id` = $id")
                        ->build();         
			$db->query($query);
			return;
		}

		public function getItemListForOrder($idList = []) {
			$db = DB::connect();
			$ids = implode(', ', $idList);
			$query = (new Select('items'))
						->where("WHERE `item_id` IN ($ids)")
						->build();
			$result = $db->query($query); 
			$items = $result->fetchAll();
			return $items;
		}  
        
        public function getAllInAnimalType($animal_type, $quantity = 12, $list=0) { 
			$db = DB::connect();
			$query = (new Select('items'))
						->joins([['LEFT', 'units', 'item_unit_id', 'unit_id'], ['LEFT', 'manufacturers', 'item_manufacturer_id', 'manufacturer_id'], ['LEFT', 'categories', 'item_category_id', 'category_id'], ['LEFT', 'animal_types', 'item_animal_type_id', 'animal_type_id']])            
						->where("WHERE `item_is_deleted` = 0 AND animal_type_name = '$animal_type'")
                        ->orderBy('item_category_id, item_name', 'ASC')
                        ->limit($quantity, $list)
						->build(); 
            //var_dump($query);
			$result = $db->query($query); 
			$items = $result->fetchAll();
			return $items;
		}
        
        public function getAllInAnimalTypeCategory($animal_type, $category_name, $quantity = 12, $list=0) { 
			$db = DB::connect();
			$query = (new Select('items'))
						->joins([['LEFT', 'units', 'item_unit_id', 'unit_id'], ['LEFT', 'manufacturers', 'item_manufacturer_id', 'manufacturer_id'], ['LEFT', 'categories', 'item_category_id', 'category_id'], ['LEFT', 'animal_types', 'item_animal_type_id', 'animal_type_id']])            
						->where("WHERE `item_is_deleted` = 0 AND `animal_type_name` = '$animal_type' AND `category_name` = '$category_name'")
                        ->orderBy('item_name', 'ASC')
                        ->limit($quantity, $list)
						->build(); 
            //var_dump($query);
			$result = $db->query($query); 
			$items = $result->fetchAll();
			return $items;
		}
        
        public function searchItems($search_str) { 
			$db = DB::connect();
			$query = (new Select('items'))
						->joins([['LEFT', 'units', 'item_unit_id', 'unit_id'], ['LEFT', 'manufacturers', 'item_manufacturer_id', 'manufacturer_id'], ['LEFT', 'categories', 'item_category_id', 'category_id'], ['LEFT', 'animal_types', 'item_animal_type_id', 'animal_type_id']])            
						->where("WHERE `item_is_deleted` = 0 AND `item_name` LIKE '%$search_str%'")
						->build(); 
            //var_dump($query);
			$result = $db->query($query); 
			$items = $result->fetchAll();
			return $items;
		}
        
        public function getItemsCount() { 
			$db = DB::connect();
			$query = (new Select('items'))
						->what(['count' => 'count(*)'])            
						->where('WHERE `item_is_deleted` = 0')
						->build(); 
            //var_dump($query);
			$result = $db->query($query); 
			$itemsCount = $result->fetch();
			return $itemsCount['count'];
		}
        
        public function getItemsCountByAnimalType($animal_type) { 
			$db = DB::connect();
			$query = (new Select('items'))
						->what(['count' => 'count(*)'])     
                        ->joins([['LEFT', 'units', 'item_unit_id', 'unit_id'], ['LEFT', 'manufacturers', 'item_manufacturer_id', 'manufacturer_id'], ['LEFT', 'categories', 'item_category_id', 'category_id'], ['LEFT', 'animal_types', 'item_animal_type_id', 'animal_type_id']]) 
						->where("WHERE `item_is_deleted` = 0 AND animal_type_name = '$animal_type'")
						->build(); 
            //var_dump($query);
			$result = $db->query($query); 
			$itemsCount = $result->fetch();
			return $itemsCount['count'];
		}
        
        public function getItemsCountByAnimalTypeAndCategory($animal_type, $category_name) { 
			$db = DB::connect();
			$query = (new Select('items'))
						->what(['count' => 'count(*)'])     
                        ->joins([['LEFT', 'units', 'item_unit_id', 'unit_id'], ['LEFT', 'manufacturers', 'item_manufacturer_id', 'manufacturer_id'], ['LEFT', 'categories', 'item_category_id', 'category_id'], ['LEFT', 'animal_types', 'item_animal_type_id', 'animal_type_id']]) 
						->where("WHERE `item_is_deleted` = 0 AND `animal_type_name` = '$animal_type' AND `category_name` = '$category_name'")
						->build(); 
            //var_dump($query);
			$result = $db->query($query); 
			$itemsCount = $result->fetch();
			return $itemsCount['count'];
		}
}