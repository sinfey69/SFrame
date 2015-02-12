<?php

if(!defined('ROOT'))
	die('No direct script access allowed');

function my_exception_handler()
{
	$errInfo = error_get_last();
	if($errInfo && is_array($errInfo))
	{
		setLog(DEFAULT_LOG.'phperror', var_export($errInfo, true));
	}
}
register_shutdown_function('my_exception_handler');

class MY_controller extends Controller
{
	public function __construct()
	{
		parent::__construct();
		require_once SYS . 'lib/CommonPage.php';
	}
}