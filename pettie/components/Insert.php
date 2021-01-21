<?php

	class Insert
	{
		private $into; 
		private $set = '';

		public function __construct($into) {
			$this->into = $into; 
			return $this;
		}

		public function set($data) {
			if (empty($data)) {
				echo 'Необходимо передать данные в функцию set';
				exit();
			}
			$set = "";
			foreach ($data as $key => $value) {
					$set .= "`$key` = '$value', ";
			}
			$set = rtrim($set, ', ');
			$this->set = $set; 
			return $this;
		}

		public function build() {
			$query = "
				INSERT INTO $this->into
                SET	$this->set;
			"; 
			return $query;
		}
	}
