<?php

	class AddressesController 
	{
		public function index() {
            $title = 'Адреса магазинов';
            $h1 = 'Адреса магазинов';
            $addressModel = new Address();
			$addresses = $addressModel->getAll();
            //echo '<pre>';
            //print_r($items);
            //echo '</pre>';
            include_once('./views/addresses/index.php');
            return;
        }
        
        public function add() {
            $title = 'Добавление адреса магазина';          
            
            if (isset($_POST['address_name'])) {
                $helper = new Helper();
                $address_name = $helper->escape($_POST['address_name']); 
                $address_metro_station = $_POST['metro_station'];
                $address_phone = $helper->escape($_POST['address_phone']); 
                $address_work_time = $helper->escape($_POST['work_time']); 

                $validation = new Validation(); 
                $errors = array();

                if (!$validation->checkLength($address_name)) {
                    $errors[] = 'Количество символов для адреса не должно быть меньше 2'; 
                }
                if (!$validation->checkLength($address_phone)) {
                    $errors[] = 'Количество символов для телефона не должно быть меньше 2'; 
                }
                if (!$validation->checkLength($address_work_time)) {
                    $errors[] = 'Количество символов для рабочего времени не должно быть меньше 2'; 
                }
                
                $address = new Address();
				if ($address->checkIfAddressExists($address_name)) {
					$errors[] = 'Такой адрес магазина уже есть!';
				}

                if (empty($errors)) {
                    $addressModel = new Address();
                    $shop_address = array(
                        'address_name' => $address_name,
                        'address_phone' => $address_phone,
                        'work_time' => $address_work_time,
                        'metro_station' => $address_metro_station
                    );
                    $addressModel->addAddress($shop_address);
                    
                    header('Location: ' . SITE_ROOT . 'addresses/list');
                }					
            } 
            
            $metro_stationModel = new MetroStation(); 
            $metro_stations = $metro_stationModel->getAll();
            
            //echo "<pre>";
            //var_dump($item_img_preview);
            //echo "</pre>";
            
            include_once('./views/addresses/add.php');
			return;
        } 
        
        public function edit($parameters = []) {
            $title = 'Редактирование адреса';
			$id = $parameters[0]; 
			if (!$id) {
				echo 'Некорректный id'; 
                exit();
			} else {
                if (isset($_POST['address_name'])) {
                    $helper = new Helper();
                    $address_name = $helper->escape($_POST['address_name']); 
                    $address_metro_station = $_POST['metro_station'];
                    $address_phone = $helper->escape($_POST['address_phone']); 
                    $address_work_time = $helper->escape($_POST['work_time']);
                    
                    $validation = new Validation(); 
					$errors = array();
                    
                    if (!$validation->checkLength($address_name)) {
                    $errors[] = 'Количество символов для адреса не должно быть меньше 2'; 
                    }
                    if (!$validation->checkLength($address_phone)) {
                        $errors[] = 'Количество символов для телефона не должно быть меньше 2'; 
                    }
                    if (!$validation->checkLength($address_work_time)) {
                        $errors[] = 'Количество символов для рабочего времени не должно быть меньше 2'; 
                    }                                 
                    
                    if (empty($errors)) {
						$addressModel = new Address();
						$shop_address = array(
							'address_name' => $address_name,
                            'address_phone' => $address_phone,
                            'work_time' => $address_work_time,
                            'metro_station' => $address_metro_station,
							'address_id' => $id
						);
						$addressModel->updateAddress($shop_address);
                       
						header('Location: ' . SITE_ROOT . 'addresses/list');
					}
                }
                
				$addressModel = new Address();
				$address = $addressModel->getAddressById($id); 
                
                $metro_stationModel = new MetroStation(); 
				$metro_stations = $metro_stationModel->getAll();
                
                
                if (empty($address)) {
                    // лучше переводить на 404 страницу
					echo 'Адреса с таким id не существует'; 
					exit();
				}
                
                include_once('./views/addresses/edit.php');
			}
			return; 
		}
        
        public function delete($parameters = []) {
			$id = $parameters[0];
			if (!$id) {
				return;
			}
			$addressModel = new Address();            
			$addressModel->deleteAddressById($id);
			header('Location: ' . SITE_ROOT . 'addresses/list');
		}
    }