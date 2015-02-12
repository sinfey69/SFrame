<?php
$environtment = 'development'; // option: development, production
$application = 'application';
$timezone = 'Asia/Shanghai';
$core = 'system';
// Assign super global
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
define('ROOT', str_replace('\\', '/', getcwd() . '/'));
define('APP', ROOT . $application . '/');
define('SYS', ROOT . $core . '/');
define('EXT', '.php');
define('DEFAULT_LOG', ROOT.'/logs/');
unset($application, $system);
require_once SYS . 'core/sframe.php';