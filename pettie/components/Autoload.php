<?php

	spl_autoload_register(function ($className) 
		{

			$arrDirectories = array(
				'components/', 
				'controllers/',
				'models/'
			);

			foreach ($arrDirectories as $directory) {

				$classPath = FILE_ROOT . $directory . $className . '.php'; // регистр сохраняется

				if (is_file($classPath)) {
					include_once($classPath);
					break; 
				}

			}

		}
	);
