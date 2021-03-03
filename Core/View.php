<?php
namespace Core;

defined("APPPATH") OR die("Access Denied");

class View
{

    protected static $data;
    const VIEWS_PATH 			= "../Views/";
    const EXTENSION_TEMPLATES 	= "php";

    public static function render($template)
    {
        if(!file_exists(self::VIEWS_PATH . $template . "." . self::EXTENSION_TEMPLATES))
        {
            throw new \Exception("Error: El archivo " . self::VIEWS_PATH . $template . "." . self::EXTENSION_TEMPLATES . " no existe", 1);
        }

        ob_start();
        extract(self::$data);
        include(self::VIEWS_PATH . $template . "." . self::EXTENSION_TEMPLATES);
        $str = ob_get_contents();
        ob_end_clean();
        echo $str;
    }

    public static function set($name, $value)
    {
        self::$data[$name] = $value;
    }
}