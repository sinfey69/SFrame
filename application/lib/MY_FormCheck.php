<?php

if(!defined('ROOT'))
	die('No direct script access allowed');

class MY_FormCheck extends FormCheck
{

	/**
	 * 校验长度
	 * @param string $str
	 * @return boolean
	 */
	public static function isNumber($str)
	{
		if (preg_match("/^[0-9]+$/", $str))
		return true;
		return false;
	}
	
}
?>