<?php

	class Helper 
	{
		public function escape($str) {
			return htmlentities($str);
		}
		
		public function generateToken($length = 32) {
			$symbols = ['a', 'b', 'c', 'd', 'e', 'f', 0, 1, 2, 3, 4, 5, 6, 7, 8, 9]; 
			$symbolsLength = count($symbols);
			$token = ""; 
			for ($i = 0; $i < $length; $i++) {
				$token .= $symbols[rand(0, $symbolsLength - 1)];
			}
			return $token;
		}
	}