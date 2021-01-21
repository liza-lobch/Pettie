<?php

	class MainPageController 
	{
		public function index() {
			$title = 'Главная';
            include_once('./views/main/index.php');
            return;
		}
	}