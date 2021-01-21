<?php

	class Article 
	{
		public function getAll() {
			$db = DB::connect();
			$query = (new Select('articles'))
                        ->where("WHERE `article_is_deleted` = 0")
                        ->build();
			$result = $db->query($query); 
			$articles = $result->fetchAll();
			return $articles;
		}
        
        public function getArticleById($id) {
			$db = DB::connect();
			$query = (new Select('articles'))
						->where("WHERE `article_id` = $id AND `article_is_deleted` = '0'")
						->build(); 
            //var_dump($query);
			$result = $db->query($query);
			$article = $result->fetch();
			return $article;
		}
        
        public function addArticle($article) {
			$db = DB::connect();
            $query = (new Insert('articles'))
                        ->set(['article_name' => "$article[article_name]", 
				   	           'article_preview_text' => "$article[article_preview_text]",                      
				   	           'article_content' => "$article[article_content]",
                               'article_img_preview' => "$article[article_img_preview]" ])
                        ->build();          
            //var_dump($query);
            //exit();
			$db->query($query);
			return;
		}
        
        public function checkIfArticleExists($article_name) {
			$db = DB::connect();
			$query = (new Select('articles'))
                        ->what(['count' => 'count(*)'])
                        ->where("WHERE `article_name` = '$article_name'")
                        ->build();
                
            //var_dump($query);
			$result = $db->query($query);
			$count = $result->fetch();
			if ($count['count'] == 1) {
				return true; 
			} else {
				return false;
			}
		}
        
        public function deleteArticleById($id) {
			$db = DB::connect();
			$query = (new Update('articles'))
                        ->set(['article_is_deleted' => 1])
                        ->where("WHERE `article_id` = $id")
                        ->build();         
			$db->query($query);
			return;
		}
        
        public function updateArticle($article) {
			$db = DB::connect();
			$query = (new Update('articles'))
                    ->set(['article_name' => "$article[article_name]", 
                           'article_preview_text' => "$article[article_preview_text]",               
				   	       'article_content' => "$article[article_content]" ])
                    ->where("WHERE `article_id` = $article[article_id]")
                    ->build();
            //var_dump($query);
			$db->query($query);
			return;
		}
	}