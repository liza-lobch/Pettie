<?php

	class ClubProxyController
	{
		private $controller; 

		public function __construct() {
			$this->controller = new ClubController();
		}

		public function add() {
			if (User::checkIfUserAuthorized()) {
				$this->controller->add();
			} else {
				echo "У вас нет прав";
				return;
			}
		}

		public function edit($parameters = []) {
			if (User::checkIfUserAuthorized()) {
				$this->controller->edit($parameters);
			} else {
				echo "У вас нет прав";
				return;
			}
		}

		public function delete($parameters = []) {
			if (User::checkIfUserAuthorized()) {
				$this->controller->delete($parameters);
			} else {
				echo "У вас нет прав";
				return;
			}
		}

	}