<?php

	class Manufacturer 
	{
		public function getAll() {
			$db = DB::connect();
			$query = (new Select('manufacturers'))
                        ->where("WHERE `manufacturer_is_deleted` = 0")
                        ->orderBy('manufacturer_name', 'ASC')
                        ->build();
			$result = $db->query($query); 
			$manufacturers = $result->fetchAll();
			return $manufacturers;
		}
	}