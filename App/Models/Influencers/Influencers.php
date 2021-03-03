<?php 

namespace App\Models\Influencers;

require VENDORPARTH;

defined("APPPATH") OR die("Access Denied");

use \Core\App;
use \Core\Database;
use \App\Models\Auth\Auth;
use PDO;

use \App\Lib\Collection\Functions;

use App\Lib\Collection\Authorize;

/**
 *  Class Desing for Influencers Model
 */

class Influencers
{

////////////////////////////////////////////////////////////////////////////////////////////////

    public static function SaveReg($iData)
    {
        $query  =   'INSERT INTO influencers(nombre, email, descripcion, url, pais, idioma, publicidad, services, img, type, size, vacaciones, vacaciones_ini, vacaciones_end, if_check, if_package, if_promo, iv_check, iv_package, iv_promo, is_check, is_package, is_promo, created_at, updated_at) VALUES ("'.$iData['name'].'", "'.$iData['email'].'", "'.$iData['descripcion'].'", "'.$iData['url'].'", "'.$iData['pais'].'", "'.$iData['idioma'].'", "'.$iData['i_adv'].'", "'.$iData['i_cat'].'", "", "", "", "'.$iData['i_vac'].'", "'.$iData['i_ini'].'", "'.$iData['i_end'].'", "0", "0", "0", "0", "0", "0", "0", "0", "0", NOW(), NOW())';
        $iData  =   Database::DataExecuteLastID($query);  

        return  ($iData <> false) ? $iData : false;
    }

////////////////////////////////////////////////////////////////////////////////////////////////

    public static function UpdateReg($iData)
    {
        $query =   'UPDATE influencers SET if_check = "'.$iData['if_check'].'", if_package = "'.$iData['if_package'].'", if_promo = "'.$iData['if_promo'].'", iv_check = "'.$iData['iv_check'].'", iv_package = "'.$iData['iv_package'].'", iv_promo = "'.$iData['iv_promo'].'", is_check = "'.$iData['is_check'].'", is_package = "'.$iData['is_package'].'", is_promo = "'.$iData['is_promo'].'", updated_at = NOW() WHERE id = "'.$iData['id'].'"';

        $iData  =   Database::DataExecute($query);  

        return  ($iData <> false) ? true : false;


    }


////////////////////////////////////////////////////////////////////////////////////////////////

}