<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'includes/root.php';
$_root_folder = $_SERVER['DOCUMENT_ROOT'] . "$_application_folder";

//load acces_control
require_once $_root_folder. '/acces_control.php';

//load services
require_once $_root_folder. '/Service/Container.php';
require_once $_root_folder. '/api/ApiActions.php';

//load config_settings
require_once $_root_folder. '/includes/config.php';

//new container object with config settings
$container = new Container($configuration);
