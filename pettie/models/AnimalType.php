<?php

	class AnimalType 
	{

		public function getAll() {
			$db = DB::connect();
			$query = (new Select('animal_types'))
                        ->where("WHERE `animal_type_is_deleted` = 0")
                        ->orderBy('animal_type_name', 'ASC')
                        ->build();
			$result = $db->query($query); 
			$animal_types = $result->fetchAll();
			return $animal_types;
		}
	}