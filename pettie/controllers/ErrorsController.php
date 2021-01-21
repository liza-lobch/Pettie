<?php

	class ErrorsController 
	{
		public function index() {
			$title = 'Ошибка!';					
			
			include_once('./views/error/index.php');
		}
	}