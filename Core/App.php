<?php

namespace Core;

defined("APPPATH") OR die("Access denied");

use \core\Cypher;
use \Core\CypherData;
use \App\Lib\Chart;
use \App\Lib\SendEmail;
use PDO;
use \Core\Database;
use \App\Lib\ApiMikrowsip;



require VENDORPARTH;

class App
{
    public $_controller;

    public $_method = "index";

    public $_params = [];

    const NAMESPACE_CONTROLLERS = "\App\Controllers\\";

    const CONTROLLERS_PATH = "../App/Controllers/";

    public function __construct()
    {
        $url = $this->parseUrl();

        // ddd($url[0]);

        if(file_exists(self::CONTROLLERS_PATH.ucfirst($url[0]) . "Controller.php"))
        {
            
            $this->_controller = ucfirst($url[0]);

            unset($url[0]);

        }
        elseif(!isset($url))
        {

            $this->_controller = "Home";
        }
        else
        {
            // ddd(ucfirst($url[0]));

            if(ucfirst($url[0]) == "Logout"){
                
                session_start();

                session_destroy(); 
                
                header('Location: index.php');
                exit;

            }else{

                header('Location: index.php?url=error');
                exit;
            }

            header('Location: index.php?url=error');
            exit;
        }

        $fullClass = self::NAMESPACE_CONTROLLERS.$this->_controller."Controller";

        $this->_controller = new $fullClass;

        $GLOBALS['controller'] = $this->_controller;

        if(isset($url[1]))
        {

            $this->_method = $url[1];

            $GLOBALS['method'] = $this->_method;

            if(method_exists($this->_controller, $url[1]))
            {
               
                unset($url[1]);

            }
            else
            {
                
                header('Location: index.php?url=error');
                exit;

            }
        }

        $this->_params = $url ? array_values($url) : [];

        $GLOBALS['params'] = $this->_params;

    }


    public function parseUrl()
    {
        if(isset($_GET["url"]))
        {
            return explode("/", filter_var(rtrim($_GET["url"], "/"), FILTER_SANITIZE_URL));
        }
    }


    public function render()
    {
        // ddd([$this->_controller, $this->_method], $this->_params);
        call_user_func_array([$this->_controller, $this->_method], $this->_params);
    }

    public static function getConfig()
    {
        return parse_ini_file(APPPATH . '/Config/config.ini');
    }

    public static function getCypherData()
    {
        
        $config = parse_ini_file(APPPATH . '/Config/config.ini');

        return $cypher = new CypherData($config['key']);

    }

    public static function getChart($chart, $name)
    {
        return new Chart($chart, $name);
    }

    public static function getController()
    {
        return $GLOBALS['controller'];
    }

    public static function getMethod()
    {
        return $GLOBALS['method'];
    }

    public static function getParams()
    {
        return $GLOBALS['params'];
    }

    public static function getEmailValid($email)
    {
        return filter_var(strip_tags($email), FILTER_VALIDATE_EMAIL);
    }

    public static function getIntValid($int)
    {
        return filter_var(strip_tags($int), FILTER_VALIDATE_INT);
    }
    
    public static function getStrValid($str)
    {
        return strip_tags($str);
    }

    public static function Random($longitud) 
    {
        $key = '';
        $pattern = '123456789';
        $max = strlen($pattern)-1;
        for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
        return $key;
    }

    public static function DataBaseQuery($query)
    {
        try {
            $connection = Database::instance();
            $sql    =   $query;
            $query  =   $connection->prepare($sql);
            $query->execute();

            $res    =   $query->fetchAll(PDO::FETCH_ASSOC);

            return ($res) ? $res : false;

        } catch (Exception $e) {

            return "Error!: " . $e->getMessage();

        }
    }

    public static function DataBaseExecute($query)
    {
        try {
            $connection = Database::instance();
            $sql    =   $query;
            $query  =   $connection->prepare($sql);

            return ($query->execute()) ? true : false;

        } catch (Exception $e) {

            return "Error!: " . $e->getMessage();

        }
    }

