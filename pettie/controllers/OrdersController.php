<?php

	class OrdersController
	{
		public function add() {
			$cartString = isset($_COOKIE['cart']) ? $_COOKIE['cart'] : ""; 
			if ($cartString !== "") {
				$cart = json_decode($cartString, true);				
			} else {
				header('Location: ' . SITE_ROOT . 'items/list');
			}
		}
        
        public function orders() {
            $title = 'Заказы';
            $h1 = 'Заказы';
            $cartModel = new Cart();
			$orders = $cartModel->getOrdersId();
            //echo '<pre>';
            //print_r($items);
            //echo '</pre>';
            include_once('./views/carts/orders.php');
            return;
		}
        
        public function update($parameters = []) {
			$id = $parameters[0];
			$order_status = $parameters[1];
			if (!$id || !$order_status) {
				return;
			}
			$cartModel = new Cart();
			$cartModel->updateOrderStatus($id, $order_status);
			header('Location: ' . SITE_ROOT . 'orders');
		}
        
        public function view($parameters = []) {
            $title = 'Просмотр деталей заказа';
			$id = $parameters[0]; 
			if (!$id) {
				echo 'Некорректный id'; 
			} else {
                $cartModel = new Cart();
                $order = $cartModel->getOrderInfoById($id);	   
                
                if (empty($order)) {
                    call_user_func(array("ErrorsController", "index"), "error");
					exit();
				}
                include_once('./views/carts/view.php');
			}
			return; 
		} 
	}