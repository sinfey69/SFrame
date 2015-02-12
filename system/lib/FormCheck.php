<?php
if(!defined('ROOT'))
	die('No direct script access allowed');
class FormCheck
{

	/**
	 * 校验是否是数字
	 * 
	 * @param string $str        	
	 * @return boolean
	 */
	public static function isNumber($str)
	{
		if(preg_match("/^[0-9]+$/", $str))
			return true;
		return false;
	}

	public static function isTelPhone($str)
	{
		if(preg_match("/(\d{3}-)(\d{8})$|(\d{4}-)(\d{7,8})$/", $str) || preg_match("/^1(3|4|5|8)[0-9]{9}$/", $str))
			return true;
		return false;
	}

	/**
	 * 校验是否是正确区号
	 * 
	 * @param string $str        	
	 * @return boolean
	 */
	public static function isQuhao($str)
	{
		if(preg_match("/^\d{3,4}$/", $str))
			return true;
		return false;
	}

	public static function isHaoma($str)
	{
		if(preg_match("/^\d{7,8}$/", $str))
			return true;
		return false;
	}

	/**
	 * 校验是否是qq
	 * 
	 * @param string $str        	
	 * @return boolean
	 */
	public static function isQq($str)
	{
		if(preg_match("/^\d{5,11}$/", $str))
			return true;
		return false;
	}

	/**
	 * 校验价格是否大于200
	 * 
	 * @param string $str        	
	 * @return boolean
	 */
	public static function isPrice($str)
	{
		if(200 > $str)
			return false;
		return true;
	}

	/**
	 * 校验是否是数字
	 * 
	 * @param string $str        	
	 * @return boolean
	 */
	public static function isMobile($str)
	{
		if(preg_match("/^1(3|4|5|8)[0-9]{9}$/", $str))
			return true;
		return false;
	}

	/**
	 *
	 *
	 * 校验是否是电话号码
	 * 
	 * @param string $str
	 *        	eg: xxx-xxxxxxxx-xxx | xxxx-xxxxxxx-xxx ...|xxxx-xxxxxxxx
	 */
	public static function isPhone($str)
	{
		if(preg_match("/^0[0-9]{2,3}-[0-9]{7,8}-([0-9]{0,6}?)$/", $str))
			return true;
		return false;
	}

	/**
	 *
	 *
	 * 校验是否是传真号码
	 * 
	 * @param string $str
	 *        	eg: xxx-xxxxxxxx-xxx | xxxx-xxxxxxx-xxx ...|xxxx-xxxxxxxx
	 */
	public static function isFax($str)
	{
		if(preg_match("/^0[0-9]{2,3}-[0-9]{7,8}(-[0-9]{0,6}?)$/", $str))
			return true;
		return false;
	}

	/**
	 * 校验是否是邮政编码
	 * 
	 * @param string $str        	
	 * @return boolean
	 */
	public static function isPostcode($str)
	{
		if(preg_match("/^[0-9]{6}$/", $str))
			return true;
		return false;
	}

	/**
	 * 校验是否是电子邮箱
	 * 
	 * @param string $str        	
	 * @return boolean
	 */
	public static function isEmail($str)
	{
		return filter_var($str, FILTER_VALIDATE_EMAIL);
	}

	/**
	 * 校验是否都是中文
	 * 
	 * @param string $str        	
	 * @return boolean 简要描述：姓名昵称合法性检查，中文姓名
	 */
	public static function isChinese($str)
	{
		if(preg_match("/^[\x80-\xff]+$/i", $str))
		{
			return true;
		}
		return false;
	}

	/**
	 * 校验是否都是英文
	 * 
	 * @param string $str        	
	 * @return boolean 简要描述：姓名昵称合法性检查，中文姓名
	 */
	public static function isEnglish($str)
	{
		if(preg_match("/^[a-zA-Z]+$/", $str))
		{
			return true;
		}
		return false;
	}

	/**
	 * 校验是否有空格和英文组合
	 */
	public static function isEnglishAndSpace($str)
	{
		if(preg_match("/^([a-zA-Z]+\s*)+$/", $str))
		{
			return true;
		}
		return false;
	}

