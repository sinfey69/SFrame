<?php
if(!defined('ROOT'))
	die('No direct script access allowed');

class MY_FormFilter extends FormFilter
{

	public static function int($str)
	{
		return (int)$str;
	}
	
	public static function string($str)
	{
		return trim($str);
	}
}
?>