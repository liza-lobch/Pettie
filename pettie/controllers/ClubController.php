<?php

	class ClubController 
	{
		public function index() {
			//echo 'Здесь будут интересные статьи';
            $title = 'Клуб Пэтти';
            $h1 = 'Интересные статьи для тех, кто любит животных';
            $articleModel = new Article();
			$articles = $articleModel->getAll();
            //echo '<pre>';
            //print_r($items);
            //echo '</pre>';
            include_once('./views/club/index.php');
            return;
        }
        
        public function view($parameters = []) {
            $title = 'Просмотр статьи';
			$id = $parameters[0]; 
			if (!$id) {
				echo 'Некорректный id'; 
			} else {
				$articleModel = new Article();
				$article = $articleModel->getArticleById($id); 	
                //echo '<pre>';
                //print_r($item);
                //echo '</pre>';
				// echo "Вызван action view с параметром id = $id";              
                if (empty($article)) {
					//echo 'Товар с таким id не существует'; 
                    call_user_func(array("ErrorsController", "index"), "error");
					exit();
				}
                include_once('./views/club/view.php');
			}
			return; 
		}
        
        public function add() {
            $title = 'Добавление статьи';          
            
            if (isset($_POST['article_name'])) {
                $helper = new Helper();
                $article_name = $helper->escape($_POST['article_name']); 
                $article_preview_text = $helper->escape($_POST['article_preview_text']); 
                $article_content = $helper->escape($_POST['article_content']);                   
                $article_img_preview = $_FILES['article_img_preview'];
                
                $validation = new Validation(); 
                $errors = array();

                if (!$validation->checkLength($article_name)) {
                    $errors[] = 'Количество символов для названия статьи не должно быть меньше 2'; 
                }
                if (!$validation->checkLength($article_preview_text)) {
                    $errors[] = 'Количество символов для превью-текста не должно быть меньше 2'; 
                }
                
                if($article_img_preview['name'] == "") {
                    $errors[] = 'Нужно загрузить картинку статьи';
                } else {
                    $img_preview_name = $article_img_preview['name'];
                    $img_preview_name_pieces = explode(".", $img_preview_name);
                    $img_preview_name_final = $img_preview_name_pieces[0] . "_" . time() . "." . $img_preview_name_pieces[1];
                }
                
                $article = new Article();
				if ($article->checkIfArticleExists($article_name)) {
					$errors[] = 'Статья с таким названием уже есть!';
				}

                if (empty($errors)) {
                    $articleModel = new Article();
                    $article = array(
                        'article_name' => $article_name,
                        'article_preview_text' => $article_preview_text,
                        'article_content' => $article_content,                        
                        'article_img_preview' => $img_preview_name_final,
                    );
                    $articleModel->addArticle($article);
                    
                    //добавление картинки на сервер
                    $dir_for_img_preview = "./assets/img/club/preview_img";
                    $tmp_name = $article_img_preview['tmp_name'];
                    move_uploaded_file($tmp_name, "$dir_for_img_preview/$img_preview_name_final");
                    
                    header('Location: ' . SITE_ROOT . 'club');
                }					
            } 
                        
            //echo "<pre>";
            //var_dump($item_img_preview);
            //echo "</pre>";
            
            include_once('./views/club/add.php');
			return;
		}
        
        public function delete($parameters = []) {
			$id = $parameters[0];
			if (!$id) {
				return;
			}
			$articleModel = new Article();            
			$articleModel->deleteArticleById($id);
			header('Location: ' . SITE_ROOT . 'club/list');
		}
        
        public function edit($parameters = []) {
            $title = 'Редактирование статьи';
			$id = $parameters[0]; 
			if (!$id) {
				echo 'Некорректный id'; 
                exit();
			} else {
                if (isset($_POST['article_name'])) {
                    $helper = new Helper();
                    $article_name = $helper->escape($_POST['article_name']); 
                    $article_preview_text = $helper->escape($_POST['article_preview_text']); 
                    $article_content = $helper->escape($_POST['article_content']);
                    $article_img_preview = $_FILES['article_img_preview'];
                    
                    $validation = new Validation(); 
					$errors = array();
                                        
                    if (!$validation->checkLength($article_name)) {
                        $errors[] = 'Количество символов для названия статьи не должно быть меньше 2'; 
                    }
                    if (!$validation->checkLength($article_preview_text)) {
                        $errors[] = 'Количество символов для превью-текста не должно быть меньше 2'; 
                    } 
                                    
                    
                    if (empty($errors)) {
						$articleModel = new Article();
						$article = array(
							'article_name' => $article_name,
                            'article_preview_text' => $article_preview_text,
                            'article_content' => $article_content,
							'article_id' => $id
						);
						$articleModel->updateArticle($article);                        
                        
                        if(!$article_img_preview['name'] == ""){
                            $articleModel = new Article();
				            $article = $articleModel->getArticleById($id);    
                            $img_name = $article["article_img_preview"];       
                            
                            $img_name_pieces = explode(".", $img_name);
                            $img_name_deleted = $img_name_pieces[0] . "_" . time() . "." . $img_name_pieces[1];
                            
                            //копирование старой картинки в "корзину"
                            rename(("./assets/img/club/preview_img/" . $img_name), ("./assets/img/deleted_img/" . $img_name_deleted));
                            
                            //загрузить новую картинку вместо старой
                            $dir_for_img_preview = "./assets/img/club/preview_img";
                            $tmp_name = $article_img_preview['tmp_name'];
                            move_uploaded_file($tmp_name, "$dir_for_img_preview/$img_name");                            
                        }
                        
						header('Location: ' . SITE_ROOT . 'club/list');
					}
                }
                
				$articleModel = new Article();
				$article = $articleModel->getArticleById($id);    

                //echo $article["article_img_preview"];
                
                if (empty($article)) {
                    // лучше переводить на 404 страницу
					echo 'Статьи с таким id не существует'; 
					exit();
				}
                include_once('./views/club/edit.php');
			}
			return; 
		}
    }
