<?php

// Define base path
defined('BASE_PATH') || define('BASE_PATH', dirname(__FILE__));

// Define path to application directory
defined('ZF_PATH') || define('ZF_PATH', realpath(BASE_PATH . '/../../ZendFramework'));

// Define path to application directory
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(BASE_PATH . '/../application'));

// Define path to library directory
defined('LIBRARY_PATH') || define('LIBRARY_PATH', realpath(BASE_PATH . '/../library'));

// Define application environment
defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(ZF_PATH, LIBRARY_PATH, get_include_path())));

// Create application, bootstrap, and run
require_once 'Lumia/Application.php';
$application = new Lumia_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.php');
$application->bootstrap()->run();
