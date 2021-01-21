<?php

    include_once('./config/constants.php');
    include_once('./components/Autoload.php'); // подтягивает все классы
	
	$router = new Router();
	$router->run();