<?php

namespace App\Lib;

use \Core\App;
use \Core\Database;
use \Core\DatabaseMW;
use PDO;

require VENDORPARTH;

defined("APPPATH") OR die("Access denied");

/**
 * Class Definied for Functions Collection
 */
class Functions
{
	public static function clean($str) 
	{
        $str = @trim($str);
        $str = strip_tags(stripslashes($str));
        return $str;
    }

}