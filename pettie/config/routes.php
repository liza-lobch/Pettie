<?php

	$routes = array(        
        
        "ItemsProxyController" => array(
			"items/add" => "add",
			"items/edit/([0-9]+)" => "edit/$1",
			"items/delete/([0-9]+)" => "delete/$1"
		),
        
        "ItemsController" => array(
            "items/list/([0-9]+)" => "index/$1",
            "items/list" => "index/1",                    
            "items/view/([0-9]+)" => "view/$1",
            "items/search/(.+)" => "search/$1",
            "items/search" => "search_page",
            
            "items/([a-z]+)/([a-z]+)/([0-9]+)" => "sorted_by_category/$1/$2/$3",   
            "items/([a-z]+)/([a-z]+)" => "sorted_by_category/$1/$2/1",   
            
            "items/([a-z]+)/([0-9]+)" => "sorted_by_animal_type/$1/$2",
            "items/([a-z]+)" => "sorted_by_animal_type/$1/1",
            
            
            "items/([0-9]+)" => "index/$1",
            "items" => "index/1"
		),
        
        "ClubProxyController" => array(
			"club/add" => "add",
			"club/edit/([0-9]+)" => "edit/$1",
			"club/delete/([0-9]+)" => "delete/$1"
		),
        
        "ClubController" => array(
			"club/list" => "index",
            "club/view/([0-9]+)" => "view/$1",
            "club" => "index",
		),
        
        "AddressesProxyController" => array(
			"addresses/add" => "add",
			"addresses/edit/([0-9]+)" => "edit/$1",
			"addresses/delete/([0-9]+)" => "delete/$1"
		),
        
        "AddressesController" => array(
			"addresses/list" => "index", 
            "addresses" => "index"
		),
        
        "UsersController" => array(
			"register" => "reg",
			"auth" => "auth",
            "logout" => "logout",
            "agreement" => "agreement",            
            "users" => "getUsers",            
            "ajax/check_if_login_exists" => "ajaxCheckIfLoginExists"
		),
        
        "CartsController" => array(
            "cart/ordering" => "ordering",
            "cart/success" => "success",
			"cart" => "index"
		),
        
		"OrdersController" => array(
			"orders/add" => "add",
			"orders/update/([0-9]+)/([0-9]+)" => "update/$1/$2",
			"orders/view/([0-9]+)" => "view/$1",
			"orders" => "orders"            
		),    
        
        "MainPageController" => array(
            "main" => "index"
        )
    );