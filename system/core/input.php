<?php
if(!defined('ROOT'))
	die('No direct script access allowed');
class Input
{
	/**
	 * 获取和检测传入参数
	 * @param unknown $formField	参数名
	 * @param string $httpMethod	方法
	 * @param array $checkFun		参数检测方法
	 * @param array $filterFun	参数过滤方法
	 * @throws Exception
	 * @return Ambigous <string, mixed>
	 */
	public function filter($formField, $httpMethod = FALSE, $checkFun=array(), $filterFun=array())
	{
		switch($httpMethod)
		{
			case 'POST':
				$value = isset($_POST[$formField])? $_POST[$formField] :'';
				break;
			case 'GET':
				$value = isset($_GET[$formField])? $_GET[$formField] :'';
				break;
			case 'SF':
				$sf = get_instance();
				$params = (array)$sf->route()->params;
				$value = isset($params[$formField])? $params[$formField] :'';
				break;
			default:
				$value = '';
				$httpMethod = null;
				break;
		}
		//值预处理
		if (is_array($filterFun) && $value)
		{
			foreach ($filterFun as $func)
			{
				if(method_exists(config('subClassPrefix').'FormFilter', $func))
				{
					$class = config('subClassPrefix').'FormFilter';
				}
				else 
				{
					$class = 'FormFilter';
				}
				$value = $class::$func($value);
			}
		}
		//值检测
		if (is_array($checkFun) && $value)
		{
			foreach ($checkFun as $func => $err_msg)
			{
				if(method_exists(config('subClassPrefix').'FormCheck', $func))
				{
					$class = config('subClassPrefix').'FormCheck';
				}
				else
				{
					$class = 'FormFilter';
				}
				if (! $class::$func($value))
				{
					throw new Exception($err_msg);
					break;
				}
			}
		}
		return removeInvisibleCharacters($value);
	}

}