    public static function DataQuery($params)
    {
       if($params <> false)
       {
            $data = [];
            foreach ($params as $key => $value) {
                $card =     App::getCypherData()->descifrarTarjeta($value['cyphercard']);
                $data['card'] = $card['number'];
                $TDC[$key]  =   [
                    'id'        =>  $value['id'],
                    'idCard'    =>  $value['id'],
                    'idClient'  =>  $value['idClient'],
                    'card'      =>  $card['number'],
                    'xxx'       =>  App::HiddenCard($card['number']),
                    'last'      =>  App::LastCard($data),
                    'name'      =>  $card['name'],
                    'batch'     =>  $value['batch'],
                    'exp'       =>  $card['exp'],
                    'cvv'       =>  $card['cvv'],
                    'status'    =>  $value['status'],
                    'operation' =>  true
                ];
            }

       }else{
            $TDC = 'Error.! You can not use this option, it does not have associated cards';
       }

        return   [
            'operation' =>  ($TDC == 'Error.! You can not use this option, it does not have associated cards')  ? false : true,
            'data'      =>  ($TDC == 'Error.! You can not use this option, it does not have associated cards')  ? $TDC  : $TDC
        ];
    }

    public static function DataPreCard($params)
    {
        $TDC = "";
        if($params <> false){
            foreach ($params as $key => $value) 
            {
                $TDC  =   [
                    'idCard'    =>  $value['idCard'],
                    'idClient'  =>  $value['idClient'],
                    'card'      =>  App::getCypherData()->descifrarTarjeta($value['cyphercard']),
                    'name'      =>  $value['name'],
                    'status'    =>  $value['status'],
                    'duplicate' =>  $value['duplicated'],
                    'update_at' =>  $value['update_at'],
                    'random'    =>  $value['random']
                ];
            }
        }

        return $TDC;
    }

    Public static function HiddenCard($params)
    {
        if(strlen($params) <= 15){
            $cc = str_pad(mb_substr($params, -8 ), 15, 'X', STR_PAD_LEFT);
        }

        if(strlen($params) > 15){
            $cc = str_pad(mb_substr($params, -8 ), 16, 'X', STR_PAD_LEFT);
        }

        return $cc;
    }

    public static function TypeCard($params)
    {
        $card   =   substr($params['card'],0,2);

        $n      =   strlen($card);

        if ($n == 2) {
            if($card >=0 && $card <= 33){
                $resutl =   "OTHER";
            }
            if($card >=34 && $card <= 39){
                $resutl =   "AMEX";
            }
            if ($card >=40 && $card <=49){
                $resutl =   "VISA";
            }
            if($card >=51 && $card <= 59){
                $resutl =   "MCRD";
            }
            if($card >=60 && $card <= 69){
                $resutl =   "DINE";
            }
            if($card >= 70 && $card <= 99){
                $resutl =   "OTHER";
            }
        }
        return $resutl;
    }

    public static function LastCard($params)
    {
        if(strlen($params['card']) <= 15){
            $cc = mb_substr(trim(substr($params['card'], 0,15)), -8);
        }

        if(strlen($params['card']) > 15){
            $cc = mb_substr(trim(substr($params['card'], 0,16)), -8);
        }

        return $cc;
    }


    public static function Remove_Characters($string){

        $string = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä', 'Ã'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A', 'A'),
            $string
        );

        $string = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $string );

        $string = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $string );

        $string = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $string );
     
        $string = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $string );
     
        $string = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C'),
            $string
        );
     
        return $string;
    }

    public static function Remove_Html($string){

        $string = str_replace(
            array('&lt;html&gt;', '&lt;head&gt;', '&lt;title&gt;&lt;/title&gt;', '&lt;/head&gt;', '&lt;body&gt;', '&lt;p&gt;', '&amp;nbsp;&lt;/p&gt;', '&lt;/body&gt;', '&lt;/html&gt;', '&amp;nbsp;', '.&lt;/p&gt;', '&lt;/p&gt;'),
            array('', '', '', '', '', '', '', '', '', '', '', ''),
            $string
        );
     
        return $string;
    }

}