<?php

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'testing'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

/** Zend_Application */
require_once 'My/App.php';

// Create application, bootstrap, and run
$application = new My_App(APPLICATION_ENV);

$application->bootstrap()
            ->run();
            
/*require_once 'Zend/Controller/Front.php';
$front = Zend_Controller_Front::getInstance();
$front->addModuleDirectory(APPLICATION_PATH."/modules");
$front->dispatch();*/
?>
