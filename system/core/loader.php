<?php
if(!defined('ROOT'))
	die('No direct script access allowed');
/**
 * 加载类
 * @author qiuxh
 *
 */
class Loader
{

	protected $_ob_level;

	public function __construct()
	{
		$this->_ob_level = ob_get_level();
	}

	/**
	 * 视图
	 * 
	 * @param string $_sf_name        	
	 * @param array $_sf_data        	
	 * @param string $_sf_return
	 *        	FALSE显示视图
	 * @return string
	 */
	public function view($_sf_name = '', $_sf_data = array(), $_sf_return = FALSE)
	{
		if(is_array($_sf_data))
		{
			extract($_sf_data);
		}
		
		$view_path = APP . 'views/' . $_sf_name . '.php';
		
		if(!file_exists($view_path))
		{
			die('Unable to load the requested view file <em>' . $_sf_name . '.php</em>');
		}
		
		ob_start();
		include $view_path;
		
		if($_sf_return === TRUE) // return data else print data
		{
			$buffer = ob_get_contents();
			@ob_end_clean();
			return $buffer;
		}
		
		if(ob_get_level() > $this->_ob_level + 1)
		{
			ob_end_flush();
		}
	}

	/**
	 * 加载模型
	 * 
	 * @param string $name        	
	 */
	public function model($name = '')
	{
		if(file_exists(APP . 'models/' . $name . '.php'))
		{
			return require_once (APP . 'models/' . $name . '.php');
		}
		else
		{
			die('Unable to load the model file <em>' . $name . '.php<em>');
		}
	}

	/**
	 * 加载lib
	 * 
	 * @param string $name        	
	 * @return unknown
	 */
	public function library($name = '')
	{
		$name = strtolower($name);
		
		if(file_exists(SYS . 'libraries/' . $name . '.php'))
		{
			return require_once (SYS . 'libraries/' . $name . '.php');
		}
		elseif(file_exists(APP . 'libraries/' . $name . '.php'))
		{
			return require_once (APP . 'libraries/' . $name . '.php');
		}
		else
		{
			die('Unable to load library file <em>' . $name . '.php<em>');
		}
	}

	/**
	 * 加载help
	 * 
	 * @param string $name        	
	 */
	public function helper($name = '')
	{
		if(!file_exists(APP . 'helpers/' . $name . '.php'))
		{
			die('Unable to load helper file <em>' . $name . '.php</em>');
		}
		return require_once (APP . 'helpers/' . $name . '.php');
	}
}
