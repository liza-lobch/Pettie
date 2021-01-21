<?php

	class Cart
	{
		public function addNewOrder($cart, $orderInfo) {
			$db = DB::connect();
			$query = (new Insert('orders'))
                ->set(['order_info' => "$orderInfo"])
                ->build();
			$result = $db->query($query);
			$orderId = $db->lastInsertId();
			// $this->fullAuthorizedUser($userId);

			$cartsInfo = ""; 
			foreach ($cart as $item_id => $item_count) {
				$cartsInfo .= "($item_id, $orderId, $item_count), ";
			}
			$cartsInfo = rtrim($cartsInfo, ', ');
			$query = "
				INSERT INTO `carts` (cart_item_id, cart_order_id, cart_item_count)
					VALUES $cartsInfo;
			";
			$db->query($query);
			return;
		}
        
        public function getOrdersId() { 
			$db = DB::connect();
			$query = (new Select('orders'))
                        ->what(['order_id', 'order_is_done'])
                        ->orderBy('order_id', 'DESC')
						->build(); 
            //var_dump($query);
			$result = $db->query($query); 
			$orders_id = $result->fetchAll();
			return $orders_id;
		}
        
        public function updateOrderStatus($id, $order_status) {
			$db = DB::connect();
			$query = (new Update('orders'))
                        ->set(['order_is_done' => $order_status])
                        ->where("WHERE `order_id` = $id")
                        ->build();         
			$db->query($query);
			return;
		}
        
        public function getOrderInfoById($id) {
			$db = DB::connect();
			$query = (new Select('carts'))
                        ->joins([['LEFT', 'orders', 'cart_order_id', 'order_id'], ['LEFT', 'items', 'cart_item_id', 'item_id']])
						->where("WHERE `order_id` = $id")
						->build(); 
            //var_dump($query);
			$result = $db->query($query);
			$orderInfo = $result->fetchAll();
			return $orderInfo;
		}
	}