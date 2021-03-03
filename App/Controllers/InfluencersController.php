<?php

namespace App\Controllers;

SESSION_START();

defined("APPPATH") OR die("Access Denied");

use \Core\View,
	\Core\App,
	\App\Models\Auth\Auth,
	\App\Models\Influencers\Influencers,
	\App\Lib\Functions;

require VENDORPARTH;

class InfluencersController
{

	public function __construct()
	{

        if(!isset($_SESSION['username'])) {
        
            header("Location: index.php?url=login");
        
        }
    } 

////////////////////////////////////////////////////////////////////////////////////////////////

	public function index()
	{
		View::set("username", Auth::getAuth($_SESSION['username']));
		View::render("Influencers/index");
	}

////////////////////////////////////////////////////////////////////////////////////////////////

	public function CheckOut()
	{
		parse_str($_POST['str'], $params);
		$cGen	=	0;
	 	$eName 	=	$eMail 	=	$eDescription 	=	$eUrl 	=	$eAdv 	=	$eCat 	= 	$eVac 	=	false;

		for ($i=1; $i < 100 ; $i++) 
		{ 
			$var 	=	'i_red'.$i.'';

			if(isset($params[$var]) == "on")
			{
				$cGen 		= 	$cGen+1;
			}
		}

		$eName 	=	($params['i_name'] 	== "") ? '<div class="alert alert-info fade in">Debe contener un nombre valido</div>' : '';
		$eMail 	=	($params['i_email'] == "") ? '<div class="alert alert-info fade in">Debe contener un email valido</div>' : '';
		$eDesc 	=	( ($params['i_description'] == "") || (strlen($params['i_description']) >= 300) )  ? '<div class="alert alert-info fade in">Debe contener una descripcion valida o conener maximo 300 caracteres</div>' : '';
		$eUrl 	=	($params['i_url'] == "") ? '<div class="alert alert-info fade in">Debe contener una URL valida</div>' : '';
		$eAdv 	=	($params['i_adv'] == "") ? '<div class="alert alert-info fade in">Debe Seleccionar una opcion valida</div>' : '';
		$eCat 	=	(($cGen == 0) || ($cGen == 4)) ? '<div class="alert alert-info fade in">Debe Seleccionar al menos una opcion o maximo 3</div>' : '';
		if($params['i_ini'] <> "")
		{
			if($params['i_end'] == "")
			{
				$eVac 	=	'<div class="alert alert-info fade in">Debe colocar ambas fechas correspondiente al periodo de vacaciones</div>';
			}
		}

		if( ($eName <> '') || ($eMail <> '') || ($eDescription <> '') || ($eUrl <> '') || ($eAdv <> '') || ($eCat <> '') || ($eVac <> false) )
		{
			
			echo json_encode([
				'status' => false, 
				'eName' 		=>	$eName,
				'eMail' 		=>	$eMail,
				'eDescription' 	=>	$eDesc,
				'eUrl'			=>	$eUrl,
				'eAdv'			=>	$eAdv,
				'eCat'			=>	$eCat,
				'eVac'			=>	$eVac,
			]); 

		}else{

			echo json_encode([
				'status' 		=> true, 
			]); 

		}

	}

////////////////////////////////////////////////////////////////////////////////////////////////