	/**
	 * 密码合法性检查
	 * 
	 * @param string $str        	
	 * @return boolean 简要描述：只能是6-16位的
	 */
	public static function isPassword($str)
	{
		if(preg_match("/^[0-9a-zA-Z]{6,16}$/", $str))
			return true;
		return false;
	}

	/**
	 * 检查是否含有中文
	 * 
	 * @param string $str        	
	 * @return boolean
	 */
	public static function isContainChinese($str)
	{
		if(preg_match("/^.*[\x80-\xff]+.*$/", $str))
		{
			return true;
		}
		return false;
	}

	/**
	 * 检查是否是拼音，不包含中文
	 */
	public static function isPinYin($str)
	{
		if(preg_match("/^.*[\x80-\xff]+.*$/", $str))
		{
			return false;
		}
		return true;
	}

	/**
	 * 检测字符串的长度，支持汉字[utf-8]，如果max 存在，检查是否在[min,max]范围，返回boolean
	 * 如果max不存在 返回字符串长度 int
	 * 
	 * @param string $str        	
	 * @param int $min        	
	 * @param int $max        	
	 * @return int
	 * @author zougc
	 */
	public static function checkStringLen($str, $max = 0, $min = 0)
	{
		if(empty($str) || $min > $max)
		{
			return FALSE;
		}
		$str_len = 0;
		$length = strlen(preg_replace('/[\x00-\x7F]/', '', $str));
		if($length)
		{
			$str_len = strlen($str) - $length + intval($length / 3);
		}
		else
		{
			$str_len = strlen($str);
		}
		if($max)
		{
			if($max >= $str_len && $str_len >= $min)
				return true;
			else
				return false;
		}
		else
			return $str_len;
	}

	/**
	 * 返回整数，如果失败返回0
	 * 
	 * @param string $string        	
	 * @return int
	 * @author zougc
	 */
	public static function getIntNumber($string)
	{
		return is_numeric($string)? intval($string) :0;
	}

	/**
	 *
	 *
	 * 判断是否是空
	 * 
	 * @param string $str        	
	 */
	public static function isNull($str)
	{
		if($str == "")
			return true;
		return false;
	}

	/**
	 *
	 *
	 * 判断是否是IP地址
	 * 
	 * @param string $val        	
	 */
	public static function isIp($val)
	{
		if(preg_match("/^(\d){1,3}\.(\d){1,3}\.(\d){1,3}\.(\d){1,3}$/", $val))
			return true;
		return false;
	}

	/**
	 * 判断是否是中文(只能中文)
	 *
	 * @param string $String        	
	 * @return boolean
	 * @author hush
	 */
	public static function isCn($String)
	{
		if(preg_match("/^[\x{4e00}-\x{9fa5}]+\S+$/u", $String))
			return TRUE;
		return FALSE;
	}

	/**
	 * 检查验证码合法性,可以校验验证码的长度
	 * 
	 * @param string $str        	
	 * @param int $len        	
	 * @return boolen
	 * @author wangjd 2010-11-29
	 */
	public static function isCaptcha($str)
	{
		if(preg_match("/^[a-zA-Z0-9]$/", $str))
			return true;
		return false;
	}

	/**
	 * 日期合法性检查
	 * 
	 * @param string $str        	
	 * @return boolen
	 * @author wangjd 2010-12-02
	 */
	public static function isDate($str)
	{
		if(preg_match("/^[0-9]{4}\-(0[1-9]|1[0-2])\-(0[1-9]|(1|2|3)[0-9])$/", $str))
			return true;
		return false;
	}

	/**
	 * 合法的地址 英文
	 * 
	 * @param string $str        	
	 * @return boolean
	 * @author zougc
	 */
	public static function isOkAddress($str)
	{
		if(preg_match("/^[a-zA-z0-9-\s+#]*$/", $str))
			return true;
		return false;
	}

	/**
	 * 支持英文和空格 省份 城市的验证
	 */
	public static function isOKEngString($str)
	{
		if(preg_match("/^[a-zA-z\s+]*$/", $str))
			return true;
		return false;
	}

	/**
	 * 充值金额格式检查,保留两位小数
	 * 
	 * @param string $str        	
	 * @author arden
	 */
	public static function checkMoney($str)
	{
		if(preg_match('/^[0-9]{1,9}(\.[0-9]{0,2})?$/', $str))
		{
			return true;
		}
		return false;
	}

