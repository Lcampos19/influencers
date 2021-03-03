<?php

namespace App\Controllers;

defined("APPPATH") OR die("Access Denied");

use \Core\View,
	\Core\App,
	\App\Models\User;


class ErrorController
{

	public function index()
	{
		View::set("data", "Internet, TV and Security Systems");
		View::render("Error/404");
	}

}