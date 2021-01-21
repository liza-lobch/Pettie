<?php
	
	class UsersController
	{
		public function reg() {

			$title = 'Регистрация';
			
			if (isset($_POST['user_login'])) {
				$helper = new Helper();
				$user_login = $helper->escape($_POST['user_login']); 
				$user_password = $helper->escape($_POST['user_password']); 
				$user_password_repeat = $helper->escape($_POST['user_password_repeat']);                           
                
                $validation = new Validation();
				$errors = array();
                
                if (!$validation->checkLength($user_login)) {
                    $errors[] = 'Количество символов для логина не должно быть меньше 2.'; 
                }
                if (!$validation->checkLength($user_password, 6)) {
                    $errors[] = 'Количество символов для пароля не должно быть меньше 6.'; 
                }             

				if ($user_password != $user_password_repeat) {
					$errors[] = 'Пароли не совпадают'; 
				}
                
                if (!isset($_POST['user_agreement'])) {
					$errors[] = 'Для продолжения нужно согласие на обработку персональных данных!'; 
				}

				$user = new User();
				if ($user->checkIfLoginExists($user_login)) {
					$errors[] = 'Такой логин уже существует';
				}

				if (empty($errors)) {
					$userInfo = array(
						'user_login' => $user_login,
						'user_password' => $user_password
					);
					$user->register($userInfo);
					header('Location: ' . SITE_ROOT . 'items/list');
				}
			}

			include_once('./views/users/reg.php');

		}

		public function auth() {

			$title = 'Авторизация'; 

			if (isset($_POST['user_login'])) {
				$helper = new Helper();
				$user_login = $helper->escape($_POST['user_login']); 
				$user_password = $helper->escape($_POST['user_password']); 
				$user = new User();
				$errors = array();

				if (!$user->checkIfLoginAndPasswordExists($user_login, $user_password)) {
					$errors[] = 'Неправильный логин или пароль!';
				}

				if (empty($errors)) {
					$user->auth($user_login);
					header('Location: ' . SITE_ROOT . 'items/list');
				}
			}

			include_once('./views/users/auth.php');
		}
        
        public function logout() {
            if (isset($_COOKIE['token'])){
                $user_id = $_COOKIE['user_id'];
                
                $user = new User();
                $user->logout($user_id);
                
                setcookie('token', '', time()-60, '/');
                setcookie('token_time', '', time()-60, '/');
                setcookie('user_id', '', time()-60, '/');
                setcookie('cart', '', time()-60, '/');

                session_destroy();
            }			
            header('Location: ' . SITE_ROOT . 'items/list');
		}
        
        public function ajaxCheckIfLoginExists() {
            if (isset($_GET['login'])) {
                $user_login = $_GET['login'];
                $user = new User();
                echo $user->checkIfLoginExists($user_login);
            }
        }
        
        public function agreement() {
			$title = 'Пользовательское соглашение';
			include_once('./views/users/agreement.php');
		}
        
        public function getUsers() {
            $title = 'Пользователи';
            $h1 = 'Пользователи';
            $userModel = new User();
			$users = $userModel->getUsers();
            //echo '<pre>';
            //print_r($items);
            //echo '</pre>';
            include_once('./views/users/users.php');
            return;
        }
	}
