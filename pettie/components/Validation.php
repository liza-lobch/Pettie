<?php

	class Validation 
	{
		public function checkLength($str, $length = 2) {
			return strlen($str) >= $length; 
		}

		public function checkIfRegExp($str, $reg) {
			return preg_match(); 
		}

		public function checkNumber($number, $maxNumber, $minNumber) {
			return ($minNumber <= $number) && ($number <= $maxNumber); 
		}
        
        public function checkName($str) {
			return preg_match('~^[a-zA-Zа-яА-ЯёЁ0-9]+$~', $str);  
		}
        
        public function checkPhoneNumber($str) {
			return preg_match('~^\+7\s\((\d{3})\)\s(?1)-(\d{2})-(?2)$~', $str);  
		}
        
        public function checkEmail($str) {
			return preg_match('~^[a-z0-9]([a-z0-9_\-\.]){3,29}@(?1)+\.(?1){2,10}$~', $str);  
		}

	}