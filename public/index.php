<?php

error_reporting(E_ALL);

ini_set('display_errors', 1);

define("PROJECTPATH", dirname(__DIR__));

define("APPPATH", PROJECTPATH . '/App');

define("APP", PROJECTPATH . '/App');

define("LAYOUTSPATH", dirname(__DIR__) .'/public/layouts');

define("LAYOUTS", PROJECTPATH . '/Views/Layouts/');

define("VENDORPARTH", PROJECTPATH . '/vendor/autoload.php');

require VENDORPARTH;

$app = new \Core\App;

$app->render();