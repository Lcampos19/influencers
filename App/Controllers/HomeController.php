<?php

namespace App\Controllers;

SESSION_START();

defined("APPPATH") OR die("Access Denied");

use \Core\View,
	\Core\App,
	\App\Models\Auth\Auth;

require VENDORPARTH;

class HomeController
{

	public function __construct()
	{
        if(!isset($_SESSION['username'])) {
        
            header("Location: index.php?url=login");
        
        }
    } 

   public function index()
   {
        View::set("username", Auth::getAuth($_SESSION['username']));
		View::render("Test/index");
   }

	
	public function saludo($nombre)
	{
		View::set("name", $nombre);
		View::set("title", "Influencers");
		View::set("subtitle", "Influencers");
		View::render("auth/login");
	}

	public function users()
	{
		$users = UserAdmin::getAll();
		View::set("users", $users);
		View::set("title", "Influencers");
		View::render("Users");
	}

	public function logout()
	{
		session_unset(); 

		session_destroy(); 

		exit;
	}
} 