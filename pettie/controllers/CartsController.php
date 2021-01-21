<?php

	class CartsController 
	{
		public function index() {
			$title = 'Корзина';
            $cartString = isset($_COOKIE['cart']) ? $_COOKIE['cart'] : "";
            if ($cartString !== "") {
				$cart = json_decode($cartString, true);
				
				$itemIdList = array_keys($cart);
				$itemModel = new Item();
				$itemList = $itemModel->getItemListForOrder($itemIdList);
			}
			include_once('./views/carts/index.php');
		}
        
        public function ordering() {
			$title = 'Оформление заказа';
			$cartString = isset($_COOKIE['cart']) ? $_COOKIE['cart'] : ""; 
			if ($cartString !== "") {
				$cart = json_decode($cartString, true);
				if (isset($_POST['user_name'])) {
					$helper = new Helper();
					$user_name = $helper->escape($_POST['user_name']); 
					$user_phone = $helper->escape($_POST['user_phone']); 
					$user_address = $helper->escape($_POST['user_address']); 
					$user_email = $helper->escape($_POST['user_email']);
                    
					// TODO: check validation for user field()
                    $validation = new Validation(); 
					$errors = array();
                    
                    ///////
                    if (!$validation->checkLength($user_name)) {
						$errors[] = 'Количество символов для имени не должно быть меньше 2'; 
					}
                    if (!$validation->checkLength($user_address)) {
						$errors[] = 'Количество символов для адреса не должно быть меньше 2'; 
					}
					if (!$validation->checkPhoneNumber($user_phone)) {
						$errors[] = 'Формат телефона должен быть следующим: "+7 (123) 456-78-90"'; 
					}                    
                    if (!$validation->checkEmail($user_email)) {
						$errors[] = 'Некорректный email. Попробуйте ввести еще раз.'; 
					}
                    if (!isset($_POST['user_agreement'])) {
                        $errors[] = 'Для продолжения нужно согласие на обработку персональных данных'; 
                    }
                    
                    if (empty($errors)) {
                        $orderInfo = "время: ". date('d.m.Y',time()) . ", имя: $user_name, телефон: $user_phone, адрес: $user_address, email: $user_email";
                        $cartModel = new Cart();
                        $cartModel->addNewOrder($cart, $orderInfo); 
                        setcookie('cart', '', 1, '/');
                        
                        
                        if (User::checkIfUserAuthorized()){
                            if (isset($_COOKIE['user_id'])){
                                $userId = $_COOKIE['user_id'];
                                $userModel = new User();
                                $user = array(
                                    'user_id' => $userId,
                                    'user_first_name' => $user_name,
                                    'user_phone' => $user_phone,
                                    'user_address' => $user_address,
                                    'user_email' => $user_email
                                );
                                $userModel->updateUser($user);
                            }
                        }
                        
                        header('Location: ' . SITE_ROOT . 'cart/success');
                    }      
				}
				
				$itemIdList = array_keys($cart);
				$itemModel = new Item();
				$itemList = $itemModel->getItemListForOrder($itemIdList);
                
                if (User::checkIfUserAuthorized()){
                    if (isset($_COOKIE['user_id'])){
                        $userId = $_COOKIE['user_id'];
                        $user = new User();
                        $userInfo = $user->getUserById($userId);
                    }
                }				
			}			
			
			include_once('./views/carts/ordering.php');
		}
        
        public function success() {
			$title = 'Заказ оформлен';
			include_once('./views/carts/success.php');
		}
	}
