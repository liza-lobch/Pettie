<?php

	class Delete
	{
		private $from; 
        private $where = '';
        private $orderBy = '';
        private $limit = '';        

		public function __construct($from) {
			$this->from = $from; 
			return $this;
		}
        
        public function where($where) {
			$this->where = $where;
			return $this;
		}
        
        public function orderBy($field, $type = 'DESC') {
			$this->orderBy = "ORDER BY $field $type"; 
			return $this;
		}
        
        public function limit($limit, $offset = 0) {
			$this->limit = "LIMIT $offset, $limit";
			return $this;
		}    

		public function build() {
			$query = "
				DELETE FROM $this->from
                $this->where
                $this->orderBy
                $this->limit;
			"; 
			return $query;
		}
	}
