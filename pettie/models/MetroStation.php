<?php

	class MetroStation 
	{
		public function getAll() {
			$db = DB::connect();
			$query = (new Select('metro_stations'))
                        ->where("WHERE `metro_station_is_deleted` = 0")
                        ->orderBy('metro_station_name', 'ASC')
                        ->build();
			$result = $db->query($query); 
			$metro_stations = $result->fetchAll();
			return $metro_stations;
		}
	}