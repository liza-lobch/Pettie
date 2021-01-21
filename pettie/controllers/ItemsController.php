<?php

	class ItemsController 
	{
		public function index($parameters = []) {
            
            $title = 'Товары для животных';
            $h1 = 'Товары для животных';
            
            ///////
            $page = $parameters[0];

            if(!is_numeric($page)) $page=1;
            if ($page<1) $page=1;
                
            $quantity=12;
            $limit=3;
            
            $itemModel = new Item();
            $itemsCount = $itemModel->getItemsCount();
            $pages = $itemsCount/$quantity;
            $pages = ceil($pages);
            if ($page>$pages) $page = 1;
            if (!isset($list)) $list=0;
            $list=($page-1)*$quantity;  

            $itemModel = new Item();
			$items = $itemModel->getAll($quantity, $list);
            
            $path = SITE_ROOT . "items";

            include_once('./views/items/index.php');
            return;
        }
					
		public function view($parameters = []) {
            $title = 'Просмотр товара';
			$id = $parameters[0]; 
			if (!$id) {
				echo 'Некорректный id'; 
			} else {
				$itemModel = new Item();
				$item = $itemModel->getItemById($id); 	
                //echo '<pre>';
                //print_r($item);
                //echo '</pre>';
				// echo "Вызван action view с параметром id = $id";              
                if (empty($item)) {
					//echo 'Товар с таким id не существует'; 
                    call_user_func(array("ErrorsController", "index"), "error");
					exit();
				}
                include_once('./views/items/view.php');
			}
			return; 
		} 
        
        public function add() {
            $title = 'Добавление товара';
			//echo 'Вызван action add в ItemsController';            
            
            if (isset($_POST['item_name'])) {
                $helper = new Helper();
                $item_name = $helper->escape($_POST['item_name']); 
                $item_vendor_code = $helper->escape($_POST['item_vendor_code']); 
                $item_unit = $_POST['item_unit']; 
                $item_unit_count = $helper->escape($_POST['item_unit_count']); 
                $item_count = $helper->escape($_POST['item_count']); 
                $item_manufacturer = $_POST['item_manufacturer'];
                $item_animal_type = $_POST['item_animal_type'];
                $item_category = $_POST['item_category'];
                $item_structure = $helper->escape($_POST['item_structure']);
                $item_desc = $helper->escape($_POST['item_desc']);                   
                $item_price = $helper->escape($_POST['item_price']);
                $item_img_preview = $_FILES['item_img_preview'];
                $item_img_main = $_FILES['item_img_main'];

                $validation = new Validation(); 
                $errors = array();

                if (!$validation->checkLength($item_name)) {
                    $errors[] = 'Количество символов для названия товара не должно быть меньше 2'; 
                }
                if (!$validation->checkLength($item_vendor_code)) {
                    $errors[] = 'Количество символов для артикула товара не должно быть меньше 2'; 
                }
                if (!$validation->checkNumber($item_price, 99999, 10)) {
                    $errors[] = 'Цена товара не должна превышать 99999 и не должна быть меньше 10'; 
                }
                if (!$validation->checkNumber($item_unit_count, 99999, 1)) {
                    $errors[] = 'Объем товара не может превышать 99999 и не должен быть меньше 1'; 
                }
                if (!$validation->checkNumber($item_count, 99999, 0)) {
                    $errors[] = 'Количество товара на складе не должно превышать 99999 и не должна быть меньше 0'; 
                } 
                
                if($item_img_preview['name'] == "") {
                    $errors[] = 'Нужно загрузить картинку предпросмотра товара';
                } else {
                    $img_preview_name = $item_img_preview['name'];
                    $img_preview_name_pieces = explode(".", $img_preview_name);
                    $img_preview_name_final = $img_preview_name_pieces[0] . "_" . time() . "." . $img_preview_name_pieces[1];
                }
                    
                if($item_img_main['name'] == ""){
                    $errors[] = 'Нужно загрузить картинку просмотра товара';
                } else {
                    $img_main_name = $item_img_main['name'];
                    $img_main_name_pieces = explode(".", $img_main_name);
                    $img_main_name_final = $img_main_name_pieces[0] . "_" . time() . "." . $img_main_name_pieces[1];
                }
                
                $item = new Item();
				if ($item->checkIfItemExists($item_name)) {
					$errors[] = 'Товар с таким названием уже есть!';
				}

                if (empty($errors)) {
                    $itemModel = new Item();
                    $item = array(
                        'item_name' => $item_name,
                        'item_vendor_code' => $item_vendor_code,
                        'item_unit' => $item_unit,
                        'item_unit_count' => $item_unit_count,
                        'item_count' => $item_count,							 
                        'item_manufacturer' => $item_manufacturer,
                        'item_animal_type' => $item_animal_type,
                        'item_category' => $item_category,
                        'item_structure' => $item_structure,
                        'item_desc' => $item_desc,                           
                        'item_price' => $item_price,
                        'item_img_preview' => $img_preview_name_final,
                        'item_img_main' => $img_main_name_final
                    );
                    $itemModel->addItem($item);
                    
                    //добавление картинки на сервер
                    $dir_for_img_preview = "./assets/img/preview_img";
                    $tmp_name = $item_img_preview['tmp_name'];
                    move_uploaded_file($tmp_name, "$dir_for_img_preview/$img_preview_name_final");
                    
                    $dir_for_img_main = "./assets/img/main_img";
                    $tmp_name = $item_img_main['tmp_name'];
                    move_uploaded_file($tmp_name, "$dir_for_img_main/$img_main_name_final");
                    
                    header('Location: ' . SITE_ROOT . 'items/list');
                }					
            } 
            
            $manufacturerModel = new Manufacturer(); 
            $manufacturers = $manufacturerModel->getAll();

            $categoryModel = new Category(); 
            $categories = $categoryModel->getAll();

            $animal_typeModel = new AnimalType(); 
            $animal_types = $animal_typeModel->getAll();

            $unitModel = new Unit(); 
            $units = $unitModel->getAll(); 
            
            //echo "<pre>";
            //var_dump($item_img_preview);
            //echo "</pre>";
            
            include_once('./views/items/add.php');
			return;
		}        
        
        public function edit($parameters = []) {
            //if(!User::checkIfUserAuthorized()){
            //    echo 'Не достаточно прав для данного действия!';
            //    return;
            //}
            $title = 'Редактирование товара';
			$id = $parameters[0]; 
			if (!$id) {
				echo 'Некорректный id'; 
                exit();
			} else {
                if (isset($_POST['item_name'])) {
                    $helper = new Helper();
                    $item_name = $helper->escape($_POST['item_name']); 
					$item_vendor_code = $helper->escape($_POST['item_vendor_code']); 
                    $item_unit = $_POST['item_unit']; 
                    $item_unit_count = $helper->escape($_POST['item_unit_count']); 
                    $item_count = $helper->escape($_POST['item_count']); 
                    $item_animal_type = $_POST['item_animal_type'];
                    $item_manufacturer = $_POST['item_manufacturer'];
                    $item_category = $_POST['item_category'];
                    $item_structure = $helper->escape($_POST['item_structure']);
                    $item_desc = $helper->escape($_POST['item_desc']);                   
					$item_price = $helper->escape($_POST['item_price']);
                    $item_img_preview = $_FILES['item_img_preview'];
                    $item_img_main = $_FILES['item_img_main'];
                    
                    $validation = new Validation(); 
					$errors = array();
                    
                    //TODO: Make validation
                    if (!$validation->checkLength($item_name)) {
						$errors[] = 'Количество символов для названия товара не должно быть меньше 2'; 
					}
                    if (!$validation->checkNumber($item_price, 99999, 10)) {
						$errors[] = 'Цена товара не должна превышать 99999 и не должна быть меньше 10'; 
					}
                    if (!$validation->checkNumber($item_unit_count, 99999, 1)) {
						$errors[] = 'Объем товара не может превышать 99999 и не должен быть меньше 1'; 
					}
                    if (!$validation->checkNumber($item_count, 99999, 0)) {
						$errors[] = 'Количество товара на складе не должно превышать 99999 и не должна быть меньше 0'; 
					}           
                    
                    
                    if (empty($errors)) {
						$itemModel = new Item();
						$item = array(
							'item_name' => $item_name,
							'item_vendor_code' => $item_vendor_code,
							'item_unit' => $item_unit,
							'item_unit_count' => $item_unit_count,
							'item_count' => $item_count,							 
							'item_manufacturer' => $item_manufacturer,
                            'item_animal_type' => $item_animal_type,
							'item_category' => $item_category,
							'item_structure' => $item_structure,
							'item_desc' => $item_desc,                           
                            'item_price' => $item_price,
							'item_id' => $id
						);
						$itemModel->updateItem($item);
                        
                        
                        
                        if(!$item_img_preview['name'] == ""){
                            $itemModel = new Item();
				            $item = $itemModel->getItemById($id);    
                            $img_name = $item["item_img_preview"];       
                            
                            $img_name_pieces = explode(".", $img_name);
                            $img_name_deleted = $img_name_pieces[0] . "_" . time() . "." . $img_name_pieces[1];
                            
                            //копирование старой картинки в "корзину"
                            rename(("./assets/img/preview_img/" . $img_name), ("./assets/img/deleted_img/" . $img_name_deleted));
                            
                            //загрузить новую картинку вместо старой
                            $dir_for_img_preview = "./assets/img/preview_img";
                            $tmp_name = $item_img_preview['tmp_name'];
                            move_uploaded_file($tmp_name, "$dir_for_img_preview/$img_name");                            
                        }
                        
                        if(!$item_img_main['name'] == ""){
                            $itemModel = new Item();
				            $item = $itemModel->getItemById($id);    
                            $img_name = $item["item_img_main"];       
                            
                            $img_name_pieces = explode(".", $img_name);
                            $img_name_deleted = $img_name_pieces[0] . "_" . time() . "." . $img_name_pieces[1];
                            
                            //копирование старой картинки в "корзину"
                            rename(("./assets/img/main_img/" . $img_name), ("./assets/img/deleted_img/" . $img_name_deleted));
                            
                            //загрузить новую картинку вместо старой
                            $dir_for_img = "./assets/img/main_img";
                            $tmp_name = $item_img_main['tmp_name'];
                            move_uploaded_file($tmp_name, "$dir_for_img/$img_name");                            
                        }
                        
						header('Location: ' . SITE_ROOT . 'items/list');
					}
                }
                
				$itemModel = new Item();
				$item = $itemModel->getItemById($id); 
                
                $manufacturerModel = new Manufacturer(); 
				$manufacturers = $manufacturerModel->getAll();
                
                $animal_typeModel = new AnimalType(); 
				$animal_types = $animal_typeModel->getAll();
                
                $categoryModel = new Category(); 
				$categories = $categoryModel->getAll();
                
                $unitModel = new Unit(); 
				$units = $unitModel->getAll();
                
                if (empty($item)) {
                    // лучше переводить на 404 страницу
					echo 'Товара с таким id не существует'; 
					exit();
				}
                include_once('./views/items/edit.php');
			}
			return; 
		} 
        
        public function delete($parameters = []) {
			$id = $parameters[0];
			if (!$id) {
				return;
			}
			$itemModel = new Item();            
			$itemModel->deleteItemById($id);
			header('Location: ' . SITE_ROOT . 'items/list');
		}
        
        public function sorted_by_animal_type($parameters = []) {
			//echo 'Вызван action sorted_by_animal_type в ItemsController';
            $animal_type = $parameters[0];
            $page = $parameters[1];
            $ItemsControllerObj = new ItemsController();
            
            switch ($animal_type) {
                case 'cats':
                    $ItemsControllerObj->getAllInAnimalType("Кошки", "Кошки", "Товары для кошек", $page, "cats");
                    break;
                case 'dogs':
                    $ItemsControllerObj->getAllInAnimalType("Собаки", "Собаки", "Товары для собак", $page, "dogs");
                    break;
                case 'birds':
                    $ItemsControllerObj->getAllInAnimalType("Птицы", "Птицы", "Товары для птиц", $page, "birds");
                    break;
                case 'fish':
                    $ItemsControllerObj->getAllInAnimalType("Рыбки", "Рыбки", "Товары для рыбок", $page, "fish");
                    break;
                case 'rodents':
                    $ItemsControllerObj->getAllInAnimalType("Хорьки и грызуны", "Хорьки и грызуны", "Товары для хорьков и грызунов", $page, "rodents");
                    break;
                default:
                    call_user_func(array("ErrorsController", "index"), "error");
            }
            
            
            return;
        }
        
        private function getAllInAnimalType($animal_type, $title, $h1, $page, $animal_name_eng) {
			$title = $title;
            $h1 = $h1;
            
            $page = $page;

            if(!is_numeric($page)) $page=1;
            if ($page<1) $page=1;
                
            $quantity=12;
            $limit=3;
            
            $itemModel = new Item();
            $itemsCount = $itemModel->getItemsCountByAnimalType($animal_type);
            $pages = $itemsCount/$quantity;
            $pages = ceil($pages);
            if ($page>$pages) $page = 1;
            if (!isset($list)) $list=0;
            $list=($page-1)*$quantity;
            
            $itemModel = new Item();
            $items = $itemModel->getAllInAnimalType($animal_type, $quantity, $list);
            
            $path = SITE_ROOT . "items/" . $animal_name_eng;
                
            include_once('./views/items/index.php');            
            return;
        }
         
        public function sorted_by_category($parameters = []) {
			//echo 'Вызван action sorted_by_category в ItemsController';
            
            $animal_type = $parameters[0];
            $category = $parameters[1];
            $page = $parameters[2];
        
            $ItemsControllerObj = new ItemsController();
             
            switch ($animal_type) {
                case 'cats':
                    switch ($category) {
                        case 'food':
                            $ItemsControllerObj->getAllInAnimalTypeCategory("Кошки", "Корм", "Кошки | Корм", "Корма для кошек", $page, "cats", "food");
                            break;
                        case 'fillers':
                            $ItemsControllerObj->getAllInAnimalTypeCategory("Кошки", "Наполнители", "Кошки | Наполнители", "Наполнители для кошек", $page, "cats", "fillers");
                            break;
                        case 'careproducts':
                            $ItemsControllerObj->getAllInAnimalTypeCategory("Кошки", "Средства для ухода", "Кошки | Средства для ухода", "Средства для ухода для кошек", $page, "cats", "careproducts");
                            break;
                        default:
                            call_user_func(array("ErrorsController", "index"), "error");
                    }
                    break;
                case 'dogs':                            
                    switch ($category) {
                        case 'food':
                            $ItemsControllerObj->getAllInAnimalTypeCategory("Собаки", "Корм", "Собаки | Корм", "Корма для собак", $page, "dogs", "food");
                            break;
                        case 'fillers':
                            $ItemsControllerObj->getAllInAnimalTypeCategory("Собаки", "Ошейники", "Собаки | Ошейники", "Ошейники для собак", $page, "dogs", "fillers");
                            break;
                        case 'careproducts':
                            $ItemsControllerObj->getAllInAnimalTypeCategory("Собаки", "Средства для ухода", "Собаки | Средства для ухода", "Средства для ухода для собак", $page, "dogs", "careproducts");
                            break;
                        default:
                            call_user_func(array("ErrorsController", "index"), "error");
                    }
                    break;
                case 'birds':
                    switch ($category) {
                        case 'food':
                            $ItemsControllerObj->getAllInAnimalTypeCategory("Птицы", "Корм", "Птицы | Корм", "Корма для птиц", $page, "birds", "food");
                            break;
                        case 'birdcages':
                            $ItemsControllerObj->getAllInAnimalTypeCategory("Птицы", "Клетки", "Птицы | Клетки", "Клетки для птиц", $page, "birds", "birdcages");
                            break;
                        case 'toys':
                            $ItemsControllerObj->getAllInAnimalTypeCategory("Птицы", "Игрушки", "Птицы | Игрушки", "Игрушки для птиц", $page, "birds", "toys");
                            break;
                        default:
                            call_user_func(array("ErrorsController", "index"), "error");
                    }
                    break;
                case 'fish':
                    switch ($category) {
                        case 'food':
                            $ItemsControllerObj->getAllInAnimalTypeCategory("Рыбки", "Корм", "Рыбки | Корм", "Корма для рыбок", $page, "fish", "food");
                            break;
                        case 'aquariums':
                            $ItemsControllerObj->getAllInAnimalTypeCategory("Рыбки", "Аквариумы", "Рыбки | Аквариумы", "Аквариумы для рыбок", $page, "fish", "aquariums");
                            break;
                        default:
                            call_user_func(array("ErrorsController", "index"), "error");
                    } 
                    break;
                case 'rodents':
                    switch ($category) {
                        case 'food':
                            $ItemsControllerObj->getAllInAnimalTypeCategory("Хорьки и грызуны", "Корм", "Хорьки, грызуны | Корм", "Корма для хорьков и грызунов", $page, "rodents", "food");
                            break;
                        case 'cages':
                            $ItemsControllerObj->getAllInAnimalTypeCategory("Хорьки и грызуны", "Клетки и переноски", "Хорьки, грызуны | Клетки", "Клетки для хорьков и грызунов", $page, "rodents", "cages");
                            break;
                        case 'toys':
                            $ItemsControllerObj->getAllInAnimalTypeCategory("Хорьки и грызуны", "Игрушки", "Хорьки, грызуны | Игрушки", "Игрушки хорьков и грызунов", $page, "rodents", "toys");
                            break;
                        default:
                            call_user_func(array("ErrorsController", "index"), "error");
                    }
                    break;
                default:
                    call_user_func(array("ErrorsController", "index"), "error");
            }
            return;
        }
        
        private function getAllInAnimalTypeCategory($animal_type, $category, $title, $h1, $page, $animal_name_eng, $category_name_eng) {
            $title = $title;
            $h1 = $h1;
            
            $page = $page;

            if(!is_numeric($page)) $page=1;
            if ($page<1) $page=1;
                
            $quantity=12;
            $limit=3;
            
            $itemModel = new Item();
            $itemsCount = $itemModel->getItemsCountByAnimalTypeAndCategory($animal_type, $category_name_eng);
            $pages = $itemsCount/$quantity;
            $pages = ceil($pages);
            if ($page>$pages) $page = 1;
            if (!isset($list)) $list=0;
            $list=($page-1)*$quantity;
            
            $itemModel = new Item();
            $items = $itemModel->getAllInAnimalTypeCategory($animal_type, $category, $quantity, $list);
            
            $path = SITE_ROOT . "items/" . $animal_name_eng . "/" . $category_name_eng;
            
            include_once('./views/items/index.php');
            return;
        }
        
        public function search($parameters = []) {
            $title = 'Поиск товара';
            $h1 = 'Поиск товара';
			$search_str = urldecode($parameters[0]); 
			if (!$search_str) {
				echo 'Некорректная строка запроса'; 
			} else {
				$itemModel = new Item();
				$items = $itemModel->searchItems($search_str); 	 
                
                include_once('./views/items/search.php');
			}
			return; 
		}
        
        public function search_page() {
            $title = 'Поиск товара';
            $h1 = 'Поиск товара';
            include_once('./views/items/search.php');
            return; 
		}
        
         
    }
    
