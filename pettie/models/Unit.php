<?php

	class Unit 
	{
		public function getAll() {
			$db = DB::connect();
			$query = $query = (new Select('units'))
                        ->where("WHERE `unit_is_deleted` = 0")
                        ->orderBy('unit_name', 'ASC')
                        ->build();
			$result = $db->query($query); 
			$units = $result->fetchAll();
			return $units;
		}
	}