<?php 

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('SITE_ROOT') ? null : define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT']. '/php_oop_gallery');

defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT. DS .'admin'. DS .'includes');

require_once("functions.php");
require_once("config.php");
require_once("Database.php");
require_once("Db_object.php");
require_once("User.php");
require_once("Photo.php");
require_once("Session.php");

?>