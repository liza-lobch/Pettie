<?php

	class User 
	{
		public function checkIfLoginExists($login) {
			$db = DB::connect();
			$query = "
                SELECT count(*) AS `count`
                FROM `users`
                WHERE `user_login` = '$login';
            ";
			$result = $db->query($query);
			$count = $result->fetch();
			if ($count['count'] == 1) {
				return true; 
			} else {
				return false;
			}
		}

		public function register($user) {
			$db = DB::connect();
            $hasheadPassword = md5($user['user_password']);
			$query = "
                INSERT INTO `users`
                SET `user_login` = '$user[user_login]',
                    `user_password` = '$hasheadPassword';
            ";
            //echo $query;
            //exit();
			$result = $db->query($query);
			$userId = $db->lastInsertId();
			//return $userId;
            $this->fullAuthorizedUser($userId);
		}

		public function checkIfLoginAndPasswordExists($login, $password) {
			$db = DB::connect();
			$hashedPassword = md5($password);
			$query = (new Select('users'))
						->what(['count' => 'count(*)'])
						->where("WHERE user_login = '$login' AND user_password = '$hashedPassword'")
						->build();
			$result = $db->query($query);
			$count = $result->fetch();
			if ($count['count'] == 1) {
				return true;
			} else {
				return false;
			}
		}

		public function auth($login) {
			$userId = $this->getUserIdByLogin($login);
			if ($userId !== 0) {
				$this->fullAuthorizedUser($userId);
			}
		}

		public function getUserIdByLogin($login) {
			$db = DB::connect();
			$query = (new Select('users'))
						->what(['user_id'])
						->where("WHERE user_login = '$login'")
						->build();
			$result = $db->query($query);
			$userInfo = $result->fetch();
			return isset($userInfo['user_id']) ? $userInfo['user_id'] : 0;
		}

		private function fullAuthorizedUser($userId) {
			session_start();
			$helper = new Helper();
			$token = $helper->generateToken();
			$tokenTime = time() + 60*60; // время жизни токена - 60 минут
			setcookie('token', $token, time() + 2*24*60*60, '/');
			setcookie('user_id', $userId, time() + 2*24*60*60, '/');
			setcookie('token_time', $tokenTime, time() + 2*24*60*60, '/');
			$db = DB::connect();
			$query = "
				INSERT INTO `connects`
					SET `connect_token` = '$token', 
						`connect_user_id` = $userId,
						`connect_token_time` = FROM_UNIXTIME($tokenTime);
			";
			$db->query($query);
		}

		public static function checkIfUserAuthorized() {
			if (!isset($_COOKIE['token']) || !isset($_COOKIE['user_id']) || !isset($_COOKIE['token_time'])) {
				return false;
			}
			$token = $_COOKIE['token']; 
			$userId = $_COOKIE['user_id'];
			$tokenTime = $_COOKIE['token_time']; 
			$db = DB::connect();
			$query = (new Select('connects'))
						->what(['connect_id'])
						->where("WHERE `connect_token` = '$token' 
								AND `connect_user_id` = $userId 
								AND `connect_token_time` = FROM_UNIXTIME($tokenTime)")
						->build();
			$result = $db->query($query);
			$connectInfo = $result->fetch();
			$connectId = $connectInfo['connect_id']; 
			if ($connectId) {
				if (time() > $tokenTime) {
					$helper = new Helper();
					$newToken = $helper->generateToken();
					$newTokenTime = time() + 60*60; 
					setcookie('token', $newToken, time() + 2*24*60*60, '/');
					setcookie('token_time', $newTokenTime, time() + 2*24*60*60, '/');
					$db = DB::connect();
					$query = "
						UPDATE `connects`
							SET `connect_token` = '$newToken', 
								`connect_token_time` = FROM_UNIXTIME($newTokenTime)
							WHERE `connect_id` = '$connectId';
					";
				}
				return true;
			}
			return false;		
		}

        public function logout($user_id) {
			$db = DB::connect();      
            $query = (new Delete('connects'))
                        ->where("WHERE `connect_user_id` = $user_id")
                        ->build();
            //var_dump($query);
            $result = $db->query($query);                
		}
        
        public static function checkIfUserIsAdmin() {
			$IsUserAuthorized = User::checkIfUserAuthorized();
            $adminId = 1;
            if($IsUserAuthorized) {
                if ($_COOKIE['user_id'] == $adminId) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
            
		}
        
        public function getUserById($id) {
			$db = DB::connect();
			$query = (new Select('users'))
                        ->joins([['LEFT', 'addresses', 'user_address_id', 'address_id']])
						->where("WHERE `user_id` = $id")
						->build(); 
            //var_dump($query);
			$result = $db->query($query);
			$user = $result->fetch();
			return $user;
		}
        
        public static function checkIfUserAddressExists($address) {
			$db = DB::connect();
			$query = "
                SELECT count(*) AS `count`
                FROM `addresses`
                WHERE `address_name` = '$address';
            ";
			$result = $db->query($query);
			$count = $result->fetch();
			if ($count['count'] == 1) {
				return true; 
			} else {
				return false;
			}
		}
        
        public function updateUser($user) {
            $address_id = "";
            $IsAddressExists = User::checkIfUserAddressExists($user[user_address]);
            if(!$IsAddressExists){
                $userModel = new User();
				$userModel->addAddress($user[user_address]);
            }
            $userModel = new User();
			$address_id = $userModel->getAddressIdByName($user[user_address]);
        
			$db = DB::connect();
			$query = (new Update('users'))
                    ->set(['user_first_name' => "$user[user_first_name]", 
                           'user_phone' => "$user[user_phone]", 
                           'user_address_id' => "$address_id",               
				   	       'user_email' => "$user[user_email]" ])
                    ->where("WHERE `user_id` = $user[user_id]")
                    ->build();
            //var_dump($query);
			$db->query($query);
			return;
		}
        
        public function addAddress($address) {
			$db = DB::connect();
            $query = (new Insert('addresses'))
                        ->set(['address_name' => "$address" ])
                        ->build();          
            //var_dump($query);
            //exit();
			$db->query($query);
			return;
		}
        
        public function getAddressIdByName($address) {
			$db = DB::connect();
			$query = (new Select('addresses'))
						->what(['address_id'])
						->where("WHERE address_name = '$address'")
						->build();
			$result = $db->query($query);
			$addressInfo = $result->fetch();
			return $addressInfo['address_id'];
		}
        
        public function getUsers() { 
			$db = DB::connect();
			$query = (new Select('users'))
						->joins([['LEFT', 'addresses', 'user_address_id', 'address_id']])            
                        ->orderBy('user_first_name, user_login', 'ASC')
						->build(); 
            //var_dump($query);
			$result = $db->query($query); 
			$users = $result->fetchAll();
			return $users;
		}
    }