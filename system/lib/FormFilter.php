<?php
if(!defined('ROOT'))
	die('No direct script access allowed');
/**
 * Form值过滤
 * @author qiuxh
 *
 */
class FormFilter
{

	public static function int($str)
	{
		return (int)$str;
	}
	
	public static function isTelPhone($str)
	{
		return trim($str);
	}
}
?>