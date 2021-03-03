<?php

namespace Core;

defined("APPPATH") OR die("Access Denied");

use \Core\App;

/**
 * 
 */
class Database
{
	Private 	$_dbUser;
	private 	$_dbPassword;
	private 	$_dbHost;
	private 	$_dbName;
	private 	$_connection;

	private static $_instance;

	private function __construct()
    {
       try {
		    //load from config/config.ini
		    $config             = App::getConfig();

		    $this->_dbHost      = $config["host"];
		    $this->_dbUser      = $config["user"];
		    $this->_dbPassword  = $config["password"];
		    $this->_dbName      = $config["database"];
 
 			$this->_connection    = new \PDO('mysql:host='.$this->_dbHost.'; dbname='.$this->_dbName, $this->_dbUser, $this->_dbPassword);
           	$this->_connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
           	$this->_connection->exec("SET CHARACTER SET utf8");
       }
       catch (\PDOException $e)
       {
           print "Error! en conexion silex: " . $e->getMessage();
           die();
       }
    }

    public function prepare($sql)
    {
    	return $this->_connection->prepare($sql);
    }

    public static function instance()
    {
    	if(!isset(self::$_instance))
    	{
    		$class = __CLASS__;
    		self::$_instance = new $class;
    	}

    	return self::$_instance;
    }

    public function __clone()
    {
    	trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
    }

    public function close()
    {
      self::$_instance = null;
    }
    public function lastId()
    {
      return $this->_connection->lastInsertId();
    }

/////////////////////////////////////////////////////////////////////////////////

  public static function DBQuery($query)
  {
    try {
      $connection = Database::instance();
      $sql        =   $query;
      $query      =   $connection->prepare($sql);
      $query->execute();

      $res        =   $query->fetch(PDO::FETCH_ASSOC);

      return ($res) ? $res : false;

    } catch (Exception $e) {

      return "Error!: " . $e->getMessage();

    }
  
  }

/////////////////////////////////////////////////////////////////////////////////

  public static function DBQueryAll($query)
  {
    try {
      $connection = Database::instance();
      $sql        =   $query;
      $query      =   $connection->prepare($sql);
      $query->execute();

      $res        =   $query->fetchAll(PDO::FETCH_ASSOC);

      return ($res) ? $res : false;

    } catch (Exception $e) {

      return "Error!: " . $e->getMessage();

    }
  
  }

/////////////////////////////////////////////////////////////////////////////////

  public static function DataExecute($query)
  {
    try {
        $connection =   Database::instance();
        $sql        =   $query;
        $query      =   $connection->prepare($sql);

        return ($query->execute()) ? true : false;

    } catch (Exception $e) {

        return "Error!: " . $e->getMessage();

    }
  
  }

/////////////////////////////////////////////////////////////////////////////////

  public static function DataExecuteLastID($query)
  {
    try {
        $connection =   Database::instance();
        $sql        =   $query;
        $query      =   $connection->prepare($sql);
        $rest       =   ($query->execute()) ? true : false;
        $id         =   $connection->lastId();
        
        return ($rest == true) ? $id : false;

    } catch (Exception $e) {

        return "Error!: " . $e->getMessage();

    }

  }

}