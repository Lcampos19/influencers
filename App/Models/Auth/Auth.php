<?php 

namespace App\Models\Auth;

require VENDORPARTH;

defined("APPPATH") OR die("Access Denied");

use \Core\App;
use \Core\Database;
use PDO;
use \App\Lib\SendEmail;

class Auth
{

	public static function getURL($data)
	{

		try {

			$connection 	=	Database::instance();
			$sql 			= 	"SELECT departament FROM users";
			$query 			=	$connection->prepare($sql);
			$query->execute();

			$result = $query->fetchAll(PDO::FETCH_ASSOC);

			foreach ($result as $key => $value) {

				$dep = strtolower(str_replace(" ", "_", $value['departament']));

				if($dep == $data['web']) { $Web  = "index.php?url=".$dep."/index/".$data['username']; }
			}

			return $Web;

		} catch (Exception $e) {
		
			return "Error!: " . $e->getMessage();

		}
	}

	public static function getUserID($id)
	{

		try {

			$connection 	=	Database::instance();
			$sql 			= 	"SELECT * FROM users WHERE id = ?";
			$query 			=	$connection->prepare($sql);
			$query->bindParam(1, $id, \PDO::PARAM_INT);
			$query->execute();
			
			$result = $query->fetchAll(PDO::FETCH_ASSOC);

        	foreach ($result as $key => $value) {

       	    $auth = [
                'name'          =>  $value['name'],
                'username'      =>  $value['username'],
                'email'         =>  $value['email'],
                'password'      =>  $value['password'],
                'img'           =>  $value['img'],
                'departament'   =>  $value['departament'],
            ];
        }
			
			$result = (isset($auth)) ? $auth : "" ;
			
			return $result;

		} catch (Exception $e) {

			return "Error!: " . $e->getMessage();

		}
	}

	public static function getAuth($data)
	{

		try {

			$connection 	=	Database::instance();
			$sql 			= 	"SELECT * FROM users WHERE username = ?";
			$query 			=	$connection->prepare($sql);
			$query->bindParam(1, $data, \PDO::PARAM_STR);
			$query->execute();
			
			$result = $query->fetchAll(PDO::FETCH_ASSOC);

        	foreach ($result as $key => $value) {

       	    $auth =[
       	    	'id'			=>	$value['id'],
                'name'          =>  $value['name'],
                'username'      =>  $value['username'],
                'email'         =>  $value['email'],
                'password'      =>  $value['password'],
                'img'           =>  $value['img'],
                'departament'   =>  $value['departament'],
            ];
        }
			
			$result = (isset($auth)) ? $auth : "" ;
			
			return $result;

		} catch (Exception $e) {

			return "Error!: " . $e->getMessage();

		}
	}

	public static function getLogin($data)
	{

		try {
			$connection 	=	Database::instance();
			$sql 			= 	"SELECT * FROM users WHERE username = ?";
			$query 			=	$connection->prepare($sql);
			$query->bindParam(1, $data['username'], \PDO::PARAM_STR);
			$query->execute();
			
			$result = $query->fetch();
			
			if($result <> "")
			{
		        if(md5($data['password']) == $result['password'])
		        {
		        	return $ret = [
		        		'id'		=>	$result['id'],
						'status'	=>	true,
		        		'web'		=>	strtolower(str_replace(" ", "_",$result['departament'])),
		        		'data'		=>	"",
		        		'username'	=>	$result['username'],
		        		'departament'	=>	$result['departament']
		        	];

		        }else{
					$data = "";				
					$data.='<div class="alert alert-danger alert-dismissible">';
					$data.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
					$data.='<h4><i class="icon fa fa-ban"></i> Alert!</h4>';
					$data.='<strong>Error!</strong> in Login, <strong> Password dont Match </strong> Try Again';
					$data.='</div>';
		        }
		        
		        return $ret = [
		        	'status'	=>	false,
		        	'web'		=>	strtolower(str_replace(" ", "_",$result['departament'])),
		        	'data'		=> 	$data,
		        	'departament'	=>	$result['departament']

		        ];

			}else{

				$data = "";				
				$data.='<div class="alert alert-danger alert-dismissible">';
				$data.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
				$data.='<h4><i class="icon fa fa-ban"></i> Alert!</h4>';
				$data .= '<strong>Error!</strong> in Login, <strong> Username dont exist </strong> Try Again';
				$data.='</div>';
	            
		        return $ret = [
		        	'status'	=>	false,
		        	'web'		=>	strtolower(str_replace(" ", "_",$result['departament'])),
		        	'data'		=> 	$data,
		        	'departament'	=>	$result['departament']
		        ];
			}

		} catch (Exception $e) {

			return "Error!: " . $e->getMessage();
			
		}
	}

