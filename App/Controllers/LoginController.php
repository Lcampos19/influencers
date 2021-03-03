<?php

namespace App\Controllers;

defined("APPPATH") OR die("Access Denied");

use \Core\View,
	\Core\App,
	\App\Models\Auth\Auth;

use \Lib\SendEmail;

require VENDORPARTH;

class LoginController
{
	
	public function index()
	{
		View::set("subtitle", "Influencers");
		View::render("Auth/login");
	}

	public function login()
	{
		$params 	= 	[];
		$loginWeb	=	"";

		parse_str($_POST['value'], $params);

		$login 		=	Auth::getLogin($params);

		if($login['status']==true) { session_start(); 
			$_SESSION['username'] 		= $login['username'];
			$_SESSION['departament'] 	= $login['departament'];
			$_SESSION['id'] 			= $login['id'];

		}

		header('Content-Type', 'application/json; charset=UTF-8');

		$resltlogin = [
			'status'	=>	($login['status'] 	== true) 	? $login['status'] 		: false,
			'web'		=>	($login['status'] 	== true) 	? Auth::getURL($login) 	: "",
			'data'		=>	($login['data'] 	== true) 	? $login['data'] 		: ""
		];

		echo json_encode($resltlogin);
	}

	public function forgot()
	{
		View::set("subtitle", "Influencers");
		View::render("Auth/email");
	}

	public function sendEmail()
	{
		$params 	= 	[];
		$loginWeb	=	"";

		parse_str($_POST['value'], $params);

		header('Content-Type', 'application/json; charset=UTF-8');

		$data = Auth::getEmail(App::getEmailValid($params['email']));
		
		$resltlogin = [
			'status'	=>	($data['status'] 	== true) 	? $data['status'] 		: false,
			'html'		=>	($data['data'] 	== true) 		? $data['data'] 		: ""
		];

		// var_dump($resltlogin);
		// exit;
		echo json_encode($resltlogin);
	}

	public function recovery()
	{
		
		$id = App::getIntValid(App::getParams()[0]);

		if($id <> false)
		{
			$data = Auth::getUserID($id);

			if($data <> "")
			{
				View::set("subtitle", "Influencers");
				View::set("datos", $data['username']);
				View::render("Auth/recovery");
			}
		}
	}

	public function recoveryData()
	{
		$params 	= 	[];

		$loginWeb	=	"";

		parse_str($_POST['value'], $params);

		$res 	= 	Auth::getPass($params);
		
		header('Content-Type', 'application/json; charset=UTF-8');

		if($res['status'] == false)
		{
			echo json_encode($res);
		}
		else
		{
			session_start();
			if($res['status']==true) {$_SESSION['username'] = $params['username'];}

			echo json_encode($res);
		}

	}

	public function logout()
	{

		session_destroy(); 

		exit;
	}

	public function register()
	{
		$userReg = [
			'name'			=> 	'Genesis Ventas',
			'email'			=>	'genesis.ventas@boomdish.com',
			'username'		=>	'genesis.ventas',
			'password'		=>	'boom1234',
			'departament'	=>	'Sales',
			'img'			=>	'dist/img/user/avatar.png',
			'status'		=>	'1',
			'created_at'	=>	'2018-05-09 03:40:49',
			'updated_at'	=>	'2018-05-09 03:40:49'
		];

		$user = Auth::getUserExists($userReg);
		
		if($user['status'] == false)
		{

			$data = Auth::registerUser($userReg);

			ddd($data);

		}
		else
		{
			$data = "";
            $data .= '<div class="alert alert-danger fade show">'; 
            $data .= '<span class="close" data-dismiss="alert">×</span>'; 
            $data .= '<strong>Error!</strong> User or Email are registered in systems.';  
            $data .= '</div>';

			ddd($data);
		}

		ddd(($user == "") ? "Se Puede Registrar" : $user);
	}
}