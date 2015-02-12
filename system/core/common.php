<?php
if(!defined('ROOT'))
	die('No direct script access allowed');

/**
 * 加载配置
 * @param string $string
 * @return unknown|string
 */
function config($string = 'No item selected.')
{
	if(!file_exists(APP . 'config/config.php'))
		die('Configuration file doesn\'t exist.');
	require APP . '/config/config.php';
	if(isset($config))
	{
		if(isset($config[$string]))
		{
			return $config[$string];
		}
		else
		{
			return '';
		}
	}
	else
	{
		die('Error configuration file format, no items variable.');
	}
}

/**
 * 站点url(带入口文件)
 * @return string
 */
function siteUrl($params = '')
{
	$params = trim($params, '/');
	$indexpage = trim(config('indexPage'), '/');
	
	$url = baseUrl() . $indexpage;
	$url = $url . '/' . $params;
	if($params != '')
	{
		$urlsuffix = trim(config('urlSuffix'), '/');
		if($urlsuffix != '')
		{
			$url = $url . '.' . $urlsuffix;
		}
	}
	return $url;
}

/**
 * 站点url
 * @return string
 */
function baseUrl()
{
	$base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on")? "https" :"http");
	$base_url .= "://" . $_SERVER['HTTP_HOST'];
	$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
	$base_url = trim($base_url, '/') . '/';
	return $base_url;
}

/**
 * 过滤URL的非法字符
 * @param string $str
 * @param string $url_encoded
 * @return Ambigous <string, mixed>
 */
function removeInvisibleCharacters($str = '', $url_encoded = TRUE)
{
	$non_displayables = array();
	
	if($url_encoded)
	{
		$non_displayables[] = '/%0[0-8bcef]/'; // url encoded 00-08, 11, 12, 14, 15
		$non_displayables[] = '/%1[0-9a-f]/'; // url encoded 16-31
	}
	
	$non_displayables[] = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S'; // 00-08, 11, 12, 14-31, 127
	do
	{
		$str = preg_replace($non_displayables, '', $str, -1, $count);
	}
	while($count);
	return ($str == '/')? '' :$str;
}

/**
 * 检测URI的非法字符
 * @param string $str
 * @return mixed
 */
function filterUri($str = '')
{
	if($str != '' && config('allowedUriString') != '')
	{
		if(!preg_match(
			"|^[" . str_replace(array('\\-','\-'), '-', preg_quote(config('allowedUriString'), '-')) . "]+$|i", $str))
		{
			print_r('Your URI request was not permitted.');
			exit();
		}
	}
	
	$bad = array('$','(',')','%28','%29');
	$good = array('&#36;','&#40;','&#41;','&#40;','&#41;');
	return str_replace($bad, $good, $str);
}

/**
 * 加载类
 * @param unknown $class
 * @param string $directory
 */
function load_class($class, $directory = 'libraries')
{
	// Look for the class first in the local application/libraries folder
	// then in the native system/libraries folder
	foreach(array(APP,SYS) as $path)
	{
		if(file_exists($path . $directory . '/' . $class . '.php'))
		{
			if(class_exists($class) === FALSE)
			{
				require_once ($path . $directory . '/' . $class . '.php');
			}
			
			break;
		}
	}
	// Is the request a class extension? If so we load it too
	if(file_exists(APP . $directory . '/' . config('subClassPrefix') . $class . '.php'))
	{
		$name = config('subClassPrefix') . $class;
		if(class_exists($name) === FALSE)
		{
			require_once(APP . $directory . '/' . config('subClassPrefix') . $class . '.php');
		}
	}
}

/**
 * 日志
 * 
 * @param unknown $file        	
 * @param unknown $message        	
 * @param string $setRs        	
 */
function setLog($file, $message, $setRs = '')
{
	$file = $file . date("_Y-m-d") . '.log';
	if(is_array($message))
	{
		if(count($message) != count($message, 1)) // 多维数组
		{
			foreach($message as $key => $var)
			{
				if(is_array($var))
				{
					$message[$key] = json_encode($var);
				}
			}
		}
		$message = implode($message, '] [');
	}
	$message = date("[Y-m-d H:i:s]") . "[" . getIp() . "] [" . $message . "]";
	$message .= $setRs? '[' . $setRs . ']' . "\n" :'' . "\n";
	$flag = file_exists($file)? FALSE :TRUE;
	error_log($message, 3, $file);
	if($flag)
	{
		chmod($file, 0777);
	}
}

/**
 * 获取IP
 * 
 * @return string
 */
function getIp()
{
	if(php_sapi_name() == 'cli' || defined('STDIN'))
	{
		// CLI模式
		return '0.0.0.0';
	}
	if(getenv('HTTP_CLIENT_IP'))
	{
		$ip = getenv('HTTP_CLIENT_IP');
	}
	elseif(getenv('HTTP_X_FORWARDED_FOR'))
	{ // 获取客户端用代理服务器访问时的真实ip 地址
		if(strpos(getenv('HTTP_X_FORWARDED_FOR'), ',') !== false)
		{
			$ips = explode(',', getenv('HTTP_X_FORWARDED_FOR'));
			$ip = trim($ips[count($ips) - 1]);
		}
		else
		{
			$ip = getenv('HTTP_X_FORWARDED_FOR');
		}
	}
	elseif(getenv('HTTP_X_FORWARDED'))
	{
		$ip = getenv('HTTP_X_FORWARDED');
	}
	elseif(getenv('HTTP_FORWARDED_FOR'))
	{
		$ip = getenv('HTTP_FORWARDED_FOR');
	}
	elseif(getenv('HTTP_FORWARDED'))
	{
		$ip = getenv('HTTP_FORWARDED');
	}
	else
	{
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	if(!$ip)
	{
		return '';
	}
	return substr($ip, 0, 15);
}