	/**
	 * 银行卡号只显示后位
	 * 
	 * @param string $str        	
	 */
	public static function bankFormat($str)
	{
		$strFormat = '';
		$str = trim($str);
		$len = strlen($str);
		$str = substr_replace($str, '************', 0, $len - 4);
		return $str;
		// $len = strlen($str);
		// if ($len >= 19) $strFormat = preg_replace('/(\d{15})(\d+)/','******${2}',$str);
		// else if($len == 18) $strFormat = preg_replace('/(\d{14})(\d+)/','******${2}',$str);
		// else if($len == 17) $strFormat = preg_replace('/(\d{13})(\d+)/','******${2}',$str);
		// else if($len == 16) $strFormat = preg_replace('/(\d{12})(\d+)/','******${2}',$str);
		// else $strFormat = preg_replace('/\d+/','******',$str);
		// return $strFormat;
	}

	/**
	 * 金额4位转为2为 ename lusb
	 *
	 * @param string $str        	
	 * @return string
	 */
	public static function toMoney($str)
	{
		return sprintf("%1\$.2f", $str);
	}

	/**
	 * 淘域名过滤http及。等符号
	 * 2013-08-08 Wulx Add
	 */
	public static function taoCheckDomain($domain)
	{
		$domain = trim($domain);
		$domain = preg_replace('/(http[s]?:\/\/)/', '', $domain);
		$domain = preg_replace('/。/', '.', $domain);
		$domain = str_replace(array(",","，"), ",", $domain);
		if(strpos($domain, ","))
		{
			return true; // 淘域名多关键字搜索直接返回true
		}
		if(strpos($domain, '.')) // 有后缀 domain
		{
			if(!self::checkFullDomain($domain))
			{
				return false;
			}
		}
		else // 无后缀 sld
		{
			if(!self::checkDomainSLD($domain))
			{
				return false;
			}
		}
		return true;
	}

	/**
	 * 检查搜索域名格式是否正确
	 * 2012-01-14	Qxh	Add
	 */
	public static function checkDomain($domain)
	{
		$domain = trim($domain);
		if(strpos($domain, '.')) // 有后缀 domain
		{
			if(!self::checkFullDomain($domain))
			{
				return false;
			}
		}
		else // 无后缀 sld
		{
			if(!self::checkDomainSLD($domain))
			{
				return false;
			}
		}
		return true;
	}

	/**
	 * checkFullDomain
	 * 检验域名是否格式正确(含.)
	 * 2012-01-14	Qxh	Add
	 */
	public function checkFullDomain($domain)
	{
		$ok = FALSE;
		if(preg_match("/^([\x{4e00}-\x{9fa5}]|[a-zA-Z0-9-])+(\.[a-z]{2,4})?\.([a-z]|[\x{4e00}-\x{9fa5}]){2,4}$/ui", 
			$domain))
		{
			if(substr($domain, 0, 1) != '-' && stripos($domain, '--') === FALSE) // 去掉-开头的域名
			{
				$ok = true;
			}
		}
		return $ok;
	}

	/**
	 * checkDomainSLD
	 * 检查域名second level domain 二级域名是否正确
	 * 2012-01-14	Qxh	Add
	 */
	public function checkDomainSLD($doaminSLD)
	{
		$ok = FALSE;
		if(preg_match("/^([\x{4e00}-\x{9fa5}]|[a-zA-Z0-9-])+$/ui", $doaminSLD))
		{
			if(stripos($doaminSLD, '--') === FALSE &&
				 ($_SERVER['REQUEST_METHOD'] == 'GET'? true :substr($doaminSLD, 0, 1) != '-')) // 去掉-开头的域名
			{
				$ok = true;
			}
		}
		return $ok;
	}

	public static function checkS($string)
	{
		$ok = True;
		if(preg_match("/\\\/ui", $string))
			$ok = false;
		return $ok;
	}

	public static function checkDate($date)
	{
		if(preg_match("/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}/", $date) || preg_match("/\d{4}-\d{2}-\d{2}/", $date))
			return TRUE;
		return FALSE;
	}
}
?>