<?php

if(!defined('ROOT'))
	die('No direct script access allowed');

$config['urlSuffix'] = 'xxxx';	//伪静态后缀
$config['indexPage'] = 'index.php';
$config['uri_protocol'] = 'AUTO'; // option: AUTO, REQUEST_URI, CLI
$config['allowedUriString'] = 'a-z 0-9~%.:_\-\&';
$config['route']['defaultClass'] = 'home';
$config['subClassPrefix'] = 'MY_';


//图片配置
$config['pic'] = array('maxwidth'=>300,	//上传图片最大宽
	'maxheight'=>300,
	'minwidth'=>30,	//上传图片最小宽
	'minheight'=>30,
	'cutwidth'=>150,	//生成的图片宽
	'cutheight'=>150,
	'type'=>array('gif','jpg','png'),
	'maxsize'=>100,	//KB
	'uploaddir'=>'upload/avatar');