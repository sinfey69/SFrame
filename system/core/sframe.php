<?php
if(!defined('ROOT'))
{
	die('No direct script access allowed');
}
// 环境配置
switch($environtment)
{
	case 'development':
		ini_set('display_errors', 'On');
		error_reporting(E_ALL);
		break;
	case 'production':
		ini_set('display_errors', 'Off');
		error_reporting(0);
		break;
	default:
		exit('The application environment is not set correctly.');
}
// 时区设置
date_default_timezone_set($timezone);

require_once (SYS . 'core/common.php');
// load_class('controller', 'core');
require_once (SYS . 'core/controller.php');

function &get_instance()
{
	return controller::get_instance();
}
// 定位控制器
$control = new Controller();
if(file_exists(APP . 'controllers/' . $control->route()->controller . '.php'))
{
	include APP . 'controllers/' . $control->route()->controller . '.php';
}
else
{
	// 根据环境报错处理
	if($environtment === 'development')
	{
		die('The file ' . $control->route()->controller . '.php was not found');
	}
	else
	{
		die('<h1>404</h1>Page not found</h1>');
	}
}
/*
 * ------------------------------------------------------ Load core file ------------------------------------------------------
 */
load_class('DbBase', 'databases');
load_class('DbConfig', 'config');
load_class('CommonPage', 'lib');
load_class('FormCheck', 'lib');
load_class('FormFilter', 'lib');

// call controller class
$controller = $control->route()->controller;
if(class_exists($controller))
{
	$controller = new $controller();
}
else
{
	if($environtment === 'development')
	{
		die('The class ' . $controller . ' on ' . $router->controller . '.php was not found');
	}
	else
	{
		die('<h1>404</h1>Page not found</h1>');
	}
}
// call action
if(!in_array($control->route()->action, array_map('strtolower', get_class_methods($controller))))
{
	if($environtment === 'development')
	{
		die(
			'The <em>' . $control->route()->controller . '</em> controller with <em>' . $control->route()->action .
				 '</em> action was not found.');
	}
	else
	{
		die('<h1>404</h1>Page not found</h1>');
	}
}
// Call the $controller->$control->route()->action() method with arguments
call_user_func_array(array($controller,$control->route()->action), (array)$control->route()->params);

unset($environtment, $controller);