	public function InsertFirst()
   	{
   		parse_str($_POST['str'], $params);
		$cGen	=	0;
   		$iVac 	=	((Functions::clean($params['i_ini']) <> "") && (Functions::clean($params['i_end']) <> "")) ? "1" : "0";

		for ($i=1; $i < 100 ; $i++) 
		{ 
			$var 	=	'i_red'.$i.'';

			if(isset($params[$var]) == "on")
			{
				$cGen 			= 	$cGen+1;
				$iCat[$cGen] 	= 	$i;
			}
		}
		$ccat 	=	implode(",", $iCat);

   		$iData 	=	[
   			'name'			=>	Functions::clean($params['i_name']),
   			'email'			=>	Functions::clean($params['i_email']),
   			'descripcion'	=>	Functions::clean($params['i_description']),
   			'url'			=>	Functions::clean($params['i_url']),
   			'pais'			=>	Functions::clean($params['i_pais']),
   			'idioma'		=>	Functions::clean($params['i_idioma']),
   			'i_adv'			=>	Functions::clean($params['i_adv']),
   			'i_cat'			=>	$ccat,
   			'i_vac'			=>	$iVac,
   			'i_ini'			=>	Functions::clean($params['i_ini']),
   			'i_end'			=>	Functions::clean($params['i_end']),
   		];

   		$insert 	=	Influencers::SaveReg($iData);
   		if($insert <> false)
   		{
   			echo json_encode([
				'status'	=> true, 
				'id'		=>	$insert
			]); 
   		}else{
   			echo json_encode([
				'status'	=>  false, 
				'alert'		=>	"Error al Insert en Base de Datos."
			]); 
   		}

    }

////////////////////////////////////////////////////////////////////////////////////////////////

	public function CheckOut2()
	{
		parse_str($_POST['str'], $params);
		$op1 	=	(isset($params['if_check'])) ? true : false;
		$op2 	=	(isset($params['iv_check'])) ? true : false;
		$op3 	=	(isset($params['is_check'])) ? true : false;

		if( ( $op1 == true ) || ( $op2 == true ) || ( $op3 == true) )
		{
			if($op1 == true) 
			{
				if( ($params['if_package'] == "") || ($params['if_promo'] == ""))
				{
					echo json_encode([
						'status' 	=> 	false,
						'message'	=>	'Foto Instagram - Debe proporcionar toda la informacion necesaria.'
					]); 
					exit;
				}
			
				}

			if($op2 == true) 
			{
				if( ($params['iv_package'] == "") || ($params['iv_promo'] == ""))
				{
					echo json_encode([
						'status' 	=> 	false,
						'message'	=>	'Video Instagram - Debe proporcionar toda la informacion necesaria.'
					]); 
					exit;
				}

				if( ($params['is_package'] == "") || ($params['is_promo'] == ""))
				{
					echo json_encode([
						'status' 	=> 	false,
						'message'	=>	'Store Instagram - Debe proporcionar toda la informacion necesaria.'
					]); 
					exit;
				}
			
			}
			
			if($op3 == true) 
			{

				if( ($params['is_package'] == "") || ($params['is_promo'] == ""))
				{
					echo json_encode([
						'status' 	=> 	false,
						'message'	=>	'<div class="alert alert-info fade in">Store Instagram - Debe proporcionar toda la informacion necesaria.</div>'
					]); 
					exit;
				}
			
			}

			$iData	=	[
				'id'			=>	Functions::clean($params['db_id']),
				'if_check'		=>	(isset($params['if_check'])) ? '1' : '0',
				'if_package'	=>	(isset($params['if_check'])) ? Functions::clean($params['if_package']) : '0',
				'if_promo'		=>	(isset($params['if_check'])) ? Functions::clean($params['if_promo']) : '0',
				'iv_check'		=>	(isset($params['iv_check'])) ? '1' : '0',
				'iv_package'	=>	(isset($params['iv_check'])) ? Functions::clean($params['iv_package']) : '0',
				'iv_promo'		=>	(isset($params['iv_check'])) ? Functions::clean($params['iv_promo']) : '0',
				'is_check'		=>	(isset($params['is_check'])) ? '1' : '0',
				'is_package'	=>	(isset($params['is_check'])) ? Functions::clean($params['is_package']) : '0',
				'is_promo'		=>	(isset($params['is_check'])) ? Functions::clean($params['is_promo']) : '0'
			];

			$iRes 	=	Influencers::UpdateReg($iData);

			echo json_encode([
				'status' 	=> 	true
			]); 


		}else{
			echo json_encode([
				'status' 	=> 	false,
				'message'	=>	'Debe Seleccionar al menos una opcion'
			]); 
		}
	}


////////////////////////////////////////////////////////////////////////////////////////////////

} 