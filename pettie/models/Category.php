<?php

	class Category 
	{

		public function getAll() {
			$db = DB::connect();
			$query = (new Select('categories'))
                        ->where("WHERE `category_is_deleted` = 0")
                        ->orderBy('category_name', 'ASC')
                        ->build();
			$result = $db->query($query); 
			$categories = $result->fetchAll();
			return $categories;
		}
	}