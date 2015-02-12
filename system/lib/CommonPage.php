<?php
class CommonPage extends Controller
{
	public static function successPage($message, $url = FALSE, $urlName = "返回")
	{
		if(!$url)
		{
			if(isset($_SERVER['HTTP_REFERER']))
			{
				$url = $_SERVER['HTTP_REFERER'];
			}
			else
			{
				$url = baseUrl();
			}
		}
		$data['message'] = $message;
		if(is_array($url))
		{
			$data['url'] = $url;
		}
		else
		{
			$data['url'] = array($url => $urlName);
		}
		$control = new Controller();
		$control->loader->view('common/success', $data);
	}

	public static function errorPage($message, $url = FALSE, $urlName = "返回")
	{
		if(!$url)
		{
			if(isset($_SERVER['HTTP_REFERER']))
			{
				$url = $_SERVER['HTTP_REFERER'];
			}
			else
			{
				$url = baseUrl();
			}
		}
		$data['message'] = $message;
		if(is_array($url))
		{
			$data['url'] = $url;
		}
		else
		{
			$data['url'] = array($url => $urlName);
		}
		$control = new Controller();
		$control->loader->view('common/error', $data);
	}
}