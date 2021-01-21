<?php

	class Update
	{
		private $into; 
		private $set = '';
        private $where = '';
        private $limit = '';

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
        
        public function where($where) {
			$this->where = $where;
			return $this;
		}
        
        public function limit($limit, $offset = 0) {
			$this->limit = "LIMIT $offset, $limit";
			return $this;
		}    

		public function build() {
			$query = "
				UPDATE $this->into
                SET	$this->set
                $this->where
                $this->limit;
			"; 
			return $query;
		}
	}
