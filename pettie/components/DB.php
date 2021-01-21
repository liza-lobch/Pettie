<?php

	final class DB // больше не может быть экземпляров
	{  //шаблон одиночка
        private static $connection; 
        
        private function __construct() {
            include('./config/db.php');
			$dsn = "{$db['type']}:host={$db['host']};dbname={$db['db_name']};charset={$db['charset']}"; // строка подключения
			$opt = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);  // возвращается ассоциативный массив по умолчанию
			$pdo = new PDO($dsn, $db['user'], $db['password'], $opt);
			self::$connection = $pdo;
        }
        
        public static function connect() {
			if (!self::$connection) {
				new self();  // то же что DB();
			}
			return self::$connection;
		}

		private function __clone() {}

		private function __sleep() {} // сериализация (перевод в строчку)

		private function __wakeup() {} // десериализация
	}