	public static function getEmail($data)
	{

		$email = (App::getEmailValid($data) == true) ? $data : App::getEmailValid($data);
		
		if($email == true)
		{
			try {

				$connection 	=	Database::instance();
				$sql 			= 	"SELECT * FROM users WHERE email = ?";
				$query 			=	$connection->prepare($sql);
				$query->bindParam(1, $email, \PDO::PARAM_STR);
				$query->execute();
				
				$result = $query->fetch();

				if($result)
				{
					$sent = SendEmail::RecoveryData($email, $result['id']);

					$data = "";

					if($set['error'] = true)
					{

						$data.='<div class="alert alert-success alert-dismissible">';
						$data.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
						$data.='<h4><i class="icon fa fa-check"></i> Alert!</h4>';
						$data.='<strong>Success!</strong> Password recovery emails have been sent correctly, please check the same';
						$data.='</div>';

					}else{
						
						$data = "";
						$data.='<div class="alert alert-danger alert-dismissible">';
						$data.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
						$data.='<h4><i class="icon fa fa-ban"></i> Alert!</h4>';
						$data .= '<strong>Error!</strong> Email not sent, try again and if the error persists, contact your system administrator';
						$data.='</div>';
					}

		        	return $ret = [
						'status'	=>	true,
		        		'data'		=>	$data,
		        	];
				}
				else
				{
					$data = "";

					$data.='<div class="alert alert-danger alert-dismissible">';
					$data.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
					$data.='<h4><i class="icon fa fa-ban"></i> Alert!</h4>';
					$data.='<strong>Error!</strong> Email Address <strong> dont exist </strong> Try Again';
					$data.='</div>';
				}

		        return $ret = [
		        	'status'	=>	false,
		        	'data'		=> 	$data,

		        ];

			} catch (Exception $e) {

				return "Error!: " . $e->getMessage();
			}
		}

	}

	public static function getPass($data)
	{
		if($data['password'] == $data['newpassword'])
		{

			try {
				$connection 	=	Database::instance();
				$sql 			= 	"UPDATE users SET password= ? where username = ?";
				$query 			=	$connection->prepare($sql);

				if($query->execute([App::getCypherData()->CypherPass($data['newpassword']), $data['username']]))
				{
			        return $ret = [
			        	'status'	=>	true,
			        	'web'		=>	Auth::getURL(Auth::getlogin($data))
			        ];

				}else{

			        return $ret = [
			        	'status'	=>	false,
			        	'message'	=>	"Error!, Update Registrer, try again.",
			        	'web'		=>	Auth::getURL($login)
			        ];
				}


			} catch (Exception $e) {

				return "Error!: " . $e->getMessage();

			}

		}
		else
		{
		    $data = "";
			$data.='<div class="alert alert-danger alert-dismissible">';
			$data.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
			$data.='<h4><i class="icon fa fa-ban"></i> Alert!</h4>';
			$data.='<strong>Error!</strong> Password not match, Try Again';
			$data.='</div>';


	        return $ret = [
	        	'status'	=>	false,
	        	'data'		=> 	$data,

	        ];
		}
	}

	public static function registerUser($resource)
	{
		try {

			$db = Database::instance();

	        $sql = $db->prepare('INSERT INTO users(name, email, username, password, departament, img, status, created_at, updated_at) VALUES ("'.$resource['name'].'", "'.$resource['email'].'", "'.$resource['username'].'", "'.App::getCypherData()->CypherPass($resource['password']).'", "'.$resource['departament'].'", "'.$resource['img'].'", "'.$resource['status'].'", "'.$resource['created_at'].'", "'.$resource['updated_at'].'")');

			if(	$sql->execute())
			{

	            $data = "";
				$data.='<div class="alert alert-success alert-dismissible">';
				$data.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
				$data.='<h4><i class="icon fa fa-check"></i> Alert!</h4>';
				$data.='<strong>Successfull!</strong> User created successfully';
				$data.='</div>';

				return ['status'	=>	true, 'html'	=>	$data];

			}else{

			    $data = "";
				$data.='<div class="alert alert-danger alert-dismissible">';
				$data.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
				$data.='<h4><i class="icon fa fa-ban"></i> Alert!</h4>';
				$data.= '<strong>Error!</strong> User not created, try again';
				$data.='</div>';

				return ['status'	=>	false, 'html'	=>	$data];

			}

		} catch (Exception $e) {
		
			return "Error!: " . $e->getMessage();

		}
	}

	public static function getUserExists($user)
	{
		try {

			$connection 	=	Database::instance();
			$sql 			= 	"SELECT * FROM users WHERE username = ? or email = ?";
			$query 			=	$connection->prepare($sql);
			$query->bindParam(1, $user['username'], \PDO::PARAM_INT);
			$query->bindParam(2, $user['email'], \PDO::PARAM_STR);
			$query->execute();
			
			$result = $query->fetchAll(PDO::FETCH_ASSOC);

			if($result)
			{
				return [
					'status'		=>	true,
					'userMessage'	=>	($result[0]['username'] <> "") 	? $result[0]['username'] 	: "" ,
					'emailMessage'	=>	($result[0]['email'] <> "") 	? $result[0]['email'] 		: "" 
				];
			}
			else
			{
				return [
					'status'		=>	false,
					'userMessage'	=>	(isset($result[0]['username']))	? $result[0]['username'] 	: "" ,
					'emailMessage'	=>	(isset($result[0]['email'])) 	? $result[0]['email'] 		: "" 
				];
			}			

		} catch (Exception $e) {

			return "Error!: " . $e->getMessage();

		}
	}

	public static function getUsers()
	{
		try {

			$connection 	=	Database::instance();
			$sql 			= 	"SELECT username FROM users ";
			$query 			=	$connection->prepare($sql);
			$query->execute();
			
			return $query->fetchAll(PDO::FETCH_ASSOC);

		} catch (Exception $e) {

			return "Error!: " . $e->getMessage();

		}
	}

}